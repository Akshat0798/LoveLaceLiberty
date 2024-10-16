<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialUrl extends Model
{
    protected $table = 'user_social_urls';

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    
}
