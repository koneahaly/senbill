<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $connection = 'mysql2';
    protected $fillable = [
        'salutation','last_name', 'email','customerId','address_1','address_2','phone','status',
        'first_name','dob','pob'
    ];
}
