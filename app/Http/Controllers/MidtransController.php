<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Veritrans_Config as VeritransConfig;
use Veritrans_Snap as VeritransSnap;
use Veritrans_Notification as VeritransNotification;

use Auth;

use App\Midtrans;

class MidtransController extends Controller
{
    /**
     * Class Constructor
     *
     * @return void
     */
    public function __construct()
    {
        VeritransConfig::$serverKey = config('services.midtrans.serverKey');
        VeritransConfig::$clientKey = config('services.midtrans.clientKey');
        VeritransConfig::$isProduction = config('services.midtrans.isProduction');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $midtrans = Midtrans::all();

        return view($this->viewDirectory . '.index', compact(['midtrans']));
    }

    /**
     * Reciever Midtrans newest payment status.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification(Request $request)
    {

    }
}