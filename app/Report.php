<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'owner_name', 'owner_phone','address','status','created_at','updated_at','nb_rooms',
        'housing_type','city','current_occupant_name','current_occupant_phone','current_occupant_email','caution','surface','monthly_pm'
    ];
}