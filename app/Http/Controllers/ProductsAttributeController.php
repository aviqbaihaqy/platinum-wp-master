<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;

use App\ProductsAttribute;
use App\ProductsAttributesItem;

class ProductsAttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    /**
     * Get details of stored attribute.
     *
     * @param UUID $attribute_id
     * @return \Illuminate\Http\Response
     */
    public function getAttributeDetails($attribute_id)
    {
        $attribute = ProductsAttribute::findOrFail($attribute_id);
        $attribute->value = $attribute->values->first()->value;

        return Response::json(json_encode($attribute));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'product_id',
            'attribute_name',
            'values',
        ]);

        $type = 'error';

        try {
            $attribute = new ProductsAttribute();
            $attribute->attribute_name = $request->input('attribute_name');
            $attribute->product_id = $request->input('product_id');

            $attribute->save();

            $item = new ProductsAttributesItem();
            $item->products_attribute_id = $attribute->id;
            $item->value = $request->input('value');
            $item->save();

            $type = 'success';
            $message = 'Succeeded add products attribute!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to add products attribute! : ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = 'error';

        try {
            $attribute = ProductsAttribute::findOrFail($id);
            
            $attribute->fill($request->all());
            
            $attribute->save();

            $item = $attribute->values->first();
            $item->products_attribute_id = $attribute->id;
            $item->value = $request->input('value');
            $item->save();

            $type = 'success';
            $message = 'Succeeded updating a products attribute data!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update a products attribute data! : '.$e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = 'error';

        try {
            $productsattribute = ProductsAttribute::findOrFail($id);

            $productsattribute->delete();

            $type = 'success';
            $message = 'Succeeded deleting a products attribute data!';
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a products attribute data! : '.$e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }
}