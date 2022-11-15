<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Own extends Model
{
    protected $fillable = [
        'owner_id','title', 'description','address','status','created_at','updated_at','nb_rooms',
        'housing_type','city','category','surface','current_occupant_name','occupant_id','bail',
        'monthly_pm','monthly_pm_rec','fees'
    ];
}
