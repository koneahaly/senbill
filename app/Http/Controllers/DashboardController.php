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
use Illuminate\Support\Facades\Storage;

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
      $infos_factures['infos_factures'] = DB::connection('mysql2')->table('invoices')->join('contacts', 'contacts.customerId', '=', 'invoices.customerId')->select('contacts.first_name as first_name', 'contacts.last_name as last_name','contacts.customerId as customerId','invoices.created_at as created_at','invoices.payment_status as payment_status')->where('provider','Akilee')->get();
      return view('dashboard.billsDashboard')->with($infos_factures);
    }
    public function profile_dashboard()
    {
      return view('dashboard.profileDashboard');
    }
    public function company_dashboard()
    {
      return view('dashboard.companyDashboard');
    }
    public function import_dashboard()
    {
      return view('dashboard.importDashboard');
    }

    public function download_contacts_tpl()
    {
      $fileName = base_path("storage/template/contacts_tpl.csv");

      if ($fd = fopen ($fileName, "r")) {

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=contacts_template.csv");
        header("Expires: 0");
        header("Pragma: public");

        while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
        }

      fclose($fd);
    }
  }

  public function download_invoices_tpl()
  {
      $fileName = base_path("storage/template/invoices_tpl.csv");

      if ($fd = fopen ($fileName, "r")) {

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=invoices_template.csv");
        header("Expires: 0");
        header("Pragma: public");

        while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
        }

      fclose($fd);
    }
  }

  public function load_contacts(Request $request){
    //dd($request->file);
    Storage::disk('pending_contacts')->put('contacts'.date('YmdHis').'.csv',file_get_contents($request->file));
    //$request->file->store("storage/pending_contacts");
    return redirect()->intended(route('import.dashboard'));
  }
  public function load_invoices(Request $request){
    Storage::disk('pending_invoices')->put('invoices'.date('YmdHis').'.csv',file_get_contents($request->file));
    return redirect()->intended(route('import.dashboard'));
  }

}
