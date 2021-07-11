<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Auth;

class ApiController extends Controller
{
  //protected $client;
  public function index(Request $input)
  {
    $raw_content = file_get_contents("http://18.204.203.83/api_elec/electrical_counter/read_one.php?counter_number=".Auth::user()->customerId);
    $clean_content = json_decode($raw_content);
    $current_real_amount = $clean_content->current_amount;
    $montant_recharche_total = $current_real_amount + $input->montant_recharge;
    $prepaid_cards_id = $input->montant_recharge / 5000;

    $client = new Client();
    $url_to_electrical_counter = "http://18.204.203.83/api_elec/electrical_counter/update.php?current_amount=".$montant_recharche_total."&counter_number=".Auth::user()->customerId;
    $request = $client->post($url_to_electrical_counter);

    $client_2 = new Client();
    $url_to_buy = "http://18.204.203.83/api_elec/buys/create.php?amount=".$input->montant_recharge."&counter_number=".Auth::user()->customerId."&prepaid_cards_id=".$prepaid_cards_id."&payment_method=".$input->payment_method."&creation_date=&last_updated_date=";
    $request_2 = $client_2->post($url_to_buy);
    //$request->setBody(['current_amount'=>$montant_recharche_total, 'counter_number'=>Auth::user()->customerId]); #set body!
    //$response = $request->send();

    return redirect()->action('billController@buy');

  }
}
