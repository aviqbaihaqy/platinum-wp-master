<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Session;
use Response;

use App\User;
use App\UserDetail;
use App\Notification;

class UserController extends Controller
{
   	/**
   	 * Constructor of class
   	 *
   	 * @return void
   	 */
   	public function __construct()
   	{
   		$this->middleware('auth');
   		$this->middleware('staff');
   		$this->middleware('admin')->only(['storeStaff', 'destroyUser']);
   	}

   	/**
   	 * AJAX Function: Get user data by ID save it in SESSION
   	 *
   	 * @return App\User $user
	 */
	public function getUserData($user_id)
	{
		$selectedUser = User::findOrFail($user_id);
		$selectedUser->profile = $selectedUser->details;

		return Response::json(json_encode(['selectedUser' => $selectedUser]));
	}

	/**
   	 * Create and store new staff.
   	 *
   	 * @param Illuminate\Http\Request $request
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function storeStaff(Request $request)
	{
		try {
			$staff = new User($request->all());
			$staff->password = bcrypt($request->input('password'));
			$staff->save();

			$detail = new UserDetail();
			$detail->user_id = $staff->id;
			$detail->first_name = $request->input('first_name');
			$detail->last_name = $request->input('last_name');
			$detail->address = $request->input('address');
			$detail->phone = $request->input('phone');
			$detail->nip = $request->input('nip');
			$detail->save();

			$message = 'Succeeded to create new staff';
			$status = 'success';

			// send notifications to admins
			$recievers = [];
			$allAdmins = User::where('role', 'admin')->get();
			foreach ($allAdmins as $reciever) {
				array_push($recievers, $reciever->id);
			}
			Notification::broadcastTo($recievers, 'user', $message);
		} catch (Exception $e) {
			$message = 'Failed to create new staff. Error: ' . $e->getMessage();
			$status = 'error';
		}

		return redirect()->back()->with($status, $message);
	}

	/**
   	 * Update the user photo from member profile.
   	 *
   	 * @param Illuminate\Http\Request $request
   	 * @param uuid $user_id
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function updateProfilePicture(Request $request, $user_id)
	{
		$request->validate([
			'photo' => 'required|max:5000|mimes:jpg,jpeg,png'
		]);

		try {
			$user = User::findOrFail($user_id);

			$user->details->profile_photo = $user->details->uploadPhoto($request->file('photo'));

			$user->details->save();

			$message = 'Succeeded to update the profile picture';
			$status = 'success';
		} catch (Exception $e) {
			$message = 'Failed to update profile picture. Error: ' . $e->getMessage();
			$status = 'error';
		}

		return redirect()->back()->with($status, $message);
	}

	/**
   	 * Update the user data from dashboard of staff/admin.
   	 *
   	 * @param Illuminate\Http\Request $request
   	 * @param uuid $user_id
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function updateMember(Request $request, $user_id)
	{
		try {
			$user = User::findOrFail($user_id);
			$user->email = $request->input('email');
			$user->save();

			$user->details->first_name = $request->input('first_name');
			$user->details->last_name = $request->input('last_name');
			$user->details->address = $request->input('address');
			$user->details->phone = $request->input('phone');
			$user->details->company = $request->input('company');

			$user->details->save();

			$message = 'Succeeded to update the member data';
			$status = 'success';

			Notification::broadcastTo([$user->id], 'profile', $message);
		} catch (Exception $e) {
			$message = 'Failed to update member data. Error: ' . $e->getMessage();
			$status = 'error';
		}

		return redirect()->back()->with($status, $message);
	}

	/**
   	 * Update my data.
   	 *
   	 * @param Illuminate\Http\Request $request
   	 * @param uuid $user_id
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function updateMyDetails(Request $request, $user_id)
	{
		// if its not your account nor you are not admin
		if(Auth::user()->id != $user_id) {
			if(Auth::user()->role != 'admin') {
				abort(403);
			}
		}

		try {
			$user = User::findOrFail($user_id);

			$user->email = $request->input('email');
			$user->role = $request->input('role');
			$user->status = $request->input('status');

			$user->save();

			$user->details->first_name = $request->input('first_name');
			$user->details->last_name = $request->input('last_name');
			$user->details->address = $request->input('address');
			$user->details->phone = $request->input('phone');
			$user->details->nip = $request->input('nip');

			$user->details->save();

			$message = 'Succeeded to update the personal data';
			$status = 'success';

			Notification::broadcastTo([$user->id], 'profile', $message);
		} catch (Exception $e) {
			$message = 'Failed to update personal data. Error: ' . $e->getMessage();
			$status = 'error';
		}

		return redirect()->back()->with($status, $message);
	}

	/**
   	 * Update the staff data from dashboard of staff/admin.
   	 *
   	 * @param Illuminate\Http\Request $request
   	 * @param uuid $user_id
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function updateStaff(Request $request, $user_id)
	{
		try {
			$user = User::findOrFail($user_id);
			$user->email = $request->input('email');
			$user->role = $request->input('role');
			$user->status = $request->input('status');
			$user->save();

			$user->details->first_name = $request->input('first_name');
			$user->details->last_name = $request->input('last_name');
			$user->details->address = $request->input('address');
			$user->details->phone = $request->input('phone');
			$user->details->nip = $request->input('nip');

			$user->details->save();

			$message = 'Succeeded to update the staff data';
			$status = 'success';

			Notification::broadcastTo([$user->id], 'profile', $message);
		} catch (Exception $e) {
			$message = 'Failed to update staff data. Error: ' . $e->getMessage();
			$status = 'error';
		}

		return redirect()->back()->with($status, $message);
	}

	/**
   	 * Update password of particular user.
   	 *
   	 * @param Illuminate\Http\Request $request
   	 * @param uuid $user_id
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function updatePassword(Request $request, $user_id) 
	{
		$request->validate([
			'oldPassword' => 'required',
			'newPassword' => 'required',
			'confirmNewPassword' => 'required',
		]);

		$user = User::findOrFail($user_id);
		if(!Hash::check($request->input('oldPassword'), $user->password)) 
		{
			$status = 'error';
			$message = '<b>Old password</b> check failed, You inserted wrong <b>old password</b>! Please try again';
		} 
		else if($request->input('newPassword') !== $request->input('confirmNewPassword')) 
		{
			$status = 'error';
			$message = '<b>New password</b> and <b>confirmed password</b> mismatch! Please try again';
		} 
		else 
		{
			try {
				$user->password = Hash::make($request->input('newPassword'));
				$user->save();

				$status = 'success';
				$message = 'Password update <b>succeeded</b>! Thank you for securing your own account';
			} catch (Exception $e) {
				$status = 'error';
				$message = 'Failed to update the password! Error: ' . $e->getMessage();
			}
		}

		return redirect()->back()->with($status, $message);
	}

	/**
   	 * Update the user data from dashboard of staff/admin.
   	 *
   	 * @param uuid $user_id
   	 *
   	 * @return Illuminate\Http\Request $request
	 */
	public function destroyUser($user_id)
	{
		try {
			$user = User::findOrFail($user_id);

			$user->delete();

			$message = 'Succeeded destroying one user!';
			$status = 'success';

			// send notifications to admins
			$recievers = [];
			$allAdmins = User::where('role', 'admin')->get();
			foreach ($allAdmins as $reciever) {
				array_push($recievers, $reciever->id);
			}
			Notification::broadcastTo($recievers, 'user', $message);
		} catch (Exception $e) {
			$message = 'Failed to destroy one user! Error: ' . $e->getMessage();
			$status = 'error';
		}

		return redirect()->back()->with($status, $message);
	}
}
