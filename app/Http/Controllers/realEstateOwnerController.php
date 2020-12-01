<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Own;
use App\User;
use App\Service;
use App\Contract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use stdClass;
use Session;

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

      $user['user'] = DB::table('users')->where('customerId',$s)->first();
      $myuser = DB::table('users')->where('customerId',$s)->first();
      $profilNotif = 0;

      if(!empty($myuser->date_activation_code)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = 1;
      }

      if(!empty($myuser->date_verify_email)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = $profilNotif + 1;
      }
      Session::push('profilNotif', $profilNotif);

      $list_renter_id=array();
      $list_housings_infos = [];
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $infos_occupants=DB::table('owns')->select('occupant_id')->where('owner_id',$s)->get();
      $infos_housings=DB::table('owns')->select('occupant_id','current_occupant_name','title')->where('owner_id',$s)->get();
      foreach($infos_occupants as $infos_occupant){
        array_push($list_renter_id,$infos_occupant->occupant_id);
      }
      foreach($infos_housings as $infos_housing){
        $list_housings_infos[$infos_housing->occupant_id] = [$infos_housing->occupant_id,$infos_housing->current_occupant_name,$infos_housing->title];
      }
      $data_bills['data_bills'] =DB::table('bills')->whereIn('customerId',$list_renter_id)->whereNotNull('title')->get();
      $numberOfBillsNonPaid = (int)DB::table('bills')->where('status','<>','paid')->whereIn('customerId',$list_renter_id)->whereNotNull('title')->count();
      $data_infos_housing['data_infos_housing'] = $list_housings_infos;
      return view('ownerTransactions')->with($data_bills)->with($user)->with($data_infos_housing)->with(compact('numberOfBillsNonPaid'))->with($actived_services);

    }
    public function display_locataires()
    {
      $s=Auth::user()->customerId;

      $user['user'] = DB::table('users')->where('customerId',$s)->first();
      $myuser = DB::table('users')->where('customerId',$s)->first();

      if(!empty($myuser->date_activation_code)){
        $profilNotif = 0;
        Session::push('profilNotif', $profilNotif);
      }
      else{
        $profilNotif = 1;
        Session::push('profilNotif', $profilNotif);
      }

      $list_renter_id=array();
      $list_housings_title = [];
      $list_contracts_infos = [];
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $data_contracts=DB::table('contracts')->where('owner_id',$s)->where('status','<>','D')->get();
      $infos_housings=DB::table('owns')->select('occupant_id','title')->where('owner_id',$s)->where('status','<>','D')->get();
      $infos_locations=DB::table('owns')->select('occupant_id')->where('owner_id',$s)->where('status','<>','D')->get();
      $nb_locataires=(int)DB::table('owns')->where('owner_id',$s)->where('status','N')->where('status','<>','D')->count();
      foreach($infos_locations as $infos_location){
        array_push($list_renter_id,$infos_location->occupant_id);
      }
      foreach($infos_housings as $infos_housing){
        $list_housings_title[$infos_housing->occupant_id] = $infos_housing->title;
      }
      foreach($data_contracts as $data_contract){
        $list_contracts_infos[$data_contract->renter_id] = [$data_contract->bail,$data_contract->monthly_pm,$data_contract->start_date,
        $data_contract->end_date,$data_contract->frequency,$data_contract->delay,$data_contract->status];
      }

      $data_locations['data_locations'] =DB::table('users')->whereIn('customerId',$list_renter_id)->get();
      $data_housing_title['data_housing_title'] = $list_housings_title;
      $data_contracts_compact['data_contracts_compact'] = $list_contracts_infos;
      return view('mes-locataires')->with($data_locations)->with($data_housing_title)->with($data_contracts_compact)->with('nb_locataires',$nb_locataires)->with($actived_services);

    }
    public function display_properties()
    {
      $s=Auth::user()->customerId;

      $user['user'] = DB::table('users')->where('customerId',$s)->first();
      $myuser = DB::table('users')->where('customerId',$s)->first();

      if(!empty($myuser->date_activation_code)){
        $profilNotif = 0;
        Session::push('profilNotif', $profilNotif);
      }
      else{
        $profilNotif = 1;
        Session::push('profilNotif', $profilNotif);
      }

      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      $infos_log['infos_log']=DB::table('owns')->where('owner_id',$s)->where('status','<>','D')->get();
      $nb_log=(int)DB::table('owns')->where('owner_id',$s)->where('status','<>','D')->count();
      return view('ownerProperties')->with($infos_perso)->with($infos_log)->with('nb_log',$nb_log)->with($actived_services);

    }

    public function add_housing(Request $given){

      $this->validate($given,[
          'title'=> 'required|min:4|max:255',
          'address'=> 'required|min:10|max:255',
          'city'=> 'required|min:3|max:45'
      ]);

      $s=Auth::user()->customerId;
      $own = new Own;
      $own->owner_id=$s;
      $own->title=$given->title;
      $own->address=$given->address;
      $own->city=$given->city;
      $own->nb_rooms=$given->nb_rooms;
      $own->housing_type=$given->housing_type;
      $own->status=$given->status_housing;
      $own->save();
      //return redirect()->intended(route('ownerProperties'));
      return redirect()->back()->with('message', 'Le logement a été correctement ajouté!');
    }

    public function update_housing(Request $given){

        $this->validate($given,[
            'title'=> 'required|min:4|max:255',
            'address'=> 'required|min:10|max:255',
            'city'=> 'required|min:3|max:45'
        ]);

        $s=Auth::user()->customerId;
          DB::table('owns')
              ->where('owner_id', $s)->where('id',$given->housing_id_m)
              ->update(['title' => $given->title, 'address' => trim($given->address),'city' => $given->city,
               'nb_rooms' => $given->nb_rooms_housing_m,'housing_type' => $given->type_housing_m,'status' => $given->status_housing_m]);

        if($given->status_housing_m == "Y"){
          DB::table('contracts')
              ->where('owner_id', $s)->where('id_own',$given->housing_id_m)
              ->update(['status' => 'N']);
        }
        return redirect()->back()->with('message', 'Le logement a été correctement modifié!');
      }

      public function delete_housing(Request $given,$id){
        $s=Auth::user()->customerId;
        //dd($id);
        DB::table('owns')
            ->where('id',$id)
            ->update(['status' => 'D']);

        DB::table('contracts')
            ->where('id_own',$id)
            ->update(['status' => 'D']);

        return redirect()->intended(route('ownerProperties'));
      }

      public function add_occupant(Request $given){
        $s=Auth::user()->customerId;

        $given->validate([
            'name' => 'required|string|string|max:255',
            'first_name' => 'required|string|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|string|max:13|unique:users',
            'customerId' =>'required|string|max:25|min:10|unique:users',
            'monthly_pm' => 'required',
            'bail' => 'required',
            'start_date' =>'required',
        ]);

        $renter_check_id=DB::table('users')->select('customerId')->where('customerId',$given->customerId)->count();
        if($renter_check_id < 1){
          $occupant_id = $given->customerId;
          User::create([
              'civilite' => $given->civilite,
              'name' => $given->name,
              'first_name' => $given->first_name,
              'email' => $given->email,
              'dob' => $given->dateOB,
              'pob' => $given->placeOB,
              'phone' => $given->phone,
              'customerId' =>$given->customerId,
              'address' =>trim($given->housing_address),
              'password' => bcrypt($given->name.'123'),
            ]);

            $service = new Service;
            $service->customerId= $given->customerId;
            $service->service_5='locataire';
            $service->save();
        }
        $renter_id=DB::table('users')->select('customerId')->where('customerId',$given->customerId)->first();

        $contract = new Contract;
        $contract->id_own=$given->housing_id;
        $contract->owner_id=$s;
        $contract->renter_id=$renter_id->customerId;
        $contract->bail=$given->bail;
        $contract->monthly_pm=$given->monthly_pm;
        $contract->status='Y';
        $contract->delay=$given->delay;
        $contract->start_date=$given->start_date;
        $contract->end_date=$given->end_date;
        $contract->frequency=$given->frequency;
        $contract->save();

        DB::table('owns')
            ->where('owner_id', $s)->where('id',$given->housing_id)
            ->update(['status' => 'N','current_occupant_name' => $given->first_name.' '.$given->name,'occupant_id' => $given->customerId]);

            return redirect()->back()->with('message', 'Le locataire a été correctement ajouté au logement, il recevra sous peu un SMS et un email l invitant à rejoindre Elektra pour payer ses factures!');
      }

      public function update_occupant(Request $given){
        $s=Auth::user()->customerId;

        $given->validate([
            'name' => 'required|string|string|max:255',
            'first_name' => 'required|string|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|string|max:13',
            'customerId' =>'required|string|max:25|min:10',
            'monthly_pm' => 'required',
            'bail' => 'required',
            'start_date' =>'required',
        ]);

        DB::table('users')
            ->where('customerId', $given->occupant_id)
            ->update(['civilite' => $given->civilite,'name' => $given->name,'first_name' => $given->first_name,'email' => $given->email,
          'dob' => $given->dateOB, 'pob' => $given->placeOB, 'phone' => $given->phone, 'customerId' => $given->customerId]);

        DB::table('owns')
            ->where('occupant_id',$given->occupant_id)
            ->update(['current_occupant_name' => $given->first_name.' '.$given->name]);

        DB::table('contracts')
            ->where('renter_id',$given->occupant_id)
            ->update(['bail' => $given->bail, 'monthly_pm' => $given->monthly_pm,
          'delay' =>$given->delay, 'frequency' => $given->frequency]);

          return redirect()->back()->with('message', 'Le locataire a été correctement modifié');
      }

      public function delete_occupant(Request $given,$id){
        $s=Auth::user()->customerId;
        //dd($id);
        DB::table('contracts')
            ->where('renter_id',$id)
            ->update(['status' => 'D']);

        DB::table('owns')
            ->where('occupant_id',$id)
            ->update(['status' => 'N', 'occupant_id' => NULL]);

        return redirect()->intended(route('mes-locataires'));
      }
}
