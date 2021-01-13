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
      $infos_contacts['infos_contacts'] = DB::connection('mysql2')->table('contacts')->join('subscriptions', 'contacts.id', '=', 'subscriptions.contact_id')->where('subscriptions.partner_id',session()->get('partner_id'))->get();
      return view('dashboard.usersDashboard')->with($infos_contacts);
    }
    public function transactions_dashboard()
    {
      $transactions['transactions'] = DB::connection('mysql2')->table('invoices')->join('contacts', 'contacts.customerId', '=', 'invoices.customerId')
      ->select('contacts.first_name as first_name', 'contacts.last_name as last_name','contacts.customerId as customerId','invoices.created_at as created_at','invoices.payment_status as payment_status','invoices.payment_method as payment_method','invoices.paid_amount as paid_amount')
      ->where('provider',session()->get('social_name'))->where('payment_status','Payée')->get();
      return view('dashboard.transactionsDashboard')->with($transactions);
    }
    public function bills_dashboard()
    {
      $infos_factures['infos_factures'] = DB::connection('mysql2')->table('invoices')->join('contacts', 'contacts.customerId', '=', 'invoices.customerId')->select('contacts.first_name as first_name', 'contacts.last_name as last_name','contacts.customerId as customerId','invoices.created_at as created_at','invoices.payment_status as payment_status')->where('provider',session()->get('social_name'))->get();
      return view('dashboard.billsDashboard')->with($infos_factures);
    }
    public function profile_dashboard()
    {
      $infos_company['infos_company'] = DB::connection('mysql2')->table('partners')->where('social_name',session()->get('social_name'))->first();
      return view('dashboard.profileDashboard')->with($infos_company);
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
      $infos_company['infos_company'] = DB::connection('mysql2')->table('partners')->where('social_name',session()->get('social_name'))->first();
      return view('dashboard.companyDashboard')->with($infos_company);
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
      return view('dashboard.importDashboard')->with($infos_imports);
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
      $index_service_id = $this->fetch_field_index($fields, 'service_id');
      $index_partner_id = $this->fetch_field_index($fields, 'partner_id');

      //dd($fields[0]);
      $path = base_path("storage/pending_contacts/".$request->file_to_import);
      foreach (array_slice(glob($path),0,2) as $file) {
          $data = array_map('str_getcsv', file($file));
          $i = 0;
          foreach($data as $row) {
              if($i > 0){
                Contact::updateOrCreate([
                    'customerId' => str_replace('"','',$row[$index_customer_id]), 'partner_id' => str_replace('"','',$row[$index_partner_id])
                ], [$fields[1] => str_replace('"','',$row[1]),'partner_id' => str_replace('"','',$row[$index_partner_id]),$fields[2] => str_replace('"','',$row[2]), $fields[3] => $row[3],
                    $fields[4] => $row[4], $fields[5] => str_replace('"','',$row[5]), $fields[6] => str_replace('"','',$row[6]),
                    $fields[7] => str_replace('"','',$row[7]),$fields[12] => str_replace('"','',$row[12]), $fields[13] => str_replace('"','',$row[13]),
                      $fields[14] => str_replace('"','',$row[14])]);
                $contact_id = DB::connection('mysql2')->table('contacts')->where('customerId',str_replace('"','',$row[$index_customer_id]))->first();

                Subscription::updateOrCreate([
                    'service_id' => str_replace('"','',$row[$index_service_id]), 'partner_id' => str_replace('"','',$row[$index_partner_id]), 'customerId' => str_replace('"','',$row[$index_customer_id])
                ], [$fields[8] => str_replace('"','',$row[8]),'contact_id' => $contact_id->id,$fields[9] => str_replace('"','',$row[9]), $fields[0] => str_replace('"','',$row[0]),
                    $fields[10] => str_replace('"','',$row[10]), $fields[11] => str_replace('"','',$row[11])]);
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
                ], [$fields[1] => str_replace('"','',$row[1]),$fields[2] => str_replace('"','',$row[2]), $fields[3] => $row[3],
                    $fields[4] => str_replace('"','',$row[4]), $fields[5] => str_replace('"','',$row[5]), $fields[6] => str_replace('"','',$row[6]),
                    $fields[7] => str_replace('"','',$row[7]),$fields[8] => str_replace('"','',$row[8]), $fields[9] => str_replace('"','',$row[9]),
                      $fields[10] => str_replace('"','',$row[10]), $fields[11] => str_replace('"','',$row[11]), $fields[12] => str_replace('"','',$row[12])]);

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
