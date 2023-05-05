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

use App\User;
use App\FAQ;
use App\Contact;
use App\Product;
use App\SubCategory;
use App\Category;
use App\Visitor;

class FrontPageController extends Controller
{
    // SEO Keyword
    public $keyword = [
        'lamp', 'lampu', 'lighting',
        'platinum', 'platinumwp', 'platinum wp',
        'platinum lighting',
    ];

    public function __construct()
    {
        parent::__construct();

        // Add the visitor
        Visitor::hit();

        View::share('cartItems', Session::get('cartItems'));
        View::share('categories', Category::all());
    }

    public function index()
    {
        // SEO
        SEO::setTitle('Home');
        SEO::setDescription('Platinum Wira Persadha');
        SEO::opengraph()->setUrl(route('index'));
        SEO::opengraph()->addProperty('type', 'index');
        SEOMeta::addKeyword($this->keyword);

        $products = Product::all();
        $latestProducts = $products->sortBy('created_at');

        // dd($products->first()->attributes->first()->values->first()->value);

    	return view('index', compact([
            'products',
            'latestProducts',
        ]));
    }

    public function showProductByCategory(Request $request, $category_name)
    {
        $category = Category::where('name', $category_name)->first();
        if(!$category) abort(404);

        $lowestPrice = $request->lowestPrice ? $request->lowestPrice : 0;
        $highestPrice = $request->highestPrice != 0 ? $request->highestPrice : 999999999999;
        $search = $request->search;
        $perPage = $request->perPage ? $request->perPage : 6;

        $products = Product::where('price', '>=', $lowestPrice)
            ->where('price', '<=', $highestPrice)
            ->where('category_id', $category->id);
            if($search)
                $products = $products->where('name', 'like', '%' . $search . '%');
        $products = $products->paginate($perPage);

        $categories = Category::all();
        $subcategories = SubCategory::all();

        // SEO
        SEO::setTitle($category->name . ' Products');
        SEO::setDescription('Platinum WP: Products of ' . $category->name);
        SEO::opengraph()->setUrl(route('products.showByCategory', $category->name));
        SEO::opengraph()->addProperty('type', 'products');
        array_push($this->keyword, $category->name);
        SEOMeta::addKeyword($this->keyword);

        $subcategory = null;

        return view('products.index', compact([
            'products', 
            'subcategory',
            'lowestPrice',
            'highestPrice',
            'search',
            'perPage',
            'categories',
            'subcategories',
        ]));
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;

        $products = Product::searchPaginate($search);
        $products->appends(['search' => $search]);

        return view('search-results', compact('products'));
    }

    public function about()
    {
    	return view('about');
    }

    public function contact()
    {
        $faqs = FAQ::all();

        // SEO
        SEO::setTitle('FAQ');
        SEO::setDescription('Platinum Wira Persadha');
        SEO::opengraph()->setUrl(route('contact'));
        SEO::opengraph()->addProperty('type', 'contact');
        foreach($faqs as $faq) {
            $questionWords = explode(' ', $faq->question);
            foreach ($questionWords as $word) {
                array_push($this->keyword, $word);
            }
            $answerWords = explode(' ', $faq->answer);
            foreach ($answerWords as $word) {
                array_push($this->keyword, $word);
            }
        }
        SEOMeta::addKeyword($this->keyword);

    	return view('contact', compact('faqs'));
    }

    public function terms()
    {
        return view('terms');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function postContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'feedback' => 'required',
        ]);

        try {
            $contact = new Contact($request->all());
            $contact->save();

            $status = 'success';
            $message = 'Succeeded to give feedback to admin! Please wait, Admin will reply on your email. Thank You!';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to give feedback, Error: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }
}
