<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserDevice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','device_token', 'device_type','device_unique_id'
    ];
    public $timestamps = true;

    public static function createOrUpdateDevice($user_id, $data){
        $userDevice = UserDevice::where(['device_type'=> $data->device_type,'device_unique_id'=>$data->device_unique_id])->first();
        
        if($userDevice){
            //$userDevice->delete();
            //self::createDevice($user_id, $data);
            $userDevice->user_id = $user_id;
            $userDevice->device_token = $data->device_token;
            $userDevice->save();
        }else{
            self::createDevice($user_id, $data);
        }
        return true;
    } 

    public static function createDevice($user_id, $data){
        $userDevice = new UserDevice;
        $userDevice->user_id = $user_id;
        $userDevice->device_token = $data->device_token;
        $userDevice->device_type = $data->device_type;
        $userDevice->device_unique_id = $data->device_unique_id;
        $userDevice->save();
    }
    
}
