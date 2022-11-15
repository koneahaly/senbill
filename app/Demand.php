<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'customer_id', 'request_service_type', 'request_service_name','request_type','status','created_at','updated_at'
    ];
}