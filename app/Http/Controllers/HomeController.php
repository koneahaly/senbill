<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use stdClass;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



    public function display_bills()
    {
      try{

        function ToObject($Array){
          $object = new stdClass();

          // Use loop to convert array into
          // stdClass object
          foreach ($Array as $key => $value) {
              if (is_array($value)) {
                  $value = ToObject($value);
              }
              $object->$key = $value;
          }
          return $object;
        }

        $s=Auth::user()->customerId;
        if(Auth::user()->user_type != 2){
          $numberOfBillsNonPaid = (int)DB::table('bills')->where('customerId',$s)->where('status','!=','paid')->orderBy('id', 'DESC')->count();
          $numberOfBills = (int)DB::table('bills')->where('customerId',$s)->orderBy('id', 'DESC')->count();
          if($numberOfBills > 0){
            $data['data']=DB::table('bills')->where('customerId',$s)->orderBy('id', 'DESC')->get();
          }
          else {
            $data['data']= NULL;
          }
          //dd(count($data));
          $last_row_data['last_row_data']=DB::table('bills')->where('customerId',$s)->orderBy('created_at', 'DESC')->first();

          //dd($numberOfBills);
          return view('mes-factures')->with($data)->with($last_row_data)->with(compact('numberOfBillsNonPaid'));
        }
        if(Auth::user()->user_type == 2){
          //$data['data']=DB::connection('mysql2')->table('buys')->where('counter_number',$s)->orderBy('id', 'DESC')->get();
          //$last_row_data['last_row_data']=DB::connection('mysql2')->table('buys')->where('counter_number',$s)->orderBy('creation_date', 'DESC')->first();

          $raw_buys = file_get_contents("http://localhost/api_elec/buys/read.php?counter_number=".Auth::user()->customerId);
          $buys_treated = json_decode($raw_buys);
          $buys_init = array($buys_treated);
          $buys_items = $buys_init[0];
          //$buys_2 = $buys_1[0];
          $buys_items_object = ToObject($buys_items);
          $data['data'] = collect($buys_items_object);

          $last_raw_buys = file_get_contents("http://localhost/api_elec/buys/read_one.php?counter_number=".Auth::user()->customerId);
          $last_buys_treated = json_decode($last_raw_buys);
          $last_row_data['last_row_data'] = array('creation_date' => $last_buys_treated->creation_date,'amount' => $last_buys_treated->amount,'id' => $last_buys_treated->id);

          foreach($buys_items as $struct) {
            if ($struct == 'No buy found.') {
                $data['data'] = NULL;
                break;
            }
          }

          $numberOfBillsNonPaid = 0;
          return view('mes-factures')->with($data)->with($last_row_data)->with(compact('numberOfBillsNonPaid'));
        }
        //session(['keepNumberOfBillsNonPaid' => $numberOfBillsNonPaid]);
        Session::push('keepNumberOfBillsNonPaid', $keepNumberOfBillsNonPaid);
        Session::push('layout', 'app');
        //dd(Session::get('keepNumberOfBillsNonPaid'));

        } catch (Throwable $e) {
       report($e);
       Auth::logout();
       return false;
     }

    }

    public function index()
    {
        display_bills();
    }

    public function update_personal_infos(Request $given){

      $s=Auth::user()->customerId;
      if($given->action == "save"){
        DB::table('users')
            ->where('customerId', $s)
            ->update(['civilite' => $given->salutation, 'name' => $given->name,'first_name' => $given->first_name, 'address' => $given->address]);
        }

      if($given->action_email == "save"){
        DB::table('users')
            ->where('customerId', $s)
            ->update(['email' => $given->email]);
        }

      if($given->action_phone == "save"){
        DB::table('users')
            ->where('customerId', $s)
            ->update(['phone' => $given->phone]);
        }
      return redirect()->intended(route('infos-personnelles'));

    }

    public function update_services_infos(Request $given){

      $s=Auth::user()->customerId;
      if($given->action == "Enregistrer"){
        DB::table('users')
            ->where('customerId', $s)
            ->update(['service_1' => $given->service_1, 'service_2' => $given->service_2,'service_3' => $given->service_3,
             'service_4' => $given->service_4,'service_5' => $given->service_5,'service_6' => $given->service_6]);
        }
        return redirect()->intended(route('infos-services'));
      }

    public function update_services_pro_infos(Request $given){

      $s=Auth::user()->customerId;
      if($given->action == "Enregistrer"){
        DB::table('users')
            ->where('customerId', $s)
            ->update(['service_1' => $given->service_1, 'service_2' => $given->service_2,'service_3' => $given->service_3,
             'service_4' => $given->service_4,'service_5' => $given->service_5,'service_6' => $given->service_6]);
        }
        return redirect()->intended(route('infos-services-pro'));
      }

    public function display_contract()
    {
      return view('mon-contrat');
    }

    public function display_personal_infos()
    {
      return view('infos-personnelles');
    }

    public function display_services_infos()
    {
      return view('infos-services');
    }

    public function display_services_pro_infos()
    {
      return view('infos-services-pro');
    }

    public function display_proprio_infos()
    {
      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      return view('infos-proprietaire');
    }

    public function display_services()
    {

      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      return view('platform')->with($infos_perso);
    }



    public function suivi_conso()
    {
      $s=Auth::user()->customerId;
      $infos_conso['infos_conso']=DB::table('bills')->select('units','amount','month','year')->where('customerId',$s)->orderBy('created_at', 'DESC')->get();
      $useful_conso = array();
      $useful_conso_euro = array();
      foreach($infos_conso as $info_conso){
        foreach($info_conso as $vl){
          $useful_conso[$vl->month] = $vl->units;
          $useful_conso_euro[$vl->month] = $vl->amount;
        }
      }
      $my_infos_conso['my_infos_conso'] = $useful_conso;
      $my_infos_conso_euro['my_infos_conso_euro'] = $useful_conso_euro;
      return view('suivi-conso')->with($my_infos_conso)->with($my_infos_conso_euro);
    }
}
