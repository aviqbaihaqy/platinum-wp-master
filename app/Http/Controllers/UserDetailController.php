<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\UserDetail;

class UserDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  uuid  $user_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'nip' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'country_code' => 'required',
        ]);

        try {
            $user = User::findOrFail($user_id);
            $details = $user->details;

            $details->fill($request->all()); // get all inserted request

            // if file exist, upload
            if($request->hasFile('profile_photo'))
                $details->profile_photo = $details->uploadPhoto($request->file('profile_photo'));

            $details->save();

            $message = 'Succeded updating profile!';
            $status = 'success';
        } catch (Exception $e) {
            $message = 'Failed updating profile!';
            $status = 'error';
        }

        return redirect()->back()->with($status, $message);
    }
}