<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;


class WhoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function display_who()
    {
        return view('who');
    }
}
