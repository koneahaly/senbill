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
use Foris\OmSdk\OmSdk;


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

        return redirect('mes-factures/'.$input->service);
    }

    public function payviaPD()
    {
      //$token = $_GET['token'];

      $invoice = new \Paydunya\Checkout\CheckoutInvoice();
    //  $invoice->addChannels(['card', 'jonijoni-senegal', 'orange-money-senegal']);

      //var_dump($invoice);
      //A insérer dans le fichier du code source qui doit effectuer l'action

      /* L'ajout d'éléments à votre facture est très basique.
      Les paramètres attendus sont nom du produit, la quantité, le prix unitaire,
      le prix total et une description optionelle. */
      $invoice->addItem("Consommation du mois de Juin", 1, 12600, 12600, "Facture d'eau du partenaire SDEQ");
      $invoice->addItem("Frais", 1, 0, 0,"Frais gratuits");
      //ajouter d'autres lignes si besoin
      $invoice->setTotalAmount(12600);
      //var_dump($invoice);
      if($invoice->create()) {
        //echo $invoice->getInvoiceUrl();
          return Redirect::to($invoice->getInvoiceUrl());
      }else{
          echo $invoice->response_text;
      }

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
