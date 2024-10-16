<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    protected $fillable = ['slug', 'title', 'content', 'meta_title', 'meta_description', 'meta_tags', 'status'];

    public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
        $q = Cms::select('cms.*');
        $orderby = $orderby ? $orderby : 'cms.created_at';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('cms.title' , 'LIKE' , '%' . $search . '%')
                       ->orWhere('cms.content' , 'LIKE' , '%' . $search . '%');
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }

    /**
     * get will get page by slug
     * @param  string $page_slug
     * @return array $page
     */
    public static function get($page_slug)
    {
        return Cms::whereSlug($page_slug)->first();
    }
}
