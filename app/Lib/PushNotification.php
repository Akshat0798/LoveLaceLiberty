<?php
namespace App\Lib;
use App\Models\UserDevice;

class PushNotification  {
    public static  function sendFcmNotify($user_devices, $message, $type,$dictionary, $title)
    { 
        $url = 'https://fcm.googleapis.com/fcm/send'; 
        $server_key = 'AAAAnCIUYlQ:APA91bHJYINMgn_-8yW0CWEa5SMNlt8O3IGXjHsKa0T3KPZCLM7V7DucQWmp9yjEZtlrpbPBcbuwMjnJBRV7gzibLbViRw5Jq9wr7DaVWvEiuVJ3FE-VuBKHl4d-xvO15pj1Mk08Thnx';
       
        $fields = [
            'priority' => "high",
            'data' => [
                "title" => $title,
                "body" => $message,
                "sound" => 'default',
                "type" => $type,
                "dictionary" => $dictionary
            ],
            'notification' => [
                "title" => $title,
                "body" => $message,
                "sound" => 'default',
                "type" => $type,
                "dictionary" => $dictionary
            ],
            'type'=>$type
        ]; 
        $fields['registration_ids'] = $user_devices;
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public static function Notify($user, $message, $type,$dic=[],$title)
    {
        $UserDevices = UserDevice::where([["user_id",'=',$user],['device_type','!=','SIMULATOR']])->pluck('device_token')->toArray(); 
        if(count($UserDevices)>0)
        {
            PushNotification::sendFcmNotify($UserDevices,$message,$type,$dic,$title);
        }
    } 
   
}
?>