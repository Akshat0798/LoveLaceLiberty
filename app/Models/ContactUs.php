<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    Protected $table = 'contact_us';

    Protected $fillable = 
    [
       'name',
       'email',
       'number',
       'business_name', 
       'is_sent',    
    ];

    public function getModel($limit=null, $offset=null, $search=null, $orderby=null, $order=null) {
        $q = ContactUs::select('contact_us.*');
        $orderby = $orderby ? $orderby : 'contact_us.created_at';
        $order = $order ? $order : 'desc';
        if ($search && !empty($search)) {
            $q->where(function($query) use ($search) {
                $query->where('contact_us.name' , 'LIKE' , '%' . $search . '%')
                      ->orWhere('contact_us.number' , 'LIKE' , '%' . $search . '%')
                      ->orWhere('contact_us.business_name' , 'LIKE' , '%' . $search . '%')
                      ->orWhere('contact_us.email' , 'LIKE' , '%' . $search . '%');
                      
            });
        }
        $response = $q->orderBy($orderby, $order);
        return $response;
    }
}
