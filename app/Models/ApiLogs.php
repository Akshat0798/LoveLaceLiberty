<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiLogs extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uri', 'request','user_id'
    ];
    protected $casts = [
        'request' => 'array'
    ];
    // Set table naem
    protected $table = "api_log";

}
