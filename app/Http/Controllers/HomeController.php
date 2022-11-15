<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use App\Own;
use App\Report;
use App\Image;
use stdClass;
use Session;

$service =explode('/',$_SERVER['REQUEST_URI']);
$except_page = $service[1];
if($except_page == 'mes-factures'){
  $_SESSION['current_service'] = $service[2];

if(strpos($service[2],'?') !== false){
  $clean_service = explode('?',$service[2]);
  $_SESSION['current_service'] = $clean_service[0];
  }
}

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



    public function display_bills(Request $input)
    {
      $s=Auth::user()->customerId;
      //dd($input->change_mdp);
      if($input->change_mdp == "true"){
        //dd('gooooooood'.'---'.$input->mdp.'----'.$s.'----'.now());
        DB::table('users')
          ->where('customerId', $s)
          ->update(['password' => bcrypt($input->mdp), 'mdp_modified' => 1, 'date_mdp_modified' => now()]);
      }
      //dd($input);
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
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        $s=Auth::user()->customerId;


        if(strpos($_SERVER['REQUEST_URI'],'errorCode=200') == true){
          $payment_method = "n/a";
          if(strpos($_SERVER['REQUEST_URI'],'ompaysnsuccess') == true)
            $payment_method = "OrangeMoney";
          DB::table('bills')
              ->where([['customerId', $s],['order_number',$input->order]])
              ->update(['status' => 'paid','payment_method' => $payment_method]);
        }

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

        $title_service="";
        if(strpos($_SERVER['REQUEST_URI'],'distribution') !== false){
          $title_service = "distribution";
        }

        if(strpos($_SERVER['REQUEST_URI'],'servicepublic') !== false){
          $title_service = "servicepublic";
        }

        if(strpos($_SERVER['REQUEST_URI'],'locataire') !== false){
          $title_service = "location";
        }
        if(strpos($_SERVER['REQUEST_URI'],'scolarit') !== false){
          $title_service = "scolarité";
        }
        if(strpos($_SERVER['REQUEST_URI'],'sport') !== false){
          $title_service = "sport";
        }
        if(strpos($_SERVER['REQUEST_URI'],'sante') !== false){
          $title_service = "sante";
        }
        if(strpos($_SERVER['REQUEST_URI'],'mobiletv') !== false){
          $title_service = "mobiletv";
        }

        $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
        if(Auth::user()->user_type != 2){
          $numberOfBillsNonPaid = (int)DB::table('bills')->where('customerId',$s)->where('status','!=','paid')->where('title',$title_service)->orderBy('id', 'DESC')->count();
          $numberOfBills = (int)DB::table('bills')->where('customerId',$s)->where('title',$title_service)->orderBy('id', 'DESC')->count();
          if($numberOfBills > 0){
            $data['data']=DB::table('bills')->where('customerId',$s)->where('title',$title_service)->orderBy('id', 'DESC')->get();
            $last_row_data['last_row_data']=DB::table('bills')->where('customerId',$s)->where('title',$title_service)->orderBy('id', 'DESC')->first();

          }
          else {
            $data['data']= NULL;
            $last_row_data['last_row_data']= NULL;
          }
          //dd($data);
          //dd($numberOfBills);

          if($input->change_mdp == "true"){
            //dd("true");
            return back()->with('msg_mdp','Votre mot de passe a été modifié avec succès!');
          }
          else{
            return view('mes-factures')->with($data)->with($user)->with($last_row_data)->with(compact('numberOfBillsNonPaid'))->with($actived_services)->with(compact('profilNotif'));
          }
        
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

          return view('mes-factures')->with($data)->with($user)->with($last_row_data)->with(compact('numberOfBillsNonPaid'))->with($actived_services)->with(compact('profilNotif'));

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

    public function activate_code($phone){

      $s=Auth::user()->customerId;
      $activation_code = rand(10000, 99999);
      // enregistrement en base données
      DB::table('users')
          ->where('customerId', $s)
          ->update(['activation_code' => $activation_code]);

      $sms = new SmsController();
      $sms->send_activation_code($activation_code,$phone);
    }

    public function index()
    {
        display_bills();
    }
      //Get the person's name.
   public function getTb(){
       return $this->tb;
   }
   //Get the person's name.
    public function setTb($tb){
         $this->tb=$tb;
    }


    public function update_personal_infos(Request $given){

      $s=Auth::user()->customerId;

      if($given->action == "save"){
        $this->validate($given,[
          'name' => 'required|string|max:255',
          'address' =>'required|string|max:255',
          'first_name' => 'required|string|max:255'
        ]);
        DB::table('users')
            ->where('customerId', $s)
            ->update(['civilite' => $given->salutation, 'name' => $given->name,'first_name' => $given->first_name, 'address' => $given->address]);
        }

      if($given->action_email == "save"){
        $this->validate($given,[
          'email' => 'required|string|email|max:255|unique:users'
        ]);
        DB::table('users')
            ->where('customerId', $s)
            ->update(['email' => $given->email, 'date_verify_email' => '']);
        }

        $myuser = DB::table('users')->where('customerId',$s)->first();
        $co = new MailController();
        $co->html_verify_email($myuser->email,$myuser->first_name.' '.$myuser->name,'SEN BILL');

      if($given->action_phone == "save"){
        $this->validate($given,[
          'phone' => 'required|string|string|max:15|unique:users'
        ]);
        DB::table('users')
            ->where('customerId', $s)
            ->update(['phone' => $given->phone, 'date_activation_code' => '']);
        }
        if($given->page == "proprietaire"){
          return redirect('infos-proprietaire');
        }
        else{
          return redirect('infos-personnelles/'.$given->service);
        }

    }

    public function update_services_infos(Request $given){

      $s=Auth::user()->customerId;
      if($given->action == "Enregistrer"){
        DB::table('services')
            ->where('customerId', $s)
            ->update(['service_1' => $given->service_1, 'service_2' => $given->service_2,'service_3' => $given->service_3,
             'service_4' => $given->service_4,'service_5' => $given->service_5,'service_6' => $given->service_6,
             'service_7' => $given->service_7,'service_8' => $given->service_8]);
        }
        return redirect('infos-services/'.$given->service);
      }

    public function update_services_pro_infos(Request $given){

      $s=Auth::user()->customerId;
      if($given->action == "Enregistrer"){
        DB::table('services')
            ->where('customerId', $s)
            ->update(['service_1' => $given->service_1, 'service_2' => $given->service_2,'service_3' => $given->service_3,
             'service_4' => $given->service_4,'service_5' => $given->service_5,'service_6' => $given->service_6,
             'service_7' => $given->service_7,'service_8' => $given->service_8]);
        }
        return redirect()->intended(route('infos-services-pro'));
      }

    public function display_contract()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $actived_contracts['actived_contracts'] = DB::table('contracts')->where('renter_id',$s)->first();
      return view('mon-contrat')->with($actived_services)->with($actived_contracts);
    }

    public function test()
    {
      return view('test');
    }

    public function success()
    {
      return view('success');
    }

    public function display_personal_infos(Request $request)
    {
      $s=Auth::user()->customerId;
      $user = DB::table('users')->where('customerId',$s)->first();

      $withPopup = "false";
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      if($request->verify_phone == "yes"){
        $withPopup = "true";
        $this->activate_code($request->phone);
        DB::table('users')
            ->where('customerId', $s)
            ->update(['attempt_sms_sent' => $user->attempt_sms_sent + 1]);
      }
      $message = null;
      $error_message = null;
      if($request->verify == "yes"){
        if($user->activation_code == $request->verification_code){
          DB::table('users')
              ->where('customerId', $s)
              ->update(['date_activation_code' => now()]);
          $message = 'Votre numéro de téléphone est maintenant vérifié.';
        }
        else{
          $error_message = 'Echec de la vérification de votre numéro de téléphone.';
        }
      }
        return view('infos-personnelles')->with($actived_services)->with(compact('withPopup'))->with('message',$message)->with('error_message',$error_message);

    }

    public function display_services_infos()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return view('infos-services')->with($actived_services);
    }

    public function display_services_pro_infos()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return view('infos-services-pro')->with($actived_services);
    }

    public function display_proprio_infos(Request $request)
    {
      $s=Auth::user()->customerId;
      $user = DB::table('users')->where('customerId',$s)->first();

      $withPopup = "false";
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      if($request->verify_phone == "yes"){
        $withPopup = "true";
        $this->activate_code($request->phone);
        DB::table('users')
            ->where('customerId', $s)
            ->update(['attempt_sms_sent' => $user->attempt_sms_sent + 1]);
      }
      $message = null;
      $error_message = null;
      if($request->verify == "yes"){
        if($user->activation_code == $request->verification_code){
          DB::table('users')
              ->where('customerId', $s)
              ->update(['date_activation_code' => now()]);
          $message = 'Votre numéro de téléphone est maintenant vérifié.';
        }
        else{
          $error_message = 'Echec de la vérification de votre numéro de téléphone.';
        }
      }

      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return view('infos-proprietaire')->with($actived_services)->with(compact('withPopup'))->with('message',$message)->with('error_message',$error_message);
    }

    public function display_services()
    {

      $s=Auth::user()->customerId;
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return view('platform')->with($infos_perso)->with($actived_services);
    }



    public function suivi_conso()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
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
      return view('suivi-conso')->with($my_infos_conso)->with($my_infos_conso_euro)->with($actived_services);
    }
    public function rechercher_logement()
    {
      $research="false";
      $search="";
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();

      $housings_all = Own::all();
      $nbr_housing_all = count($housings_all); 
       //DEBUT DEFAULT IMAGE DISPLAYING
       $photos_housing = Image::all()->where('status', '<>', 'D');
       $images = [];
       foreach ($photos_housing as $key=>$photo) {
         $img_default_url = DB::table('images')->where('housing_id',$photo->housing_id)->where('status', '<>', 'D')->get()->first();
         
         if(!empty($img_default_url)){
          if($photo->url == $img_default_url->url){
              $images[] = [
                'id' => $photo->id,
                'housing_id' => $photo->housing_id,
                'name' =>  $photo->filename,
                'src' =>  $img_default_url->url
                ];
          }
        }
       
       }
     
       return view('recherche-logement', compact('images', 'housings_all', 'research','search'))->with($actived_services);
     
    }

    public function signaler_logement()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return view('signaler-logement')->with($actived_services);
    }

    public function signaler_logement_save(Request $given)
    {
      $this->validate($given,[
        'name'=> 'required|min:4|max:255',
        'phone'=> 'required|min:8|max:45',
        'address'=> 'required|min:10|max:255',
        'city'=> 'required|min:3|max:45',
        'caution'=>'required',
        'monthly_pm'=>'required',
        'surface'=>'required',
        'strong_option_fees_selected'=>'required',
        'strong_option_meuble_selected'=>'required'
    ]);

      $s=Auth::user()->customerId;

      Report::create([
        'owner_name' => $given->name,
        'owner_phone' => $given->phone,
        'address' => $given->address,
        'city' => $given->city,
        'caution' => $given->caution,
        'monthly_pm' => $given->monthly_pm,
        'surface' => $given->surface,
        'nb_rooms' => $given->strong_option_selected,
        'housing_type' => $given->strong_option_meuble_selected,
        'current_occupant_name' => Auth::user()->name.' '.Auth::user()->first_name,
        'current_occupant_phone' => Auth::user()->phone,
        'current_occupant_email' => Auth::user()->email,
        'status' =>'A',
      ]);

      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return redirect()->back()->with('message', 'Votre signalement a été correctement effectué! Nous vous contacterons ultérieurement par téléphone ou mail.');
    }

    public function search(Request $given){

      $research="true";
      // Get the search value from the request
      $search = $given->search_city;
      $raw_search_rent = $given->search_rent;
      $req_clause_loyer = [0, 50000000];
      switch ($raw_search_rent) {
        case "inf50m":
          $req_clause_loyer  = [0, 50000];
            break;
        case "Sm10m":
          $req_clause_loyer  = [50000, 100000];
            break;
        case "100m200m":
          $req_clause_loyer  = [100000, 200000];
            break;
        case "200m300m":
          $req_clause_loyer  = [200000, 300000];
            break;
        case "300m500m":
          $req_clause_loyer  = [300000, 500000];
            break;
        case "sup500m":
            $req_clause_loyer  = [500000, 5000000000];
            break;
    }

    $raw_search_own = $given->search_own;
      $req_clause_own = "";
      switch ($raw_search_own) {
        case "Studio":
          $req_clause_own  = "studio";
            break;
        case "2pieces":
          $req_clause_own  = "2";
            break;
        case "3pieces":
          $req_clause_own  = "3";
            break;
        case "4pieces":
          $req_clause_own  = "4";
            break;
        case "5pieces":
          $req_clause_own  = "5";
            break;
        case "maison":
          $req_clause_own  = "maison";
            break;
    }

    $raw_search_meuble = $given->search_meuble;
    $req_clause_meuble = "";
    switch ($raw_search_meuble) {
      case "meuble":
        $req_clause_meuble  = "meuble";
          break;
      case "nonmeuble":
        $req_clause_meuble  = "nonmeuble";
          break;
  }

      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
  
      // Search in the title and body columns from the posts table
      $housings_all = Own::all();
        
      $housings = DB::table('owns')
          ->select('owns.*')
          ->where('city', 'LIKE', "%{$search}%")
          ->whereBetween('monthly_pm',$req_clause_loyer)
          ->where('nb_rooms', 'LIKE', "%{$req_clause_own}%")
          ->where('housing_type', 'LIKE', "{$req_clause_meuble}%")
          //->orWhere('address', 'LIKE', "%{$search}%")
          ->get();
      $nbr_housing = count($housings);
      $nbr_housing_all = count($housings_all); 
       //DEBUT DEFAULT IMAGE DISPLAYING
       $photos_housing = Image::all()->where('status', '<>', 'D');
       $images = [];
       foreach ($photos_housing as $key=>$photo) {
         $img_default_url = DB::table('images')->where('housing_id',$photo->housing_id)->where('status', '<>', 'D')->get()->first();
 
         if($photo->url == $img_default_url->url){
             $images[] = [
               'id' => $photo->id,
               'housing_id' => $photo->housing_id,
               'name' =>  $photo->filename,
               'src' =>  $img_default_url->url
               ];
         }
       
       }


       
       //END DEFAULT IMAGE DISPLAYING   
      //dd($housings);
      // Return the search view with the resluts compacted
      return view('recherche-logement', compact('housings', 'images', 'housings_all', 'research','search','req_clause_loyer','req_clause_own'))->with($actived_services);
  }
}
