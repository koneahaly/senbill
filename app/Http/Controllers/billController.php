<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Auth;
use App\Http\Controllers\MailController;
use Illuminate\Mail\Mailable;
use Foris\OmSdk\OmSdk;
use App\Http\Controllers\SmsController;


$service =explode('/',$_SERVER['REQUEST_URI']);
if(count($service) > 2)
  $_SESSION['current_service'] = $service[2];
else
  $_SESSION['current_service'] = 'location';


class billController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input)
    {
      if(!empty($input->mode_paiment)){
        if($input->mode_paiment == '1')
          return view('payment_cb',$input);
        if($input->mode_paiment == '2')
          return view('payment_om',$input);
        if($input->mode_paiment == '3')
          return view('payment_fc',$input);
        }
      if(!empty($input->choix_recharge)){
        if($input->btn_sub == '1')
          return view('payment_cb',['data'=>$input]);
        if($input->btn_sub == '2')
          return view('payment_om',['data'=>$input]);
        if($input->btn_sub == '3')
          return view('payment_fc',['data'=>$input]);
      }
    }

    public function pay_bill(Request $input)
    {
      return view('facture_a_payer',['data'=>$input]);
    }

    /**
     * Show the form for creating a new resource.
     *<input warning

     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'customerId'=> 'required|min:10|max:15'
        ]);
        $bill = new Bill;
        $bill->customerId=$request->customerId;
        $bill->initial=$request->initial;
        $bill->final=$request->final;
        $bill->month=$request->month;
        $bill->year=$request->year;
        $bill->units=(integer)$bill->final-(integer)$bill->initial;
        $admin=DB::table('admins')->first();
        $rate=$admin->rate;
        $bill->amount=$bill->units * $rate;
        $bill->status="En attente";
        $bill->save();
        return view('admin');
    }


    public function pay(Request $input)
    {
        $s=Auth::user()->customerId;

        DB::table('bills')
            ->where([['customerId', $s],['status','<>','paid'],['id',$input->id_bill]])
            ->update(['status' => 'paid','payment_method' => $input->payment_method]);

        DB::connection('mysql2')->table('invoices')
            ->where('order_number', $input->order_number)
            ->update(['payment_status' => 'Payée', 'payment_method' => $input->payment_method, 'paid_amount' => $input->payment_amount]);

        $co = new MailController();
        $co->paymentOK_email($input->email,$input->order_number,$input->payment_amount,$input->payment_method,$input->first_name.' '.$input->name,$_SESSION['current_service'],'SEN BILL');
        //$co->html_email_pro($given->email,$given->first_name.' '.$given->name,$proprio->first_name.' '.$proprio->name,$given->name.'123','SEN BILL');

        if($_SESSION['current_service'] == 'locataire'){
          //send sms to the owner to notify payment
        }


        return redirect('mes-factures/'.$input->service);
    }

    public function payviaPD()
    {
      //$token = $_GET['token'];

      $service =explode('?',$_SERVER['REQUEST_URI']);
      $pd_id_bill  =  $service[1];

      $infos_bills = DB::table('bills')->where('id',$pd_id_bill)->first();

      $invoice = new \Paydunya\Checkout\CheckoutInvoice();
      $invoice->setReturnUrl("http://localhost:8000/mes-factures/".$_SESSION['current_service']."/");
      $invoice->setCancelUrl("http://localhost:8000/mes-factures/".$_SESSION['current_service']."/");

      /* L'ajout d'éléments à votre facture est très basique.
      Les paramètres attendus sont nom du produit, la quantité, le prix unitaire,
      le prix total et une description optionelle. */
      $payment_due  =  $infos_bills->amount;
      $fees = $payment_due  * 0.05;
      $payment_tot_due  = $payment_due + $fees;

      $invoice->addItem("Echéance de ".$infos_bills->month." ".$infos_bills->year, 1, $payment_due, $payment_due, "Facture d'eau du partenaire SDEQ");
      $invoice->addItem("Frais de gestion", 1, $fees, $fees,"");
      //ajouter d'autres lignes si besoin
      $invoice->setTotalAmount($payment_tot_due);
      //var_dump($invoice);
      if($invoice->create()) {
          return Redirect::to($invoice->getInvoiceUrl());
      }else{
          echo $invoice->response_text;
      }

    }

    public function touchpay(Request $input){
      $s=Auth::user()->customerId;
      $data=DB::table('users')->where([['customerId',$s]])->first();

      $status = $input->status;
      $mode = $input->mode;
      $num_from_gu = $input->num_from_gu;
      $paid_amount = $input->paid_amount;
      $paid_sum = $input->paid_sum;
      $validation_date = $input->validation_date;
      DB::table('bills')
          ->where([['customerId', $s],['status','<>','paid'],['order_number',$num_from_gu]])
          ->update(['status' => $status,'payment_method' => $mode, 'updated_at' => $validation_date]);

      DB::connection('mysql2')->table('invoices')
          ->where('order_number', $num_from_gu)
          ->update(['payment_status' => $status, 'payment_method' => $mode, 'paid_amount' => $paid_amount, 'updated_at' => $validation_date]);

      $co = new MailController();
      $co->paymentOK_email($data->email,$input->num_from_gu,$input->paid_amount,$input->mode,$data->first_name.' '.$data->name,$_SESSION['current_service'],'SEN BILL');
      //$co->html_email_pro($given->email,$given->first_name.' '.$given->name,$proprio->first_name.' '.$proprio->name,$given->name.'123','SEN BILL');

      if($_SESSION['current_service'] == 'locataire'){
        //send sms to the owner to notify payment
      }
    }


    public function notify(Request $input){
      $s=Auth::user()->customerId;
      $data=DB::table('users')->where([['customerId',$s]])->first();

      $type_event = $input->type_event;
      $ref_command = $input->ref_command;
      $item_name = $input->item_name;
      $payment_method = $input->payment_method;
      $item_price = $input->item_price;
      $devise = $input->devise;
      $command_name = $input->command_name;
      $api_key_sha256 = $input->api_key_sha256;
      $api_secret_sha256 = $input->api_secret_sha256;
      $token = $input->token;

      $my_api_key = env('API_KEY_INTECH');
      $my_api_secret = env('API_SECRET_INTECH');

      $fields =explode('-',$input->ref_command);
      $true_ref_command = $fields[0];
      if($type_event == sale_complete)
        $status = 'paid';
      else
        $status = 'Unpaid'; //En réalité mettre le statut actuel de la facture (Imapyé ou en attente)

      if(hash('sha256', $my_api_secret) === $api_secret_sha256 && hash('sha256', $my_api_key) === $api_key_sha256)
    {
        DB::table('bills')
            ->where([['customerId', $s],['status','<>','paid'],['order_number',$true_ref_command]])
            ->update(['status' => $status,'payment_method' => $payment_method, 'updated_at' => date('Y-m-d H:is')]);

        DB::connection('mysql2')->table('invoices')
            ->where('order_number', $true_ref_command)
            ->update(['payment_status' => $status, 'payment_method' => $payment_method, 'paid_amount' => $item_price, 'updated_at' => date('Y-m-d H:is')]);

        //$co = new MailController();
        //$co->paymentOK_email($data->email,$input->ref_command,$input->item_price,$input->payment_method,$data->first_name.' '.$data->name,$_SESSION['current_service'],'SEN BILL');
        //$co->html_email_pro($given->email,$given->first_name.' '.$given->name,$proprio->first_name.' '.$proprio->name,$given->name.'123','SEN BILL');

        if($_SESSION['current_service'] == 'locataire'){
          //send sms to the owner to notify payment
        }
      }
    }

    // call paytech api

    public function post($url, $data = [], $header = [])
    {
        $strPostField = http_build_query($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strPostField);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, [
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length: ' . mb_strlen($strPostField)
        ]));

        return curl_exec($ch);
    }

    public function paytech(Request $request){
      $fields =explode('-',$request->idTransaction);
      $postFields = array(
          "item_name"    => 'facture location',
          "item_price"   => $fields[1],
          "currency"     => "xof",
          "ref_command"  =>  $fields[0].'-'.date('YmdHis'),
          "command_name" =>  'test_name',
          "env"          =>  'prod',
          "success_url"  =>  'https://www.senbill.com/mes-factures/locataire',
          "ipn_url"		   =>  'https://www.senbill.com/mes-factures/locataire',
          "cancel_url"   =>  'https://www.senbill.com/mes-factures/locataire',
          "custom_field" =>   ''
      );

      $jsonResponse = $this->post('https://paytech.sn/api/payment/request-payment', $postFields, [
          "API_KEY: 37b8d4760b395e41e157442174b201fd95d6b1da3d369fbe5558a3524bd82ef6",
          "API_SECRET: 86a8e1a15c9f35bb6a3b58e7707598455620c01ad2d615fd436f32efd966ef7c"
      ]);

      die($jsonResponse);
    }

    public function buy()
    {
        return redirect('mes-factures/'.$input->service);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updaterate(Request $request)
    {
        $newrate=Input::get("rate");
        DB::table('admins')
            ->where('id', 1)
            ->update(['rate' => $newrate]);
        return redirect()->intended(route('admin.dashboard'));
    }
    public static function calculate(string $s)
    {

        $sum = DB::table('bills')->where([['customerId',$s],['status','!=','paid']])->sum('amount');
        return $sum;
    }
    public function pdf_bill(request $request)
    {
        $data= new Bill;
        $id_bill=$request->id_bill;
        $s=Auth::user()->customerId;
        $data=DB::table('bills')->where([['customerId',$s],['id',$id_bill]])->get();
        $pdf=PDF::loadView('bill',['data'=>$data]);
        return $pdf->stream('bill.pdf');
    }

    public function pdf_buy(request $request)
    {
        $data= new Bill;
        $id_buy=$request->id_buy;
        $s=Auth::user()->customerId;
        $data=DB::connection('mysql2')->table('buys')->where([['counter_number',$s],['id',$id_buy]])->get();
        $pdf=PDF::loadView('buy',['data'=>$data]);
        return $pdf->stream('buy.pdf');
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function display_callBackPD()
   {
       return view('callBackPD');
   }
}
