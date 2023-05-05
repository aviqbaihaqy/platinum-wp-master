<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\Http\Controllers\CartController;

use Auth;
use Session;
use Route;

use App\Cart;
use App\Product;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest')->except('logout');
    }

    public function dashboardLogin(Request $request)
    {
        if(!\Auth::check())
            return view('auth.dashboards.login');
        else
            return redirect()->route('dashboard.index');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Populate SESSION cart
        $cart = new CartController();
        $cart->saveSession();
        $cart->populateCart();

        return redirect()->back();
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        // Destroy SESSOION cart of last logged in
        $cart = new CartController();
        $cart->destroyCartSession();

        $requestedRoute = Route::currentRouteName();

        if(starts_with($requestedRoute, 'dashboard.'))
            return route('login.staff');
        else
            return back();
    }
}
