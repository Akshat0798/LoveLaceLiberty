<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth,DB;

class State extends Model
{
    protected $table = 'states';
    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = 
    [
      'name',
    ];

   public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null, $state=null, $country=null) {
    $q = State::select('states.*');
    if($country!=null){
   $q = $q->where('country_id',$country);   
    }    
    if($state!=null){
   $q = $q->where('id',$state);  
    }

    $orderby = $orderby ? $orderby : 'states';
    $order = $order ? $order : 'desc';  
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('states.name' , 'LIKE' , '%' . $search . '%');
            
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;
}

public function country(){
   return $this->hasOne(Country::class,'id','country_id');
}
    
}
