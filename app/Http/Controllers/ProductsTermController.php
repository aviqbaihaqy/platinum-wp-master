<?php

namespace App\Http\Controllers;

use App\ProductsTerm;
use App\Product;

use Response;

use Illuminate\Http\Request;

class ProductsTermController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    public function getTerms($product_id)
    {
        $product = Product::findOrFail($product_id);
        $term = $product->term;

        return Response::json(json_encode($term));
    }

    public function updateOrCreate(Request $request, $product_id)
    {
        try {
            $term = ProductsTerm::firstOrNew(['product_id' => $product_id]);
            
            $term->fill($request->all());
            
            $term->save();
            $type = 'success';
            $message = 'Succeeded updating term of product';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update the term of product! Error: ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }
}
