<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    Protected $table = "plans";
    protected $guarded = [];

    protected $fillable = 
    [
      'user_id',
      'payment_id',
      'price',
      'title',
      'description',
  ];

  public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null, $state=null, $country=null) {
    $q = Plan::select('plans.*');
    $orderby = $orderby ? $orderby : 'plans';
    $order = $order ? $order : 'desc';
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('plans.price' , 'LIKE' , '%' . $search . '%')
            ->orWhere('plans.title' , 'LIKE' , '%' . $search . '%');
            
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;

}

}
