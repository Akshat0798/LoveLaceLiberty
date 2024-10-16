<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = 
    [
      'name',
      'softname',
      'phonecode',
   ];

   public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
    $q = Country::select('countries.*');
    $orderby = $orderby ? $orderby : 'countries';
    $order = $order ? $order : 'desc';
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('countries.name' , 'LIKE' , '%' . $search . '%');
            
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;
}
public function states()
{
    return $this->hasMany(State::class);
}
    
}
