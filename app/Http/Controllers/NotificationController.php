<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;

use App\Notification;

class NotificationController extends Controller
{
	/**
	 * Class constructor
	 *
	 * @return null
	 */
    public function __construct()
    {
        $this->middleware('staff');
    }

    /**
	 * AJAX Function: Read all notifications
	 *
	 * @return string $message
	 */
    public function readAllMyNotification($user_id)
    {
    	try {
    		$notifications = Notification::where('reciever_id', $user_id)->get();
	    	foreach ($notifications as $notification) {
	    		$notification->status = 'read';
	    		$notification->save();
	    	}

	    	$status = 'success';
	    	$message = '';
    	} catch (Exception $e) {
    		$status = 'error';
	    	$message = 'Error' . $e->getMessage();
    	}

    	return Response::json(json_encode($message));
    }
}