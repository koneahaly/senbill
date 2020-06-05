<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Bill;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }


    public function imports_bills(){
      $users['users']=DB::table('users')->where('email','like','user%')->orderBy('id', 'DESC')->get();
      //dd($users['users']);
      foreach($users['users'] as $vl){
        if($vl->user_type == 1){
          $bill = new Bill;
          $bill->customerId=$vl->customerId;
          $bill->initial=rand(0,40);
          $bill->final=rand(100,4000);
          $bill->month=date("F");
          $bill->year=date("Y");
          $bill->units=(integer)$bill->final-(integer)$bill->initial;
          $admin=DB::table('admins')->first();
          $rate=$admin->rate;
          $bill->amount=$bill->units * $rate;
          $bill->status="En attente";
          $bill->save();
        }
      }
      return redirect('admin');
    }

    public function imports_bills_previous_six_month(){
      $users['users']=DB::table('users')->where('email','like','stat%')->orderBy('id', 'DESC')->get();
      //dd($users['users']);
      $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      $month_int = date('n') - 1; //to begin at zero as table index
      $year_int = date('Y');

      for ($counter_months = 1; $counter_months <= 6; $counter_months++) {
        foreach($users['users'] as $vl){
          if($vl->user_type == 1){
            $bill = new Bill;
            $bill->customerId=$vl->customerId;
            $bill->initial=rand(0,40);
            $bill->final=rand(100,4000);
            $bill->month=$months[$month_int];
            $bill->year=$year_int;
            $bill->units=(integer)$bill->final-(integer)$bill->initial;
            $admin=DB::table('admins')->first();
            $rate=$admin->rate;
            $bill->amount=$bill->units * $rate;
            if($months[$month_int] == date('F'))
              $bill->status="En attente";
            else
              $bill->status="paid";
            $bill->save();
          }
        }
        $month_int = $month_int - 1;
        if($month_int == -1){
          $month_int = 11;
          $year_int = $year_int -1;
        }
      }
      return redirect('admin');
    }


}
