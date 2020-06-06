<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use stdClass;

class realEstateOwnerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function display_transactions()
    {
      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      if(!empty($infos_perso->service_6))
        return view('ownerTransactions')->with($infos_perso);
      else
        app('App\Http\Controllers\HomeController')->suivi_conso();
    }
    public function display_locataires()
    {
      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      if(!empty($infos_perso->service_6))
        return view('mes-locataires')->with($infos_perso);
      else
        app('App\Http\Controllers\HomeController')->display_bills();
    }
    public function display_properties()
    {
      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      if(!empty($infos_perso->service_6))
        return view('ownerProperties')->with($infos_perso);
      else
        app('App\Http\Controllers\HomeController')->display_contract();
    }
}
