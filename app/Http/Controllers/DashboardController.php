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
use App\Contact;
use App\Subscription;
use App\Invoice;
use App\Importation;
use Faker\Factory as Faker;
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
      if(session()->get('service_id') != 4 AND session()->get('service_id') != 5)
        $infos_contacts['infos_contacts'] = DB::connection('mysql2')->table('contacts')->join('subscriptions', 'contacts.id', '=', 'subscriptions.contact_id')->where('subscriptions.partner_id',session()->get('partner_id'))->get();
      
      if(session()->get('service_id') == 5)
        $infos_contacts['infos_contacts'] = DB::table('users')->join('services', 'users.customerId', '=', 'services.customerId')->where('services.service_5','locataire')->Orwhere('services.service_6','proprietaire')->get();
        
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      return view('dashboard.usersDashboard')->with($infos_contacts)->with($offer);
    }
    public function transactions_dashboard()
    {
      if(session()->get('service_id') != 4 AND session()->get('service_id') != 5){
        $transactions['transactions'] = DB::connection('mysql2')->table('invoices')->join('contacts', 'contacts.customerId', '=', 'invoices.customerId')
        ->select('contacts.first_name as first_name', 'contacts.last_name as last_name','contacts.customerId as customerId','invoices.created_at as created_at','invoices.payment_status as payment_status','invoices.payment_method as payment_method','invoices.paid_amount as paid_amount')
        ->where('partner_id',session()->get('partner_id'))->where('payment_status','Payée')->get();
        $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
        return view('dashboard.transactionsDashboard')->with($transactions)->with($offer);
      }

      if(session()->get('service_id') == 5){
        $transactions['transactions'] = DB::table('owns')
        ->join('users', 'users.customerId', '=', 'owns.owner_id')
        ->select('users.first_name as first_name', 'users.name as last_name','users.phone as phone','users.email as email','users.address as physical_address','users.customerId as customer_id','owns.*')
        ->where('owns.status','<>','D')
        ->orderby('owns.id','desc')
        ->get();
        $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
        return view('dashboard.transactionsDashboard')->with($transactions)->with($offer);
      }

      if(session()->get('service_id') == 4){
        $transactions['transactions'] = DB::table('demands')
        ->join('demand_infos','demands.id','=','demand_infos.request_id')
        ->leftJoin('services_public','demands.request_service_name','=','services_public.code')
        ->join('sp_type as sty', function ($join) {
          $join->on('sty.code', '=', 'demands.request_type')
          ->On('sty.sp_id', '=', 'services_public.id');
      })
        ->select('demands.*','demands.id as demands_id','demands.created_at as demands_created_at', 'demands.status as demands_status', 'demand_infos.*','sty.label as sp_label', 'services_public.*')
        ->where('demands.status','=','A')->get();      

      $pjs['pjs'] = array();
      foreach($transactions as $transaction ){
        foreach($transaction as $tr){
          $tr_images['tr_images'] = DB::table('demand_pjs')->where('request_id',$tr->demands_id)->get();
          if(count($tr_images['tr_images']) > 0) #avoid having some empty list
            array_push($pjs['pjs'],$tr_images['tr_images']);
        }
      }
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      return view('dashboard.transactionsDashboard')->with($transactions)->with($offer)->with($pjs);
      }
    }

    public function update_transactions_dashboard(Request $request)
    {
      if($request->action == 'Decline'){
        DB::table('demands')
              ->where('id', $request->id_demand_to_treat)
              ->update(['status' => 'D', 'comment' => $request->comments]);
      }
      if($request->action == 'Accept'){

        $faker = Faker::create('fr_FR');
        $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $one_more_year = date("m") == 12 ? '+1' : '+0';
        $raw_order_number = $faker->vat;
        $order_number = str_replace(' ', '', $raw_order_number);
        $amount  = 220;
        $delay = date('Y-m-d H:i:s', strtotime(' + 7 days'));

        DB::table('demands')
              ->where('id', $request->id_demand_to_treat)
              ->update(['status' => 'P', 'order_number' => $order_number, 'deadline' => $request->deadline]);

        Bill::updateOrCreate([
          'customerId' => str_replace('"','',$request->requester_id), 'order_number' => str_replace('"','',$order_number),
        ], ['customerId' => str_replace('"','',$request->requester_id), 'order_number' => str_replace('"','',$order_number),
        'title' => str_replace('"','','servicepublic'),'deadline' => $delay, 'status' => 'En attente',
        'amount' => str_replace('"','', $amount), 'created_at' => date('Y-m-d H:i:s'),
        'month' => str_replace('"','',$months[intval(date("m",strtotime('+1 month')))-1]), 'year' => str_replace('"','',date("Y", strtotime($one_more_year.' year'))),
        'updated_at' => date('Y-m-d H:i:s')]);

        //maybe feed Invoices ?
      }
      return redirect()->back()->with('message', 'La demande n° '.$request->id_demand_to_treat.' a été traitée avec succès, un sms de notification vient d\'être envoyé au demandeur !');

    }

    public function bills_dashboard()
    {
      if(session()->get('service_id') != 6){
        $infos_factures['infos_factures'] = DB::connection('mysql2')->table('invoices')->join('contacts', 'contacts.customerId', '=', 'invoices.customerId')->select('contacts.first_name as first_name', 'contacts.last_name as last_name','contacts.customerId as customerId','invoices.created_at as created_at','invoices.payment_due_date as deadline','invoices.payment_status as payment_status')->where('partner_id',session()->get('partner_id'))->get();
        $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
        return view('dashboard.billsDashboard')->with($infos_factures)->with($offer);
      }

      if(session()->get('service_id') == 6){
        $clause_status = 'P';
        if(strpos($_SERVER['REQUEST_URI'],'declined') !== false){
          $clause_status = "D";
        }
        if(strpos($_SERVER['REQUEST_URI'],'finished') !== false){
          $clause_status = "T";
        }

        $infos_factures['infos_factures'] = DB::table('demands')
        ->join('demand_infos','demands.id','=','demand_infos.request_id')
        ->leftJoin('services_public','demands.request_service_name','=','services_public.code')
        ->join('sp_type as sty', function ($join) {
          $join->on('sty.code', '=', 'demands.request_type')
          ->On('sty.sp_id', '=', 'services_public.id');
      })
        ->select('demands.*','demands.id as demands_id','demands.created_at as demands_created_at', 'demands.status as demands_status', 'demand_infos.*','sty.label as sp_label', 'services_public.*')
        ->where('demands.status','=',$clause_status)->get();
      

        $pjs['pjs'] = array();
        foreach($infos_factures as $infos_facture ){
          foreach($infos_facture as $fac){
            $tr_images['tr_images'] = DB::table('demand_pjs')->where('request_id',$fac->demands_id)->get();
            if(count($tr_images['tr_images']) > 0) #avoid having some empty list
              array_push($pjs['pjs'],$tr_images['tr_images']);
            }
        }
      }
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      return view('dashboard.billsDashboard')->with($infos_factures)->with($offer)->with($pjs);
    }

    public function update_bills_dashboard(Request $request)
    {
      if($request->action == 'Cancel'){
        DB::table('demands')
              ->where('id', $request->id_demand_to_treat)
              ->update(['status' => 'D', 'cancellation_motive' => $request->comments]);
      }
      if($request->action == 'Validate'){
        DB::table('demands')
              ->where('id', $request->id_demand_to_treat)
              ->update(['status' => 'T', 'validation_motive' => $request->comments]);

        $order_number = DB::table('demands')->select('order_number')->where('id',$request->id_demand_to_treat)->first();
        $payment_method = 'cash'; //à récupérer après le payment
        DB::table('bills')
              ->where([['order_number', $order_number->order_number]])
              ->update(['status' => 'paid','payment_method' => $payment_method]);


        //maybe feed Invoices ?
      }
      return redirect()->back()->with('message', 'La demande n° '.$request->id_demand_to_treat.' a été traitée avec succès, un sms de notification vient d\'être envoyé au demandeur !');

    }

    public function reports_dashboard()
    {
      $infos_reports['infos_reports'] = DB::table('reports')->where('status','A')->get();
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      return view('dashboard.reportsDashboard')->with($infos_reports)->with($offer);


    }

    public function profile_dashboard()
    {
      $infos_company['infos_company'] = DB::connection('mysql2')->table('partners')->where('id',session()->get('partner_id'))->first();
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      return view('dashboard.profileDashboard')->with($infos_company)->with($offer);
    }

    public function change_password(Request $request){
      if(Auth::guard('partner')->attempt(['email' => $request->email,'password' =>$request->current_password],$request->remember))
    	{
        DB::connection('mysql2')->table('partners')
            ->where('email', $request->email)
            ->update(['password' => bcrypt($request->new_password)]);
        return redirect()->intended(route('profile.dashboard'));
      }
      return redirect()->intended(route('profile.dashboard',['password' => 'error']))->with('message', 'Le mot de passe renseigné n\'est pas correct.');
    }

    public function company_dashboard()
    {
      //$this->download_contacts_tpl();
      $infos_company['infos_company'] = DB::connection('mysql2')->table('partners')->where('id',session()->get('partner_id'))->first();
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      return view('dashboard.companyDashboard')->with($infos_company)->with($offer);
    }

    public function download_contacts_tpl()
    {

      $fileName = base_path("storage/template/contacts_tpl.csv");
      if (file_exists($fileName)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        readfile($fileName);
        exit;
      }
  }

    public function import_dashboard()
    {
      if(strpos($_SERVER['REQUEST_URI'],'download_contacts_tpl') !== false){
        $this->download_contacts_tpl();
      }
      if(strpos($_SERVER['REQUEST_URI'],'download_invoices_tpl') !== false){
        $this->download_invoices_tpl();
      }

      $infos_imports['infos_imports'] = DB::connection('mysql2')->table('importations')->where('provider',session()->get('social_name'))->get();
      $offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',session()->get('service_id'))->first();
      
      return view('dashboard.importDashboard')->with($infos_imports)->with($offer);
    }


  public function download_invoices_tpl()
  {
      $fileName = base_path("storage/template/invoices_tpl.csv");

      if (file_exists($fileName)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        readfile($fileName);
        exit;
      }
  }

  public function read_header($file){
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            //echo "<p> $num fields in line $row: <br /></p>\n";
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
            }
            $header = $data;
            fclose($handle);
            return $header;
        }
    }
  }

  public function load_contacts(Request $request){
    $filename = 'contacts'.date('YmdHis').'.csv';
    if($request->file->isValid() && $request->file->getClientOriginalExtension() == 'csv'){
      Storage::disk('pending_contacts')->put($filename,file_get_contents($request->file));
      $data = $this->read_header(base_path('storage/pending_contacts/'.$filename));
      return redirect()->intended(route('import.dashboard', ['name' => session()->get('social_name'),'id' => '2_success', 'data_contacts' => $data,'file_to_import' => $filename]));
    }
    else{
      return redirect()->intended(route('import.dashboard', ['name' => session()->get('social_name'),'id' => '2_error']));
    }
  }
  public function load_invoices(Request $request){
    $filename = 'invoices'.date('YmdHis').'.csv';
    if($request->file->isValid() && $request->file->getClientOriginalExtension() == 'csv'){
      Storage::disk('pending_invoices')->put($filename,file_get_contents($request->file));
      $data = $this->read_header(base_path('storage/pending_invoices/'.$filename));
      return redirect()->intended(route('import.dashboard', ['name' => session()->get('social_name'),'id' => '3_success', 'data_invoices' => $data,'file_to_import' => $filename]));
    }
    else{
      return redirect()->intended(route('import.dashboard', ['name' => session()->get('social_name'),'id' => '3_error']));
    }
  }

  public function fetch_field_index($fields, $search){
    $i = 0;
    foreach($fields as $field){
      if($field == $search)
        return $i;
      $i++;
    }
  }

  public function final_load_contacts(Request $request){
    $importation = new Importation;
    $importation->import_number = 'CLI'.date('YmdHis');
    $importation->import_type = 'Client';
    $importation->provider = session()->get('social_name');
    try{
      $fields = $request->input('fields');
      $index_customer_id = $this->fetch_field_index($fields, 'customerId');
      //$index_service_id = $this->fetch_field_index($fields, 'service_id');
      //$index_partner_id = $this->fetch_field_index($fields, 'partner_id');

      //dd($fields[0]);
      $path = base_path("storage/pending_contacts/".$request->file_to_import);
      foreach (array_slice(glob($path),0,2) as $file) {
          $data = array_map('str_getcsv', file($file));
          $i = 0;
          foreach($data as $row) {
              if($i > 0){
                Contact::updateOrCreate([
                    'customerId' => str_replace('"','',$row[$index_customer_id]), 'partner_id' => str_replace('"','',session()->get('partner_id'))
                ], ['customerId' => str_replace('"','',$row[$index_customer_id]), $fields[1] => str_replace('"','',$row[1]),'partner_id' => str_replace('"','',session()->get('partner_id')),$fields[2] => str_replace('"','',$row[2]), $fields[3] => $row[3],
                    $fields[4] => $row[4], $fields[5] => str_replace('"','',$row[5]), $fields[6] => str_replace('"','',$row[6]),
                    $fields[7] => str_replace('"','',$row[7]),$fields[8] => str_replace('"','',$row[8]), $fields[9] => str_replace('"','',$row[9]),
                      $fields[10] => str_replace('"','',$row[10])]);
                $contact_id = DB::connection('mysql2')->table('contacts')->where('customerId',str_replace('"','',$row[$index_customer_id]))->first();

                Subscription::updateOrCreate([
                    'service_id' => str_replace('"','',session()->get('service_id')), 'partner_id' => str_replace('"','',session()->get('partner_id')), 'customerId' => str_replace('"','',$row[$index_customer_id])
                ], ['service_id' => str_replace('"','',session()->get('service_id')), 'partner_id' => str_replace('"','',session()->get('partner_id')), 'customerId' => str_replace('"','',$row[$index_customer_id]),
                    $fields[11] => str_replace('"','',$row[11]),'contact_id' => $contact_id->id,$fields[7] => str_replace('"','',$row[7])]);
              }
              $i++;
          }
          //delete the file
          unlink($file);
      }
      $importation->status = 'Y';
      $importation->save();
      return redirect()->intended(route('import.dashboard',['name' => session()->get('social_name')]));
    } catch (Throwable $e) {
     report($e);
     $importation->status = 'N';
     $importation->save();
     return redirect()->intended(route('import.dashboard',['name' => session()->get('social_name'),'error' => $e]));
   }
  }

  public function final_load_invoices(Request $request){
    $importation = new Importation;
    $importation->import_number = 'FAC'.date('YmdHis');
    $importation->import_type = 'Facture';
    $importation->provider = session()->get('social_name');
    try{
      $fields = $request->input('fields');
      $index_customer_id = $this->fetch_field_index($fields, 'customerId');
      $index_order_number = $this->fetch_field_index($fields, 'order_number');
      //$index_partner_id = $this->fetch_field_index($fields, 'partner_id');
      $index_title = $this->fetch_field_index($fields, 'title');
      $index_deadline = $this->fetch_field_index($fields, 'payment_due_date');
      $index_payment_status = $this->fetch_field_index($fields, 'payment_status');
      $index_payment_method = $this->fetch_field_index($fields, 'payment_method');
      $index_paid_amount = $this->fetch_field_index($fields, 'paid_amount');

      $index_month = $this->fetch_field_index($fields, 'month');
      $index_year = $this->fetch_field_index($fields, 'year');


      //dd($fields[0]);
      $path = base_path("storage/pending_invoices/".$request->file_to_import);
      foreach (array_slice(glob($path),0,2) as $file) {
          $data = array_map('str_getcsv', file($file));
          $i = 0;
          foreach($data as $row) {
              if($i > 0){
                Invoice::updateOrCreate([
                    'customerId' => str_replace('"','',$row[$index_customer_id]), 'order_number' => str_replace('"','',$row[$index_order_number]),
                ], ['customerId' => str_replace('"','',$row[$index_customer_id]), $fields[1] => str_replace('"','',$row[1]),$fields[2] => str_replace('"','',$row[2]), $fields[3] => $row[3],
                    $fields[4] => str_replace('"','',$row[4]), $fields[5] => str_replace('"','',$row[5]), $fields[6] => str_replace('"','',$row[6]),
                    $fields[7] => str_replace('"','',$row[7]),$fields[8] => str_replace('"','',$row[8]), $fields[9] => str_replace('"','',$row[9]),
                      $fields[10] => str_replace('"','',$row[10]), $fields[11] => str_replace('"','',$row[11]), 'provider' => session()->get('social_name')]);

                Bill::updateOrCreate([
                  'customerId' => str_replace('"','',$row[$index_customer_id]), 'order_number' => str_replace('"','',$row[$index_order_number]),
                ], ['customerId' => str_replace('"','',$row[$index_customer_id]), 'order_number' => str_replace('"','',$row[$index_order_number]),
                'title' => str_replace('"','',$row[$index_title]),'deadline' => str_replace('"','',$row[$index_deadline]), 'status' => $row[$index_payment_status],
                'payment_method' => str_replace('"','',$row[$index_payment_method]), 'amount' => str_replace('"','',$row[$index_paid_amount]), 'created_at' => date('Y-m-d H:i:s'),
                'month' => str_replace('"','',$row[$index_month]), 'year' => str_replace('"','',$row[$index_year]),
                'updated_at' => date('Y-m-d H:i:s')]);
              }
              $i++;
          }
          //delete the file
          unlink($file);
      }
      $importation->status = 'Y';
      $importation->save();
      return redirect()->intended(route('import.dashboard',['name' => session()->get('social_name')]));
    } catch (Throwable $e) {
     report($e);
     $importation->status = 'N';
     $importation->save();
     return redirect()->intended(route('import.dashboard',['name' => session()->get('social_name'),'error' => $e]));
   }
  }


}
