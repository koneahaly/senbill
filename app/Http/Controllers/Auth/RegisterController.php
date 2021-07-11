<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Bill;
use App\Service;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use App\Rules\Captcha;
//use Faker\Factory;
//use fzaninotto\faker;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/mes-services';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //dd($_POST);
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|string|max:15|unique:users',
            'customerId' =>'required|string|max:25|min:10|unique:users',
            'address' =>'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'g-recaptcha-response' => new Captcha(),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
          $in_elektra = DB::connection('mysql2')->table('contacts')->join('subscriptions', 'contacts.id', '=', 'subscriptions.contact_id')->where('contacts.customerId',$data['customerId'])->count();

          Service::create([
           'customerId' => $data['customerId'],
           'service_1' => (!empty($data['service_1'])) ? $data['service_1'] : 'NULL',
           'service_2' => (!empty($data['service_2'])) ? $data['service_2'] : 'NULL',
           'service_3' => (!empty($data['service_3'])) ? $data['service_3'] : 'NULL',
           'service_4' => (!empty($data['service_4'])) ? $data['service_4'] : 'NULL',
           'service_5' => (!empty($data['service_5'])) ? $data['service_5'] : 'NULL',
           'service_6' => (!empty($data['service_6'])) ? $data['service_6'] : 'NULL',
           'service_7' => (!empty($data['service_7'])) ? $data['service_7'] : 'NULL',
           'service_8' => (!empty($data['service_8'])) ? $data['service_8'] : 'NULL',
       ]);

          if($in_elektra > 0){
            $infos_contacts = DB::connection('mysql2')->table('contacts')
            ->join('subscriptions', 'contacts.id', '=', 'subscriptions.contact_id')
            ->join('offers', 'offers.id', '=', 'subscriptions.service_id')
            ->select('contacts.customerId','offers.libelle as of_lib','offers.service_type as of_st')
            ->where('contacts.customerId',$data['customerId'])->get();
            //dd($infos_contacts);

            DB::connection('mysql2')->table('contacts')
                ->where('customerId', $data['customerId'])
                ->update(['in_elektra' => 'Y']);

            foreach($infos_contacts as $val){
              //dd(strpos(strtolower($val->of_lib),'electricit'));
              $value="";
              $attribut="";
              if(strpos(strtolower($val->of_lib),'eau') === false){
                //dd('test_eau');
              }
              else{
                $attribut = "service_1";
                $value = "eau";
              }

              if(strpos(strtolower($val->of_lib),'electricit') === false){
                //dd('test_elec');
              }
              else{
                $attribut = "service_2";
                $value = "electricite";
              }

              if(strpos(strtolower($val->of_lib),'tv') === false){
                //dd('test_tv');
              }
              else{
                $attribut = "service_3";
                $value = "tv";
              }

              if(strpos(strtolower($val->of_lib),'mobile') === false){
                //dd('test_mobile');
              }
              else{
                $attribut = "service_4";
                $value = "mobile";
              }

              if(strpos(strtolower($val->of_lib),'locataire') === false){
                //dd('test_loc');
              }
              else{
                $attribut = "service_5";
                $value = "locataire";
              }

              if(strpos(strtolower($val->of_lib),'proprietaire') === false){
                //dd('test_prop');
              }
              else{
                $attribut = "service_6";
                $value = "proprietaire";
              }

              if(strpos(strtolower($val->of_lib),'scolarit') === false){
                //dd('test_scol');
              }
              else{
                $attribut = "service_7";
                $value = "scolarité";
              }

              if(strpos(strtolower($val->of_lib),'sport') === false){
                //dd('test_sport');
              }
              else{
                $attribut = "service_8";
                $value = "sport";
              }

              DB::table('services')
                  ->where('customerId', $data['customerId'])
                  ->update([$attribut => $value, 'type_'.$attribut => $val->of_st]);
              }
          }

          $has_bills = DB::connection('mysql2')->table('invoices')->where('customerId',$data['customerId'])->count();
          $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
          if($has_bills > 0){
            $invoices = DB::connection('mysql2')->table('invoices')->where('customerId',$data['customerId'])->get();
            foreach($invoices as $invoice){
              $bill = new Bill;
              $bill->initial=0;
              $bill->final=0;
              $creation_date = explode('-',$invoice->created_at);
              $bill->customerId=$invoice->customerId;
              $bill->month=$months[(int)$creation_date[1] - 1];
              $bill->year=$creation_date[0];
              $bill->deadline= $invoice->payment_due_date;
              $bill->amount=$invoice->tot_payment_due;
              $bill->status= $invoice->payment_status;
              $bill->title= $invoice->title;
              $bill->units=(integer)$bill->final-(integer)$bill->initial;
              $bill->payment_method= $invoice->payment_method;
              $bill->order_number = $invoice->order_number;
              $bill->save();

              DB::connection('mysql2')->table('invoices')
                  ->where('id', $invoice->id)
                  ->update(['import_status' => 'Y']);
            }
          }
          $co = new MailController();
          $co->html_verify_email($data['email'],$data['first_name'].' '.$data['name'],'SEN BILL');
          $co->html_email($data['email'],$data['first_name'].' '.$data['name'],'SEN BILL');

          $indicatif = "";
          $treat_phone = $data['phone'];
          
          if($data['country'] == "sn"){
            if(strpos($data['phone'],'+221') !== false){
              $treat_phone = $data['phone'];
            }
            else{
              $treat_phone = "+221".$data['phone'];
            }
          }

          if($data['country'] == "ci"){
            if(strpos($data['phone'],'+225') !== false){
              $treat_phone = $data['phone'];
            }
            else{
              $treat_phone = "+225".$data['phone'];
            }
          }
        return User::create([
           'civilite' => $data['salutation'],
           'name' => $data['name'],
           'first_name' => $data['first_name'],
           'email' => $data['email'],
           'phone' => $data['phone'],
           'customerId' =>$data['customerId'],
           'address' =>$data['address'],
           'password' => bcrypt($data['password']),
         ]);
    }

    /*public function verify_email(Request $request){
      $mail_to_verify =explode('/',$_SERVER['REQUEST_URI']);
      DB::table('users')
          ->where('email', $mail_to_verify[2])
          ->update(['date_verify_email' => now()]);
    }*/

    public function create_users_demo() {

      $fp = fopen(storage_path('classical_users.txt'), 'w');
      $fc = fopen(storage_path('woyofal_users.txt'), 'w');
      $services = ['eau', 'electricite', 'tv', 'mobile', 'locataire', 'proprietaire'];
      for($i = 0; $i < 10; $i++) {
        $randomNumber = rand(100,999)+(2+$i**2)+(3+$i**3);
        if($i%2 == 0)
          $user_type = 1;
        else
          $user_type = 2;

        $service = rand(1,6);
        $service_index = $service -1;

          User::create([
              'name' => 'user'.$randomNumber,
              'first_name' => 'user'.$randomNumber,
              'email' => 'user'.$randomNumber.'@gmail.com',
              'phone' => '0659594346',
              'customerId' => hexdec(uniqid()),
              'user_type' => $user_type,
              'address' => '26 avenue duschene',
              'password' => bcrypt('demo123'),
              'service_'.$service.'' => $services[$service_index]
          ]);
          if($user_type == 2)
            fwrite($fc, 'user'.$randomNumber.'@gmail.com,');
          else
            fwrite($fp, 'user'.$randomNumber.'@gmail.com,');
      }
      fclose($fp);
      fclose($fc);
      return redirect('admin');
    }

}
