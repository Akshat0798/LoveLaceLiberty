<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VerificationDocument extends Model
{
    use SoftDeletes;
    Protected $table = "verification_documents";
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
    $q = VerificationDocument::select('verification_documents.*');
    $orderby = $orderby ? $orderby : 'verification_documents';
    $order = $order ? $order : 'desc';
    if ($search && !empty($search)) {
        $q->where(function($query) use ($search) {
            $query->where('verification_documents.country_id' , 'LIKE' , '%' . $search . '%');
        });
    }
    $response = $q->orderBy($orderby, $order);
    return $response;
}
}
