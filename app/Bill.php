<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'customerId','order_number','year','month','title','deadline','payment_method','status','amount','created_at','updated_at'];

}
