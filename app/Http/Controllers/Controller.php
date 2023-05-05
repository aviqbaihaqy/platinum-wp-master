<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use PragmaRX\Countries\Package\Countries;

use View;
use Session;

use App\Category;
use App\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	View::share('categories', Category::all());
    	View::share('_products', Product::all());
    	View::share('cartItems', Session::get('cartItems'));

    	// Country codes
        $countries = Countries::all();
        View::share('countries', $countries->toArray());

        // dd($countries);
    }
}
