<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Mail;
use Common;
use App\Models\User;
use EmailProvider;
use Auth;

class ApiController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $status = "false";
    public $code = 200;
    public $message = '';
    public $data = array();
    public $token = '';
    public $user_status = 'true';
    public $outbond_data = array();

    function response() {
//         ini_set( 'serialize_precision', -1 );
        header('Content-Type: application/json');
        if (isset($_REQUEST['user_id'])) {
            $userData = User::where('id', $_REQUEST['user_id'])->first();
            if ($userData) {
                if ($userData->status != 1) {
                    $this->user_status = 'false';
                }
            } else {
                $this->user_status = 'false';
            }
        }
        unset($_REQUEST['message_thumb']);
        $resp = [
            'code'=>$this->code,
            'status'=>$this->status,
            'message' => $this->message,
            'data' => (object) $this->data,
            'token'=> $this->token,
            //'request_data' => $_REQUEST,
        ];

        echo json_encode($resp);
        die();
    }

    function validate($validator) {
        if ($validator->fails()) {
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                if (!isset($firstError))
                    $firstError = $messages[0];
                $error[$field_name] = $messages[0];
            }
            $this->message = $firstError;
            return false;
        } else {
            return true;
        }
    }

    

}
