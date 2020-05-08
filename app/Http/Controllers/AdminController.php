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
          $bill->month="May";
          $bill->year=date("Y");
          $bill->units=(integer)$bill->final-(integer)$bill->initial;
          $admin=DB::table('admins')->first();
          $rate=$admin->rate;
          $bill->amount=$bill->units * $rate;
          $bill->status="Unpaid";
          $bill->save();
        }
      }
      return redirect('admin');
    }


}
