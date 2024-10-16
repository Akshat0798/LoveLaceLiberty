<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PageContent extends Model
{
    use SoftDeletes;
    Protected $table = "page_contents";
    protected $guarded = [];
    protected $hidden = ['deleted_at'];
    protected $fillable = 
    [
      'title',
      'description',
      'image',
  ];

  public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null, $state=null, $country=null) {
    $q = PageContent::select('page_contents.*');
    $orderby = $orderby ? $orderby : 'page_contents';
    $order = $order ? $order : 'desc';
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('page_contents.title' , 'LIKE' , '%' . $search . '%')
            ->orWhere('page_contents.description' , 'LIKE' , '%' . $search . '%');
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;

}
}
