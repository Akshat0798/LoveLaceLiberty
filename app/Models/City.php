<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = 
    [
      'name',
   ];

   public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null, $state=null, $country=null) {
    $q = City::select('cities.*')->with(['state','state.country']);
    // dd($country,$state);
    if($country!=null){
        $q  = $q->whereHas('state', function($q) use($country){
            $q->where('country_id', $country);
        });
    }
    if($state!=null){
        $q = $q->where('state_id',$state);  
         }          
    $orderby = $orderby ? $orderby : 'cities';
    $order = $order ? $order : 'desc';
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('cities.name' , 'LIKE' , '%' . $search . '%');
            
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;

}

public function state() {
    return $this->hasOne(State::class,'id','state_id');
}

}
