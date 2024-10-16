<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
        $q = Content::select('content.*');
        $orderby = $orderby ? $orderby : 'content.created_at';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('content.title' , 'LIKE' , '%' . $search . '%')
                      ->orWhere('content.description' , 'LIKE' , '%' . $search . '%');
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
