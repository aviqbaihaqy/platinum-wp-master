<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use File;

use Carbon\Carbon;

use App\ProductsPhoto;

class ProductsPhotoController extends Controller
{
    protected $uploadFolder;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->uploadFolder = '/uploads/products/';
    }

    /**
     * Store a photo for product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $product_id)
    {
        try {
            foreach ($request->file('photos') as $key => $photoRequest) {
                if($request->hasFile('photos.' . $key)) {
                    $photo = new ProductsPhoto();

                    // Upload to directory
                    $directory = $photo->uploadPhoto($photoRequest);

                    $photo->product_id = $product_id;
                    $photo->directory = $directory;

                    $photo->save();
                }
            }

            $message = 'Sukses upload foto-foto!';
            $status = 'success';
        } catch (\Exception $e) {
            $message = 'Error mengupload foto! Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Update a photo for product.
     *
     * @param  UUID  $photo_id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request, $photo_id)
    {
        $request->validate(['photo' => 'required|mimes:jpg,jpeg,png|max:5000']);

        try {
            $photo = ProductsPhoto::findOrFail($photo_id);

            $photo->removeFromFolder($photo->directory);
            $newDirectory = $photo->uploadPhoto($request->file('photo'));

            $photo->directory = $newDirectory;
            $photo->save();

            $message = 'Sukses update foto!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Error update foto! Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UUID  $photo_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($photo_id)
    {
        try {
            $photo = ProductsPhoto::findOrFail($photo_id);

            $photo->delete();

            $message = 'Sukses menghapus foto!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Error hapus foto! Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }
}