<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;
use Carbon\Carbon;

use App\Product;
use App\Invoice;
use App\InvoiceItem;
use App\Shipping;
use App\Transaction;

class InvoiceController extends Controller
{
    protected $viewDirectory;

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('admin')->only(['destroyInvoice']);
        $this->middleware('sales');
    }

    /**
     * Get data of certain invoice using its UUID
     *
     * @param UUID $invoice_id 
     *
     * @return Response JSON
     */
    public function getInvoiceData($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);
        $invoice->items = $invoice->items;
        $invoice->client = $invoice->client;
        $invoice->shipping = $invoice->shipping;
        $invoice->items->each(function($item, $key) {
            $item->product = $item->product;
            $item->product->category = $item->product->subcategory->category;
        });

        return Response::json(json_encode($invoice));
    }

    /**
     * Manually create invoice from dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function createInvoice(Request $request)
    {
        $request->validate([
            'invoice_code' => 'required',
            'shipping_code' => 'required',
            'courier' => 'required',
            'client_name' => 'required',
            'status' => 'required',
        ]);

        // dd($request->invoice_code);

        try {
            // Create Shipping Data
            $shipping = new Shipping();
            $shipping->shipping_code = $request->input('shipping_code');
            $shipping->courier = $request->input('courier');
            $shipping->done_at = $request->input('done_at') ? $request->input('done_at') : Carbon::now();
            $shipping->save();

            // Create Transaction Record
            $transaction = new Transaction();
            $transaction->payment_method = 'direct';
            $transaction->payer_name = $request->input('payer_name');
            $transaction->status = $request->input('status');
            $transaction->save();

            // Create Invoice
            $invoice = new Invoice();
            $invoice->client_name = $request->input('client_name');
            $invoice->invoice_code = $request->input('invoice_code');
            $invoice->discount = $request->input('discount');
            $invoice->grand_total = $request->input('grand_total') - $invoice->discount;
            $invoice->transaction_id = $transaction->id;
            $invoice->shipping_id = $shipping->id;
            $invoice->sales_name = $request->input('sales_name');
            $invoice->status = $request->input('status');
            $invoice->created_at = $request->input($shipping->done_at);
            $invoice->save();

            $message = 'Succeeded to create invoice manually!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed to create invoice manually. Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * [AJAX Function] Manually add invoice items.
     *
     * @param UUID $invoice_id
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function addInvoiceItem(Request $request, $invoice_id)
    {
        try {
            $invoice = Invoice::findOrFail($invoice_id);
            $product = Product::findOrFail($request->input('product_id'));

            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->product_id = $product->id;
            $invoiceItem->amount = $request->input('amount');
            $invoiceItem->total = $product->price * $request->input('amount');
            $invoiceItem->note = $request->input('note');
            $invoiceItem->save();

            $message = 'Succeeded to add invoice item manually!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed to add invoice item manually. Error: ' . $e->getMessage();
            $status = 'error';
        }

        return Response::json(json_encode([
            'status' => $status,
            'message' => $message,
            'invoice_item' => $invoiceItem,
        ]));
    }

    /**
     * Destroy invoice from admin dashboard.
     *
     * @param UUID $invoice_id 
     *
     * @return \Illuminate\Http\Response
     */
    public function insertOrUpdateShippingData(Request $request, $invoice_id)
    {
        try {
            $invoice = Invoice::findOrFail($invoice_id);
        
            if(!$invoice->shipping_id) {
                $shipping = new Shipping();
                $shipping->shipping_code = $request->input('shipping_code');
                $shipping->shipping_address_id = $invoice->transaction->shippingAddress ? $invoice->transaction->shippingAddress : null;
                $shipping->courier = $request->input('courier');
                $shipping->done_at = Carbon::now();
                $shipping->save();

                $action = 'create';
            } else {
                $shipping = $invoice->shipping;
                $shipping->shipping_code = $request->input('shipping_code');
                $shipping->shipping_address_id = $invoice->transaction->shippingAddress ? $invoice->transaction->shippingAddress : null;
                $shipping->done_at = Carbon::now();
                $shipping->courier = $request->input('courier');
                $shipping->save();

                $action = 'update';
            }

            $invoice->shipping_id = $shipping->id;
            $invoice->status = 'shipped';
            $invoice->save();

            $message = 'Succeeded to ' . $action . ' shipping data!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed to execute the insertion data! Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Destroy invoice from admin dashboard.
     *
     * @param UUID $invoice_id 
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyInvoice($invoice_id)
    {
        $invoice = Invoice::findOrFail($invoice_id);

        $invoice->delete();

        return redirect()->back()->with('success', 'Succeeded to delete an invoice!');
    }
}