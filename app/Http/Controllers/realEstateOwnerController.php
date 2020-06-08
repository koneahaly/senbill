<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Own;
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
      return view('ownerTransactions')->with($infos_perso);

    }
    public function display_locataires()
    {
      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      return view('mes-locataires')->with($infos_perso);

    }
    public function display_properties()
    {
      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      $infos_log['infos_log']=DB::table('owns')->where('owner_id',$s)->get();
      $nb_log=(int)DB::table('owns')->where('owner_id',$s)->count();
      return view('ownerProperties')->with($infos_perso)->with($infos_log)->with('nb_log',$nb_log);

    }

    public function add_housing(Request $given){

      $s=Auth::user()->customerId;
      $own = new Own;
      $own->owner_id=$s;
      $own->title=$given->tl_housing;
      $own->address=$given->address_housing;
      $own->city=$given->city_housing;
      $own->nb_rooms=$given->nb_rooms;
      $own->housing_type=$given->housing_type;
      $own->status=$given->status_housing;
      $own->save();
      return redirect()->intended(route('ownerProperties'));
    }

    public function update_housing(Request $given){

      $s=Auth::user()->customerId;
        DB::table('owns')
            ->where('owner_id', $s)->where('id',$given->housing_id_m)
            ->update(['title' => $given->tl_housing_m, 'address' => $given->address_housing_m,'city' => $given->city_housing_m,
             'nb_rooms' => $given->nb_rooms_housing_m,'housing_type' => $given->type_housing_m,'status' => $given->status_housing_m]);
             return redirect()->intended(route('ownerProperties'));
      }
}
