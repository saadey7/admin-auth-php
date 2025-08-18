<?php

namespace Mughal\AdminAuth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $primaryKey = 'id';
    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'language',
        'image',
        'fcm_token',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getImageAttribute($value)
    {
        if($value == null)
        {
           return null;
        }
        else
        {
            return asset('public/assets/images/admin/' . $value);
        }
    }
    
    public function sendNotification($user_id, array $data_array)
    {
        try {
            $user = self::find($user_id);

            if (!$user || !$user->fcm_token) {
                return [
                    'status' => 'error',
                    'message' => 'User not found or FCM token missing'
                ];
            }

            // Get Firebase JSON path from config
            $firebaseFile = config('adminauth.firebase_json');

            $firebaseFactory = (new \Kreait\Firebase\Factory)
                ->withServiceAccount($firebaseFile);

            $messaging = $firebaseFactory->createMessaging();

            $notification = [
                'title' => $data_array['title'] ?? 'Notification',
                'body'  => $data_array['body'] ?? '',
            ];

            $message = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $user->fcm_token)
                ->withNotification($notification)
                ->withData([
                    'description' => $data_array['description'] ?? '',
                    'type' => $data_array['type'] ?? '',
                    'my_token' => $user->api_token ?? '',
                ]);

            $response = $messaging->send($message);

            return [
                'status' => 'success',
                'response' => $response
            ];

        } catch (\Kreait\Firebase\Exception\Messaging\NotFound $e) {
            // Remove invalid token
            $user->fcm_token = null;
            $user->save();

            return [
                'status' => 'error',
                'message' => 'Notification not sent: invalid FCM token'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }


}
