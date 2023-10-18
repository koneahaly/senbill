<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand_pj extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'request_id', 'pj_name', 'pj_link'
    ];
}