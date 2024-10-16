<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = 
    [
      'parent_id',
      'title',
      
   ];
    public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
        $q = Category::select('categories.*');
        $orderby = $orderby ? $orderby : 'categories.created_at';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('categories.title' , 'LIKE' , '%' . $search . '%');
            });
        }
        $response = $q->orderBy('title')->orderBy($orderby, $order);
        return $response;
    }

    public function childs(){
        return $this->hasMany(Category::class,'parent_id')->where('status',1);
    }
    public function parent(){
       
        return $this->hasOne(Category::class,'id','parent_id');
    }

    /**
     * get will get page by slug
     * @param  string $page_slug
     * @return array $page
     */
}
