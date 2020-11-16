<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Importation extends Model
{
    use Notifiable;
    protected $connection = 'mysql2';
    protected $fillable = [
        'import_number','import_type', 'status','provider'];
}
