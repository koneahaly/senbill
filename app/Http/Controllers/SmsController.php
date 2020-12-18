<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SmsController extends Controller {

  public function send_activation_code($activation_code,$phone){
    $fields = array(
             'apiKey'=> '39c1b91ea0d827b4adebe92e4a027e303e71793d',
             'phoneNumbers'=> $phone,
             'message'=> 'Bonjour, le code d\'activation est :'.$activation_code,
             'sender' => 'SENBILL',
             'sandbox' => 1
         );


         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL,'https://api.smspartner.fr/v1/send');
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($curl, CURLOPT_TIMEOUT, 10);
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($fields));

         $result = curl_exec($curl);
         curl_close($curl);
       }

       public function send_reflation($phone,$first_name,$amount){
        $fields = array(
                 'apiKey'=> '39c1b91ea0d827b4adebe92e4a027e303e71793d',
                 'phoneNumbers'=> $phone,
                 'message'=> 'Bonjour' .$first_name. ', vous avez un impayé de '.$amount.' FCFA.\n Nous vous invitons à régulariser votre situation au plus vite.',
                 'sender' => 'SENBILL',
                 'sandbox' => 1
             );
    
    
             $curl = curl_init();
             curl_setopt($curl, CURLOPT_URL,'https://api.smspartner.fr/v1/send');
             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($curl, CURLOPT_TIMEOUT, 10);
             curl_setopt($curl, CURLOPT_POST, 1);
             curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($fields));
    
             $result = curl_exec($curl);
             curl_close($curl);
           }

}
