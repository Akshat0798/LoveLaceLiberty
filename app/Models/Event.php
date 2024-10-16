<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    Protected $table = "events";
    protected $guarded = [];
    protected $hidden = ['deleted_at'];
    protected $fillable = 
    [
      'user_id',
      'country_id',
      'type',
      'status',
      'file',

  ];

  public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
    $q = Event::select('events.*');
    $orderby = $orderby ? $orderby : 'events';
    $order = $order ? $order : 'desc';
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('events.name' , 'LIKE' , '%' . $search . '%');
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;
}
}
