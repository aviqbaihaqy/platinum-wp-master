<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;

use SEO;
use SEOMeta;
use OpenGraph;
use Twitter;

use Auth;
use View;
use Session;
use Response;

use App\Product;
use App\ProductsAttribute;
use App\ProductsAttributeItem;
use App\ProductDimension;

use App\Category;
use App\SubCategory;
use App\Stock;

use App\Notification;

class ProductController extends Controller
{
    protected $viewDirectory;

    /**
     * Class Contructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('staff')->only(['store', 'update']);
        $this->middleware('admin')->only(['destroy', 'destroyAndRedict']);
        
        $this->viewDirectory = 'products';

        // shared data for all product pages
        $categories = Category::all();

        View::share('categories', $categories);
    }

    /**
     * AJAX Function: Get product data by ID.
     *
     * @param  UUID $product_id
     * @return JSON App\Product $product
     */
    public function getProductData($product_id)
    {   
        $product = Product::findOrFail($product_id);

        $product->attributes = $product->attributes;
        $product->attributes->each(function($attribute, $key) {
            $attribute->values = $attribute->values;
        });
        $product->stock = $product->stock;
        $product->photo = $product->photo;

        return Response::json(json_encode($product));
    }

    /**
     * Get Related Products.
     *
     * @param  Object $subcategory
     * @param  Integer $amount
     * @return App\Product
     */
    public function getRelatedProducts(Object $subcategory, $amount = 6)
    {
        $products = $subcategory->products->take($amount);

        return $products;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subcategory = SubCategory::where('name', $request->subcategory)
            ->get()
            ->first();

        $lowestPrice = $request->lowestPrice ? $request->lowestPrice : 0;
        $highestPrice = $request->highestPrice != 0 ? $request->highestPrice : 999999999999;
        $search = $request->search;
        $perPage = $request->perPage ? $request->perPage : 6;

        $products = Product::where('price', '>=', $lowestPrice)
            ->where('price', '<=', $highestPrice);
        if($subcategory)
            $products = $products->where('subcategory_id', $subcategory->id);
        if($search)
            $products = $products->where('name', 'like', '%' . $search . '%');
        $products = $products->paginate($perPage);

        $categories = Category::all();
        $subcategories = SubCategory::all();

        // SEO
        if($subcategory) {
            $subcategorySEO = $subcategory->name;

            $frontPage = new FrontPageController();
            $keyword = $frontPage->keyword;
            array_push($keyword, $subcategory->name);
            foreach ($products as $product) {
                array_push($keyword, $product->name);            
            }
            array_push($keyword, $search);
            array_push($keyword, $subcategory->name);

            SEOMeta::addKeyword($keyword);
        } else {
            $subcategorySEO = 'All';
        }
        SEO::setTitle($subcategorySEO . ' Products');
        SEO::setDescription('Platinum WP: Products of ' . $subcategorySEO);
        SEO::opengraph()->setUrl(route('products.showByCategory', $subcategorySEO));
        SEO::opengraph()->addProperty('type', 'products');

        return view($this->viewDirectory . '.index', compact([
            'products', 
            'brands', 
            'subcategory',
            'subcategories',
            'perPage',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'product_code' => 'required|unique:products,product_code',

            'name' => 'required',
            'price' => 'required',
            'buying_price' => 'required',

            'status' => 'required',

            'subcategory_id' => 'required',

            'photo' => 'required',
        ]);

        $type = 'error';

        try {
            $product = new Product($request->all());

            $product->save();

            $product_id = $product->id;

            // create stock
            $product->createStock($product_id, $request->input('amount'));

            // save photo
            $product->savePhoto($product_id, $request->file('photo'));

            $type = 'success';
            $message = 'Succeeded creating new product!';

            // notify all people
            Notification::broadcastToAll(
                'product', 
                $message
            );
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Gagal membuat produk baru! Error: ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  UUID  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return route('product.show', $product->id);
    }

    /**
     * Show products by uri generated by name.
     *
     * @param  string  $productUri
     * @return \Illuminate\Http\Response
     */
    public function showByUri($productUri)
    {
        $product = Product::where('uri', $productUri)
            ->get()
            ->first();

        // details about product
        $subcategory = $product->subcategory;
        $dimension = $product->dimension;
        $term = $product->term;

        $relatedProducts = $this->getRelatedProducts($subcategory);
        
        return view($this->viewDirectory . '.view', compact([
            'product', 
            'subcategory',
            'relatedProducts',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UUID  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UUID  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            
            $product->fill($request->all());
            
            $product->save();

            // update stock amount
            $product->stock->amount = $request->input('amount');
            $product->stock->save();
            
            // update photo if reuploaded
            if($request->hasFile('photo')) {
                $product->photo->directory = $product->photo->uploadPhoto($request->file('photo'));
                $product->photo->save();
            }

            $type = 'success';
            $message = 'Succeeded updating a product data!';

            // notify all people
            Notification::broadcastToAll(
                'product', 
                $message
            );
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update a product data! : '.$e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Update the description of product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UUID  $product_id
     * @return \Illuminate\Http\Response
     */
    public function updateDescription(Request $request, $product_id)
    {
        try {
            $product = Product::findOrFail($product_id);
            
            $product->description = $request->input('description');

            $product->save();
            
            $type = 'success';
            $message = 'Succeeded updating description of product!';

            // notify all people
            Notification::broadcastToAll(
                'product', 
                $message
            );
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update description of product data! : '.$e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UUID  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = 'error';

        try {
            $product = Product::findOrFail($id);

            $product->delete();

            $type = 'success';
            $message = 'Succeeded deleting a product data!';

            // notify all people
            Notification::broadcastToAll(
                'product', 
                $message
            );
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a product data! : '.$e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

     /**
     * Remove the specified resource from storage and redirect to the product list
     *
     * @param  UUID  $id
     * @return \Illuminate\Http\Response
     */
     public function destroyAndRedict($id)
    {
        $type = 'error';

        try {
            $product = Product::findOrFail($id);
            $subcategoryName = $product->subcategory->name;

            $product->delete();

            $type = 'success';
            $message = 'Succeeded deleting a product data!';

            // notify all people
            Notification::broadcastToAll(
                'product', 
                $message
            );
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a product data! : '.$e->getMessage();
        }

        return redirect()->route('dashboard.products.lists', $subcategoryName)->with($type, $message);
    }
}