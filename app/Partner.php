<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Partner extends Authenticatable
{
    use Notifiable;
    protected $connection = 'mysql2';
}
