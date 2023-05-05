<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\ProductsDimension;

class ProductsDimensionController extends Controller
{
    protected $viewDirectory;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $type = 'error';

        try {
            $dimension = new ProductsDimension();
            $dimension->product_id = $product_id;
            $dimension->directory = $dimension->uploadPhoto($request->file('photo'));
            $dimension->save();

            $type = 'success';
            $message = 'Succeeded creating a new dimension!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to create a new dimension! : ' . $e->getMessage();
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
            $dimension = ProductsDimension::findOrFail($id);
            $dimension->removeFromFolder($dimension->directory);
            $dimension->directory = $dimension->uploadPhoto($request->file('photo'));
            $dimension->save();

            $type = 'success';
            $message = 'Succeeded updating a dimension data!';
        } catch (\Exception $e) {
            $type = 'error';
            $message = 'Failed to update a dimension data! : ' . $e->getMessage();
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
            $dimension = ProductsDimension::findOrFail($id);

            $dimension->delete();

            $type = 'success';
            $message = 'Succeeded deleting a dimension data!';
        } catch (Exception $e) {
            $type = 'error';
            $message = 'Failed to delete a dimension data! : ' . $e->getMessage();
        }

        return redirect()->back()->with($type, $message);
    }
}