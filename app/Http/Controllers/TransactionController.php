<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Auth;
use Response;

use App\Notification;
use App\UserDetail;
use App\Transaction;
use App\Invoice;
use App\BillingAddress;
use App\ShippingAddress;
use App\Midtrans;

use App\Veritrans\Midtrans as MidtransAPI;
use App\Veritrans\Veritrans as VeritransAPI;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('updateMidtransPaymentStatus', 'recieveNotification');

        $this->viewDirectory = 'transactions';

        MidtransAPI::$serverKey = config('services.midtrans.serverKey');
        MidtransAPI::$isProduction = config('services.midtrans.isProduction');

        VeritransAPI::$serverKey = config('services.midtrans.serverKey');
        VeritransAPI::$isProduction = config('services.midtrans.isProduction');
    }

    /**
     * Recieve the notification coming from the Midtrans API.
     * 
     * @param $order_id // You can also insert with midtrans transaction ID
     *
     * @return $response
     */
    public function updateMidtransPaymentStatus($order_id) // or midtrans transaction ID
    {
        $veritransAPI = new VeritransAPI();
        $response = $veritransAPI->status($order_id);

        // Invoice
        $invoice = Invoice::find($response->order_id);
        
        // For unpaid, let it check
        if($invoice) {
            if($invoice->status == 'unpaid') {
                // Midtrans Data
                $midtrans = $invoice->transaction->midtrans;

                // Save response coming from Midtrans
                $midtrans->saveResponse($response);

                // Get updated invoice
                $invoice = $midtrans->transaction->invoice;
            }
        }

        return Response::json(json_encode([
            'response' => $response,
            'invoice' => $invoice,
        ]));
    }

    /**
     * Recieve the notification coming from the Midtrans API.
     *
     * @return null
     */
    public function recieveNotification(Request $request)
    {
        // Get result
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result) {
            $veritransAPI = new VeritransAPI();
            $response = $veritransAPI->status($result->order_id);

            $invoice = Invoice::find($result->order_id);
            if($invoice) {
                Notification::notifyStaffs(
                    $response->client->id, 
                    'payment', 
                    'has recieved new payment notification status from Midtrans! Check here: <a href="' 
                    . route('members.viewInvoice', $invoice->client->id) . 
                    '">Click</a>'
                );
            }

            // Update payment status of midtrans when recieve the POST from midtrans
            return self::updateMidtransPaymentStatus($response->order_id);
        }

        return $json_result;
    }

    /**
     * Make new Midtrans transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPayment(Request $request)
    {
        // Preparing required data from database
        $userDetails = Auth::user()->details;

        // Midtrans: Transaction details
        $invoice = Invoice::findOrFail($request->invoice_id);
        $transaction_details = [
            'order_id' => $invoice->id,
            'gross_amount' => $invoice->grand_total,
        ];

        // Midtrans: Item Details
        $items = [];
        foreach ($invoice->items as $invoiceItem) {
            $item = [
                'id' => $invoiceItem->product_id,
                'price' => $invoiceItem->product->price,
                'quantity' => $invoiceItem->amount,
                'name' => $invoiceItem->product->name,
            ];

            array_push($items, $item);
        }

        // Get requested Shipping Address
        $shippingAddress = ShippingAddress::find($request->shipping_address_id);
        
        $shipping_address = array();
        if($shippingAddress) {
            $shipping_address['first_name'] = $shippingAddress->first_name;
            $shipping_address['last_name'] = $shippingAddress->last_name;
            $shipping_address['address'] = $shippingAddress->address;
            $shipping_address['city'] = $shippingAddress->city;
            $shipping_address['postal_code'] = $shippingAddress->postal_code;
            $shipping_address['phone'] = $shippingAddress->phone;
            $shipping_address['country_code'] = $shippingAddress->country_code;
        } else {
            $shipping_address['first_name'] = $userDetails->first_name;
            $shipping_address['last_name'] = $userDetails->last_name;
            $shipping_address['address'] = $userDetails->address;
            $shipping_address['city'] = $userDetails->city;
            $shipping_address['postal_code'] = $userDetails->postal_code;
            $shipping_address['phone'] = $userDetails->phone;
            $shipping_address['country_code'] = $userDetails->country_code;
        }
        
        // Midtrans: Billing Address = Midtrans: Shipping Address
        $billing_address = $shipping_address;

        // Midtrans: Customer Details
        $customer_details = array();
        $customer_details = [
            'first_name' => $shipping_address['first_name'],
            'last_name' => $shipping_address['last_name'],
            'email' => $invoice->client->email,
            'phone' => $shipping_address['phone'],

            // Midtrans: Billing Address and Shipping Address
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address,
        ];

        // Midtrans: Credit Card
        $credit_card['secure'] = true;

        // Midtrans: Custom Expiry
        $custom_expiry = [
            'start_time' => Carbon::now()->format('Y-m-d H:i:s O'),
            'unit' => 'hour', 
            'duration' => 2,
        ];

        // Midtrans: Transaction Data
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'customer_details' => $customer_details,
            'credit_card' => $credit_card,
            'expiry' => $custom_expiry
        );

        try {
            $midtransAPI = new MidtransAPI();
            $snapToken = $midtransAPI->getSnapToken($transaction_data);

            if($snapToken) {
                $midtrans = new Midtrans();
                $midtrans->snap_token = $snapToken;
                $midtrans->save();

                // save transaction data to database
                $transaction = new Transaction();
                $transaction->payment_method = 'midtrans';
                $transaction->midtrans_snap_token = $snapToken;
                $transaction->shipping_address_id = $shippingAddress ? $shippingAddress->id : null;
                $transaction->payer_id = Auth::user()->id;
                $transaction->status = 'pending';

                $transaction->save();
            }

            // Updating invoice data with transaction id and status
            $invoice->transaction_id = $transaction->id;
            if($shippingAddress)
                $invoice->shipping_address_id = $shippingAddress->id;
            $invoice->save();

            $result = $snapToken;

            // Notify the staffs
            Notification::notifyStaffs(
                $invoice->client->id, 
                'payment', 
                'has created midtrans payment!'
            );
        } catch (Exception $e) {
            $result = 'Gagal membuat billing, silakan coba lagi. Error: ' . $e->getMessage();
        }

        return $result;
    }

    /**
     * Result of Midtrans transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finishPayment(Request $request)
    {
        $result = $request->input('result_data');
        $result = json_decode($result);

        // Update the midtrans payment status
        if($result)
            $result = json_decode(self::updateMidtransPaymentStatus($result->order_id));
        else if($request->id)
            $result = json_decode(self::updateMidtransPaymentStatus($request->id));
        
        if(!$result)
            return redirect()->back();
        
        return redirect()->route('members.viewInvoice', $result->order_id);
    }
}