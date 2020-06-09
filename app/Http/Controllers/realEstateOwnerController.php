<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Own;
use App\User;
use App\Contract;
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
      $list_renter_id=array();
      $list_housings_title = [];
      $infos_housings=DB::table('owns')->select('occupant_id','title')->where('owner_id',$s)->get();
      $infos_locations=DB::table('owns')->select('occupant_id')->where('owner_id',$s)->get();
      $nb_locataires=(int)DB::table('owns')->where('owner_id',$s)->where('status','N')->count();
      foreach($infos_locations as $infos_location){
        array_push($list_renter_id,$infos_location->occupant_id);
      }
      foreach($infos_housings as $infos_housing){
        $list_housings_title[$infos_housing->occupant_id] = $infos_housing->title;
      }
      $data_locations['data_locations'] =DB::table('users')->whereIn('customerId',$list_renter_id)->get();
      $data_housing_title['data_housing_title'] = $list_housings_title;
      return view('mes-locataires')->with($data_locations)->with($data_housing_title)->with('nb_locataires',$nb_locataires);

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

      $this->validate($given,[
          'tl_housing'=> 'required|min:4|max:255',
          'address_housing'=> 'required|min:10|max:255',
          'city_housing'=> 'required|min:3|max:45'
      ]);

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

      $this->validate($given,[
          'tl_housing_m'=> 'required|min:4|max:255',
          'address_housing_m'=> 'required|min:10|max:255',
          'city_housing_m'=> 'required|min:3|max:45'
      ]);
      $s=Auth::user()->customerId;
        DB::table('owns')
            ->where('owner_id', $s)->where('id',$given->housing_id_m)
            ->update(['title' => $given->tl_housing_m, 'address' => $given->address_housing_m,'city' => $given->city_housing_m,
             'nb_rooms' => $given->nb_rooms_housing_m,'housing_type' => $given->type_housing_m,'status' => $given->status_housing_m]);
             return redirect()->intended(route('ownerProperties'));
      }

      public function add_occupant(Request $given){
        $s=Auth::user()->customerId;
        User::create([
            'civilite' => $given->civilite,
            'name' => $given->nom,
            'first_name' => $given->prenom,
            'email' => $given->mail,
            'dob' => $given->dateOB,
            'pob' => $given->placeOB,
            'phone' => $given->phone,
            'customerId' =>$given->cni,
            'address' =>$given->housing_address,
            'password' => bcrypt($given->nom.'123'),
            'service_5' => 'locataire',
        ]);
        $renter_id=DB::table('users')->select('customerId')->where('customerId',$given->cni)->first();

        $contract = new Contract;
        $contract->id_own=$given->housing_id;
        $contract->owner_id=$s;
        $contract->renter_id=$renter_id->customerId;
        $contract->bail=$given->caution;
        $contract->monthly_pm=$given->loyer;
        $contract->status='Y';
        $contract->save();

        DB::table('owns')
            ->where('owner_id', $s)->where('id',$given->housing_id)
            ->update(['status' => 'N','current_occupant_name' => $given->prenom.' '.$given->nom]);

        return redirect()->intended(route('ownerProperties'));
      }

      public function update_occupant(Request $given){
        $s=Auth::user()->customerId;
        DB::table('users')
            ->where('customerId', $given->occupant_id)
            ->update(['civilite' => $given->civilite,'name' => $given->nom,'first_name' => $given->prenom,'email' => $given->mail,
          'dob' => $given->dateOB, 'pob' => $given->placeOB, 'phone' => $given->phone, 'customerId' => $given->cni]);

        DB::table('owns')
            ->where('occupant_id',$given->occupant_id)
            ->update(['current_occupant_name' => $given->prenom.' '.$given->nom]);

        return redirect()->intended(route('mes-locataires'));
      }
}
