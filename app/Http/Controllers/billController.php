<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use PDF;
use Auth;
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
        return redirect('mes-factures/'.$input->service);
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
}
