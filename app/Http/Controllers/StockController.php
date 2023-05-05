<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Stock;
use App\StocksRecord;
use App\Products;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Restock the products and save the record of the doer.
     * 
     * @param \Illuminate\Http\Request $request
     * @param App\Stock $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $type = 'decreased';

            $stock = Stock::findOrFail($id);

            if($stock->amount < $request->input('amount'))
                $type = 'increased';

            $stock->amount = $request->input('amount');
            if($stock->save()) {
                $record = new StocksRecord([
                    'product_id' => $stock->product_id,
                    'event' => 'restock';
                    'amount' => $stock->amount,
                    'details' => 'The stock has been ' . $type . ' to ' . $stock->amount,
                    'executor_id' => Auth::user()->id,
                ]);
                $record->save();
            }

            $status = 'succes';
            $message = 'Succeded to update the stock!';           
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to restock, Error: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }
}