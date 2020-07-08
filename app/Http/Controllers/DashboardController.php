<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function welcome_dashboard()
    {
      return view('dashboard.dashboardWelcome');
    }

    public function clients_dashboard()
    {
      return view('dashboard.usersDashboard');
    }

}
