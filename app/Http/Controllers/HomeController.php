<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use stdClass;
use Session;

$service =explode('/',$_SERVER['REQUEST_URI']);
$except_page = $service[1];
if($except_page == 'mes-factures')
  $_SESSION['current_service'] = $service[2];
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
        //Récupération Token bill de PD
        $uriString =explode('?',$_SERVER['REQUEST_URI']);
        if(count($uriString)>1){
          $tokenPhrase = $uriString[1];
          if(strpos($tokenPhrase,'token') !== false)
            $tokenbill=($_GET['token']);
          Session::push('billToken',$tokenbill);
            //  dd(response()->json(['success' => true, 'token' => Session::get('billToken')]));
        }
        //if($_GET['token'])
        //  $billToken=$_GET['token'];
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

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
        if(Auth::user()->user_type != 2){
          $numberOfBillsNonPaid = (int)DB::table('bills')->where('customerId',$s)->where('status','!=','paid')->orderBy('id', 'DESC')->count();
          $numberOfBills = (int)DB::table('bills')->where('customerId',$s)->orderBy('id', 'DESC')->count();
          if($numberOfBills > 0){
            $data['data']=DB::table('bills')->where('customerId',$s)->orderBy('id', 'DESC')->get();
            $last_row_data['last_row_data']=DB::table('bills')->where('customerId',$s)->orderBy('created_at', 'DESC')->first();

          }
          else {
            $data['data']= NULL;
            $last_row_data['last_row_data']= NULL;
          }
          //dd(count($data));
          //dd($numberOfBills);

          return view('mes-factures')->with($data)->with($user)->with($last_row_data)->with(compact('numberOfBillsNonPaid'))->with($actived_services)->with(compact('profilNotif'));
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

    public function paydunyaApi()
    {
      $invoice = new \Paydunya\Checkout\CheckoutInvoice();
      $invoice->setReturnUrl("http://localhost:8000/mes-factures/".$_SESSION['current_service']."/");
      $invoice->setCancelUrl("http://localhost:8000/mes-factures/".$_SESSION['current_service']."/");

      /* L'ajout d'éléments à votre facture est très basique.
      Les paramètres attendus sont nom du produit, la quantité, le prix unitaire,
      le prix total et une description optionelle. */
      $payment_due  =  12600;
      $fees = $payment_due  * 0.05;
      $payment_tot_due  = $payment_due + $fees;
      $invoice->addItem("Consommation du mois de Juin", 1, $payment_due, $payment_due, "Facture d'eau du partenaire SDEQ");
      $invoice->addItem("Frais de gestion", 1, $fees, $fees,"Frais gratuits");
      //ajouter d'autres lignes si besoin
      $invoice->setTotalAmount($payment_tot_due);
      if($invoice->create()) {
        $uriString=$invoice->getInvoiceUrl();
        $uriString =explode('/',$uriString);
        if(count($uriString)>5){
          $tokenPhrase = $uriString[5];
          if(strpos($tokenPhrase,'test') !== false)
            $tokenbill=$tokenPhrase;
        return( response()->json(['success' => true, 'token' => $tokenbill]));
        }
      }
      else{
            echo $invoice->response_text;
      }

    }

    public function update_personal_infos(Request $given){

      $s=Auth::user()->customerId;
      $myuser = DB::table('users')->where('customerId',$s)->first();

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

        $co = new MailController();
        $co->html_verify_email($given->email,$myuser->first_name.' '.$myuser->name,'SEN BILL');

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
      return view('mon-contrat')->with($actived_services);
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

    public function display_proprio_infos()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      return view('infos-proprietaire')->with($actived_services);
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
}
