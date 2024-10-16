<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth, DB, FIND_IN_SET;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'email_verified_at',
        'role_id',
        'updated_at',
        'uuid'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */


    public function getModel($limit = null, $offset = null, $search = null, $orderby = null, $order = null, $type = null, $input = [])
    {

        $q = User::where('role_id', '!=', 1);
        $branchID = Auth::user()->branch_id;
        $orderby = $orderby ? $orderby : 'users.created_at';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function ($query) use ($search) {
                $query->where('users.user_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.mobile_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('users.email', 'LIKE', '%' . $search . '%');
            });
        }
        
        $response = $q->orderBy($orderby, $order);
        return $response;
    }

    

    public function roles()
    {
        return $this->belongsTo("App\Models\Role", 'role_id');
    }

    public static function getProfile($user_id)
    {
        $userId = Auth::user()->id;
        $q = User::select('dob','full_name','email','mobile_number','gender','profile_image')->find($user_id);
        return $q;
    }

    public function getProfilePictureAttribute($value)
    {
        return file_checker($value, 'avatar');
    }

    public function getThumbImageAttribute($value)
    {
        return file_checker($value, 'avatar');
    }

    public function AauthAcessToken()
    {
        return $this->hasMany('\App\Models\OauthAccessToken', 'user_id');
    }

    public function AauthAcessToken1($tokenId)
    {
        if ($tokenId == '') {
            return $this->hasMany('\App\Models\OauthAccessToken', 'user_id');
        } else {
            return OauthAccessToken::find($tokenId);
        }
    }

    public function restrictions()
    {
        return $this->hasOne('\App\Models\Restriction', 'user_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class , 'id', 'category_id') ;
    }

}