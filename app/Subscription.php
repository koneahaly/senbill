<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $connection = 'mysql2';
    protected $fillable = [
        'service_id','partner_id', 'customerId','contact_id','status','billing_period'];
}
