<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use App\Bill;
use App\User;
use App\Offer;
use App\Partner;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function clients_dashboard()
    {
      $infos_contacts['infos_contacts'] = DB::connection('mysql2')->table('contacts')->join('subscriptions', 'contacts.id', '=', 'subscriptions.contact_id')->where('partner_id',session()->get('partner_id'))->get();
      return view('dashboard.usersDashboard')->with($infos_contacts);
    }
    public function transactions_dashboard()
    {
      return view('dashboard.transactionsDashboard');
    }
    public function bills_dashboard()
    {
      return view('dashboard.billsDashboard');
    }

}
