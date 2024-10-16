<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
class UserOtp extends Model {
 // protected $fillable = [
 //        'user_id','otp_code'
 //    ];
    protected $primaryKey = 'id';
    public $table = "user_otps";
    protected $guarded = [];
}