<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;
    protected $table = 'candidates';

    protected $fillable = 
    [
      'name',
      'title',
      'description',
      'image',
      'election_type',
      'state',
      'party',
      'pro_Tem', 
   ];
    public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
        $q = Candidate::select('candidates.*');
        $orderby = $orderby ? $orderby : 'candidates.created_at';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('candidates.name' , 'LIKE' , '%' . $search . '%');
            });
        }
        $response = $q->orderBy('id')->orderBy($orderby, $order);
        return $response;
    }

    // public function childs(){
    //     return $this->hasMany(Category::class,'parent_id')->where('status',1);
    // }
    // public function parent(){
       
    //     return $this->hasOne(Category::class,'id','parent_id');
    // }

}
