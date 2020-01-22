<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $s=Auth::user()->customerId;
        $data['data']=DB::table('bills')->where('customerId',$s)->get();

        $raw_buys = file_get_contents("http://localhost/api_elec/buys/read.php?counter_number=".Auth::user()->customerId);
        $buys_treated = json_decode($raw_buys);
        $buys_init = array($buys_treated);
        $buys['buys'] = $buys_init[0];
        $months['months'] = array('January','February','March','April','May','June','July','August','September','October','November','December');


        if (Auth::user()->user_type != '2')
          return view('home',$data);
        else
          return view('home-woyofal',$buys)->with($buys)->with($months);
    }


    public function display_bills(Request $given)
    {
      $s=Auth::user()->customerId;
      if(Auth::user()->user_type != 2){
        $data['data']=DB::table('bills')->where('customerId',$s)->orderBy('id', 'DESC')->get();
        $last_row_data['last_row_data']=DB::table('bills')->where('customerId',$s)->orderBy('created_at', 'DESC')->first();
        return view('mes-factures')->with($data)->with($last_row_data);
      }
      if(Auth::user()->user_type == 2){
        $data['data']=DB::connection('mysql2')->table('buys')->where('counter_number',$s)->orderBy('id', 'DESC')->get();
        $last_row_data['last_row_data']=DB::connection('mysql2')->table('buys')->where('counter_number',$s)->orderBy('creation_date', 'DESC')->first();
        return view('mes-factures')->with($data)->with($last_row_data);
      }
    }

    public function display_contract()
    {
      return view('mon-contrat');
    }

    public function display_personal_infos()
    {
      return view('infos-personnelles');
    }
}
