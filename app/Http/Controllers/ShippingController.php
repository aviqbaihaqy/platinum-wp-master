<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Auth;
use Response;

use App\Shipping;
use App\ShippingAddress;

class ShippingController extends Controller
{
    private $apiKey = '';

    public function __construct()
    {
        // starter API Key
        $this->apiKey = 'a5e5c9ff564bb78e99370f125486487d';

        $this->middleware('owner')->only(['addShippingAddress']);
    }

    /**
     * Get Address of by ID.
     * 
     * @param UUID $address_id
     *
     * @return Illuminate\Http\Request $request
     */
    public function getShippingAddressData($address_id)
    {
        $address = ShippingAddress::findOrFail($address_id);

        return Response::json(json_encode($address));
    }

    /**
     * Add Shipping Address of Certain User.
     *
     * @return Illuminate\Http\Request $request
     */
    public function addShippingAddress(Request $request, $user_id = '')
    {
        if(!$user_id) $user_id = Auth::user()->id;

        try {
            $address = new ShippingAddress($request->all());
            $address->user_id = $user_id;
            $address->save();

            $message = 'Succeeded to add Shipping Address!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed to add Shipping Address! Error' . $e->getMessage();
            $status = 'success';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Add Shipping Address of Certain User.
     *
     * @return Illuminate\Http\Request $request
     */
    public function updateShippingAddress(Request $request, $address_id = '')
    {
        try {
            $address = ShippingAddress::findOrFail($address_id);
            $address->fill($request->all());
            $address->save();

            $message = 'Succeeded to update Shipping Address!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed to update Shipping Address! Error' . $e->getMessage();
            $status = 'success';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Add Shipping Address of Certain User.
     *
     * @return Illuminate\Http\Request $request
     */
    public function destroyShippingAddress(Request $request, $address_id = '')
    {
        try {
            $address = ShippingAddress::findOrFail($address_id);
            $address->delete();

            $message = 'Succeeded to delete Shipping Address!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed to delete Shipping Address! Error' . $e->getMessage();
            $status = 'success';
        }

        return redirect()->back()->with($status, $message);
    }

    /**
     * Get Estimated Shipping Price.
     *
     * @return JSON
     */
    public function getProvice($provinceId = null)
    {
        $apiUrl = 'https://api.rajaongkir.com/starter/province';
        $apiUrl .= '?';
        $apiUrl .= 'key=' . $this->apiKey;
        $apiUrl .= '&';
        $apiUrl .= 'id=' . $provinceId;

        $client = new Client();

        try {
            // Proses request GET
            $request = $client->get($apiUrl);

            $response = $request->getBody()->getContents();
        } catch (Exception $e) {
            $response = 'Gagal mendapatkan estimasi! Error: ' . $e->getMessage();
        }

        return $response;
    }
}