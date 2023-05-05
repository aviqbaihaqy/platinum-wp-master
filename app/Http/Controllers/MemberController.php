<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Route;

use App\User;
use App\ShippingAddress;
use App\Invoice;
use App\Cart;

class MemberController extends FrontPageController
{
    public function __construct(Request $request)
    {
    	parent::__construct();

    	$this->middleware('auth');
        $this->middleware('owner')->except(['viewMemberInvoice']);
    }

    /**
     * View profile of certain user.
     *
     * @param  uuid  $user_id
     * @return \Illuminate\Http\Response
     */
    public function showMemberProfile($user_id = '')
    {
        if(!$user_id) $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $profile = $user->details;
        $shippingAddresses = $user->shippingAddresses;

        return view('member-profile', compact(['user', 'profile', 'shippingAddresses']));
    }

    /**
     * Edit particular user's password.
     *
     * @param uuid $user_id
     *
     * @return Illuminate\Http\Request $request
     */
    public function editPassword($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('privacy', compact('user'));
    }

    /**
     * View all of member's cart items.
     *
     * @param uuid $user_id
     *
     * @return Illuminate\Http\Request $request
     */
    public function myCart($user_id = '')
    {
        if(!$user_id) $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $carts->grandTotal = 0;
        foreach ($carts as $cart) {
            $carts->grandTotal += $cart->total;
        }

        return view('mycart', compact(['carts']));
    }

    /**
     * View all of member's invoices.
     *
     * @param uuid $user_id
     *
     * @return Illuminate\Http\Request $request
     */
    public function memberInvoices($user_id = '')
    {
        if(!$user_id) $user_id = Auth::user()->id;
        $invoices = Invoice::where('user_id', $user_id)->get();

        return view('invoices.index', compact(['invoices']));
    }

    /**
     * View member's particular invoice by invoice ID.
     *
     * @param uuid $invoice_id
     *
     * @return Illuminate\Http\Request $request
     */
    public function viewMemberInvoice($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $client = $invoice->client;

        // user only able to see their own invoice
        $auth = Auth::user();
        if($auth->role == 'user')
            if($invoice->user_id != $auth->id)
                abort(403);

        return view('invoices.view', compact(['invoice', 'client']));
    }
}
