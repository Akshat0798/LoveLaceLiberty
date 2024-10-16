<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';
    protected $guarded = [];

    public $timestamps = true;

    protected $hidden = [
        'id',
        'type',
        'created_at',
        'updated_at',
    ];

    
}
