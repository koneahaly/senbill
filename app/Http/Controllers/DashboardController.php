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

  public function read_header($file){
    $row = 1;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            echo "<p> $num fields in line $row: <br /></p>\n";
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
      return redirect()->intended(route('import.dashboard', ['id' => '2_success', 'data_contacts' => $data,'file_to_import' => $filename]));
    }
    else{
      return redirect()->intended(route('import.dashboard', ['id' => '2_error']));
    }
  }
  public function load_invoices(Request $request){
    $filename = 'invoices'.date('YmdHis').'.csv';
    if($request->file->isValid() && $request->file->getClientOriginalExtension() == 'csv'){
      Storage::disk('pending_invoices')->put($filename,file_get_contents($request->file));
      $data = $this->read_header(base_path('storage/pending_invoices/'.$filename));
      return redirect()->intended(route('import.dashboard', ['id' => '3_success', 'data_invoices' => $data]));
    }
    else{
      return redirect()->intended(route('import.dashboard', ['id' => '3_error']));
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
                    'customerId' => str_replace('"','',$row[$index_customer_id]),
                ], [$fields[1] => str_replace('"','',$row[1]),$fields[2] => str_replace('"','',$row[2]), $fields[3] => $row[3],
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

      return redirect()->intended(route('import.dashboard'));
    } catch (Throwable $e) {
     report($e);
     return redirect()->intended(route('import.dashboard',['error' => $e]));
   }
  }

  public function final_load_invoices(Request $request){

    return redirect()->intended(route('import.dashboard'));
  }


}
