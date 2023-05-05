<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use File;

use Carbon\Carbon;

use App\Product;
use App\ProductsBanner;

class ProductsBannerController extends Controller
{
    protected $uploadFolder;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->uploadFolder = '/uploads/products/banners/';
    }

    /**
     * Store a banner for product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Product  $product_id
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request, $product_id)
    {
        try {
            $banner = new ProductsBanner();
            $banner = ProductsBanner::updateOrCreate(
                ['product_id' => $product_id],
                ['directory' => $banner->uploadBanner($request->file('banner'))]
            );

            $message = 'Sukses upload banner!';
            $status = 'success';
        } catch (\Exception $e) {
            $message = 'Error mengupload banner! Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UUID  $banner_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($banner_id)
    {
        try {
            $photo = ProductBanner::findOrFail($banner_id);

            $photo->delete();

            $message = 'Sukses menghapus banner!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Error hapus banner! Error: ' . $e->getMessage();
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }
}