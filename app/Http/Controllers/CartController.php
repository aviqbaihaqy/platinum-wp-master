<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Response;

use App\Cart;
use App\Product;
use App\Invoice;
use App\InvoiceItem;

class CartController extends Controller
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['saveSession', 'checkout']);
        $this->middleware('owner')->only(['checkout', 'destroyUserCart']);
    }

    /**
     * See all carts items
     *
     * @return JSON
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();

        return view('products.carts', compact('carts'));
    }

    /**
     * Make Invoice from user carts
     *
     * @param Request $request
     * @param UUID $user_id
     *
     * @return JSON
     */
    public function checkout(Request $request, $user_id)
    {
        // make invoice
        $invoice = new Invoice();
        $invoice->user_id = $user_id;
        $invoice->grand_total = Cart::getGrandTotal($user_id);
        $invoice->status = 'unpaid';
        $invoice->save();

        // add invoice item
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach($carts as $cart) {
            $invoiceItem = new InvoiceItem([
                'invoice_id' => $invoice->id,

                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
                'total' => $cart->total,
                'note' => $request->input('notes.' . $cart->id),
            ]);

            // convert to invoice item
            if($invoiceItem->save())
                $cart->delete();
        }

        // destroy all cart SESSION
        self::destroyCartSession();

        // redirect to invoice checkout
        return redirect()->route('members.viewInvoice', $invoice->id);
    }

    /**
     * [AJAX Function] 
     * Insert uninserted SESSION Cart Items to database.
     *
     * @return JSON
     */
    public function saveSession()
    {
        $cartItems = Session::get('cartItems');
        $auth = Auth::user();

        if($cartItems) {
            // get all user's cart items
            $savedCarts = Cart::where('user_id', $auth->id)->get();

            // save all cart SESSION to database
            for($position = 0; $position < count($cartItems); $position++) {
                $cart = $cartItems[$position];

                // is item exist in cart?
                $existInCart = $savedCarts->where('product_id', $cart->product_id)->first();
                if($existInCart) {
                    // item exist, just add the amount
                    $existInCart->amount += $cart->amount;
                    $existInCart->save();
                } else {
                    // give new item to the user
                    $cart->user_id = $auth->id;
                    $cart->save();
                }
            }
        }

        return $cartItems;
    }

    /**
     * [AJAX Function] 
     * Populate SESSION Cart from Database.
     *
     * @return Array
     */
    public function populateCart()
    {
        $cartItems = [];

        // take from database
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            array_push($cartItems, $cart);
        }

        // make session of Cart Items
        Session::put('cartItems', $cartItems);

        return [
            'carts' => $carts,
            'cartItems' => $cartItems
        ];
    }

    /**
     * Add Product to SESSION Cart and or Database Cart.
     *
     * @return Array
     */
    public function addToCart(Request $request)
    {
        try {
            // Prepare the array to contain Cart Items
            $cartItems = [];

            // Get cart SESSION
            $cartSession = Session::get('cartItems');

            // Is Cart SESSION is exist and filled with items?
            if($cartSession && is_array($cartSession))
                $cartItems = $cartSession; // Yes, then move items to array that we prepare before ($cartItems)

            // Forget the SESSION, because the data has been stored in $cartItems
            // If there is no SESSION data, ignore this
            $this->destroyCartSession();

            // Find info of selected product
            $product = Product::findOrFail($request->input('product_id'));

            // Is user authenticated?
            if(Auth::check()) { // Yes, then we will directly add it to database
                // Get authenticated user data
                $auth = Auth::user();

                // Find cart based on SELECTED PRODUCT and USER ID
                $cart = Cart::where('user_id', $auth->id) // Get all cart of the autheticated user
                    ->where('product_id', $product->id) // Find selected product in his cart database
                    ->get() // get them all
                    ->first(); // take one, because, suppose it only exist one, if more than one, it is a FAILURE

                // Is cart exist?
                if($cart) { 
                    // Yes, then just add the amount and total
                    $cart->amount += $request->input('amount');
                    $cart->total += $product->price * $request->input('amount');
                } else { 
                    // No, lets make a new
                    $cart = new Cart([
                        'user_id' => $auth->id,
                        'product_id' => $product->id,
                        'amount' => $request->input('amount'),
                        'total' => $product->price * $request->input('amount'),
                    ]);
                }

                // what ever condition, we write same object name
                // so, just save it anyway
                $cart->save();
            } else { // No, then make an Cart Object instead
                $cart = new Cart([
                    'product_id' => $product->id,
                    'amount' => $request->input('amount'),
                    'total' => $product->price * $request->input('amount'),
                ]);
            }

            // is Cart Object already exist in $cartItems?
            $isExist = false;
            foreach($cartItems as $key => $item) { // In search of Cart Object
                if($item->product_id == $cart->product_id) {
                    // We found it!
                    // Lets mark this with status $isExist with true
                    $isExist = true;

                    // is user Authenticated?
                    if(Auth::check()) { // Yes, then sync SESSION with DB
                        // replace the amount with amount from database
                        $item->amount = $cart->amount;
                    } else { // No, then just add the amount
                        $item->amount += $cart->amount;
                    }
                }
            }
            // Use the status that we created
            if(!$isExist) // No, Cart Object do not exist
                array_push($cartItems, $cart); // Then add it to list

            // Make new SESSION using GODDAMN $cartItems
            Session::put('cartItems', $cartItems);

            $status = 'success';
            $message = 'Succeeded to add item to cart!';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to add new item to cart! Error: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * [AJAX Function] 
     * Remove item from cart items.
     *
     * @return JSON
     */
    public function pluckItem($position)
    {
        try {
            // prepare the array for Cart Items
            $cartItems = [];
            $cartSession = Session::get('cartItems');
            if($cartSession)
                $cartItems = $cartSession;

            // forget old session
            $this->destroyCartSession();

            // remove from session and database if logged in
            if(Auth::check()) {
                $trashedItem = $cartItems[$position];

                $cart = Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $trashedItem->product_id)
                    ->get()
                    ->first();

                if($cart)
                    $cart->delete();
            }
            unset($cartItems[$position]);

            // place new session
            Session::put('cartItems', $cartItems);

            $status = 'success';
            $message = 'Succeeded to remove item from cart!';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to add new item to cart! Error: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Remove item from cart items before checkout.
     *
     *
     * @param UUID $cart_id
     */
    public function removeFromCart($cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $userId = $cart->user_id;

        $cartsSession = Session::get('cartItems');
        if($cartsSession) {
            foreach ($cartsSession as $position => $session) {
                if($session->product_id == $cart->product_id) {
                    unset($cartsSession[$position]);
                    $cart->delete();

                    break;
                }
            }
        }

        // renew the content of SESSION cart
        self::destroyCartSession();
        $newCartSession = Cart::where('user_id', $userId)->get();
        Session::put('cartItems', $newCartSession);

        return redirect()->back()->with('success', 'Succeeded to remove item from cart!');
    }

    /**
     * Destroy all cart items of a certain user.
     *
     * @param UUID $user_id
     *
     * @return JSON
     */
    public function destroyUserCart($user_id)
    {
        try {
            $carts = Cart::where('user_id', $user_id)->delete();

            $message = 'Succeeded destroying cart of an user!';
            $status = 'success';        
        } catch (Exception $e) {
            $message = 'Failed destroying cart of an user! Error: ' . $e->getMessage();
            $status = 'error'; 
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * [AJAX Function] 
     * Empty Session of Cart Items.
     *
     * @return JSON
     */
    public function destroyCartSession()
    {
        return Session::forget('cartItems');
    }
}