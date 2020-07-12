<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $connection = 'mysql2';
    protected $fillable = [
        'customerId','subscription_id','order_number','title','min_payment_due','tot_payment_due','payment_due_date','payment_method','payment_status','provider','import_status','paid_amount','bill'];
}
