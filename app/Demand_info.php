<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand_info extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'request_id', 'first_name', 'last_name','pob','dob','father_first_name','father_last_name',
        'mother_first_name','mother_last_name','phone','email','physical_address', 'description'
    ];
}