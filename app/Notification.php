<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

use Webpatser\Uuid\Uuid;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'sender_id',
        'reciever_id',
        'type',
        'message',
        'status',
    ];

    protected $hidden = [
        
    ];

    protected static function boot()
    {
    	parent::boot();

    	self::creating(function($model) {
            $model->id = Uuid::generate()->string;
    	});
    }

    /**
     * Get all unread notifications of certain user.
     *
     * @return App\Notification $notification
     */
    public static function getAllUnreadNotifications()
    {
        $notifications = self::where('reciever_id', Auth::user()->id)
            ->where('status', 'unread')
            ->get();

        return $notifications;
    }

    /**
     * Get all all notifications of certain user.
     *
     * @return App\Notification $notification
     */
    public static function getAllNotifications()
    {
        $notifications = self::where('reciever_id', Auth::user()->id)
            ->get();

        return $notifications;
    }

    public static function notifyStaffs($sender_id, $type, $message)
    {
        $recievers = User::where('role', '!=', 'user')
            ->get();

        foreach ($recievers as $reciever) {
            $notification = self::create([
                'sender_id' => $sender_id,
                'reciever_id' => $reciever->id,
                'type' => $type,
                'message' => '<a href="' . '/dashboard/user/' . $sender_id . '/profile' . '">' . User::find($sender_id)->details->first_name . '</a>' . ' ' . $message,
            ]);
        }
    }

    /**
     * Broadcast notification to all user.
     *
     * @return null
     */
    public static function broadcastToAll($type, $message)
    {
        $recievers = User::where('role', '!=', 'user')
            ->get();

        foreach ($recievers as $reciever) {
            $notification = self::create([
                'sender_id' => Auth::user()->id,
                'reciever_id' => $reciever->id,
                'type' => $type,
                'message' => $message,
            ]);
        }
    }

    /**
     * Broadcast notification only to certain user.
     *
     * @return null
     */
    public static function broadcastTo($recievers = [], $type, $message)
    {
        foreach ($recievers as $reciever) {
            $notification = self::create([
                'sender_id' => Auth::user()->id,
                'reciever_id' => $reciever,
                'type' => $type,
                'message' => $message,
            ]);
        }
    }

    /**
     * Broadcast notification to all user except inputted.
     *
     * @return null
     */
    public static function broadcastExcept($except = [], $type, $message)
    {
        $recievers = User::where('role', '!=', 'user')
            ->get();

        foreach ($recievers as $reciever) {
            // is the reciever id exist in array of except
            if(!array_key_exists($reciever->id, $except)) {
                $notification = self::create([
                    'sender_id' => Auth::user()->id,
                    'reciever_id' => $reciever,
                    'type' => $type,
                    'message' => $message,
                ]);
            }
        }
    }

    public function sender()
    {
        return $this->hasOne('App\User', 'id', 'sender_id');
    }

    public function reciever()
    {
        return $this->hasOne('App\User', 'id', 'reciever_id');
    }
}