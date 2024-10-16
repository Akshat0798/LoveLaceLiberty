<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    Protected $table = "transactions";
    protected $guarded = [];

    protected $fillable = 
    [
      'user_id',
      'subscription_id',
      'plan_id',
      'amount',
      'transaction_time',
      'status',
  ];

  public function getPlan()
    {
        return $this->hasOne(Plan::class , 'id', 'plan_id') ;
    }

    public function getBusiness()
    {
        return $this->hasOne(Business::class, 'id', 'user_id');
    }
}
