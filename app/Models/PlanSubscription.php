<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanSubscription extends Model
{
    Protected $table = "plan_subscriptions";
    protected $guarded = [];

    protected $fillable = 
    [
      'plan_id',
      'user_id',
      'subscription_id',
      'status',
      'price',
      'start_date',
      'end_date',
      'reason',
      'reason_detail',
  ];
}
