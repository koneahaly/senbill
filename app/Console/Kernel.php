<?php

namespace App\Console;

use App\Contact;
use App\Bill;
use App\Subscription;
use App\Invoice;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Http\Controllers\SmsController;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

      /*$faker = Faker::create('fr_FR');
      $fake_data= [];

      for ($i = 0; $i < 10; $i++) {
          $new_line = '"'.strval($faker->nir).'","'.strval($faker->unique()->email).'",'.$faker->phoneNumber.','.str_replace(',',' ',$faker->streetAddress).','.str_replace(',',' ',$faker->streetAddress).',"'.$faker->firstName.'","'.$faker->lastName.'","A",'.$faker->numberBetween($min = 1, $max = 4).',1,"A","bimestriel","Mr","18/11/1992","DAKAR"';
          array_push($fake_data,$new_line);
      }

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="sample.csv"');

      $fp = fopen(base_path("storage/pending_contacts/contacts.csv"), 'wb');
      foreach ( $fake_data as $line ) {
          $val = explode(",", $line);
          fputcsv($fp, $val,',','"');
      }
      fclose($fp);*/

      /* $fake_data_invoices= [];

      $infos_contacts = DB::connection('mysql2')->table('contacts')->join('subscriptions', 'contacts.id', '=', 'subscriptions.contact_id')->select('contacts.customerId as customerId', 'subscriptions.id as sid')->where('partner_id',4)->get();
      foreach($infos_contacts as $infos_contact){

        $new_line = '"'.strval($infos_contact->customerId).'","'.$infos_contact->sid.'","'.strval($faker->vat).'","'.$faker->randomElement($array = array ('Mensualité', 'Paiement Facture', 'Régularisation')).'",'.$faker->numberBetween($min = 1000, $max = 9000).','.$faker->numberBetween($min = 1000, $max = 9000).','.date('Y-m-d H:i:s', strtotime('+5 day', time())).',"","En attente","Akilee","1",'.$faker->numberBetween($min = 1000, $max = 9000).',""';
        array_push($fake_data_invoices,$new_line);
      }

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="sample.csv"');

      $fp = fopen(base_path("storage/pending_invoices/invoices.csv"), 'wb');
      foreach ( $fake_data_invoices as $line ) {
          $val = explode(",", $line);
          fputcsv($fp, $val,',','"');
      }
      fclose($fp);*/

      $schedule->call(function () {
        DB::table('bills')
            ->where([['status','En attente'],['deadline','<',date('Y-m-d H:i:s')]])
            ->update(['status' => 'Impayé']);

            $relances_impayees= DB::table('bills')
            ->where([['status','Impayé'],['attempt_number_inflation','<',3],['last_inflation_date','Impayé'],['deadline','<',date('Y-m-d H:i:s')]]);


                //set the path for the csv files
          /*$path = base_path("storage/pending_contacts/*.csv");

          //run 2 loops at a time
          foreach (array_slice(glob($path),0,2) as $file) {

              //read the data into an array
              $data = array_map('str_getcsv', file($file));

              //loop over the data
              foreach($data as $row) {

                  //insert the record or update if the email already exists
                  Contact::updateOrCreate([
                      'customerId' => str_replace('"','',$row[0]),
                  ], ['email' => str_replace('"','',$row[1]),'phone' => str_replace('"','',$row[2]), 'address_1' => $row[3],
                      'address_2' => $row[4], 'first_name' => str_replace('"','',$row[5]), 'last_name' => str_replace('"','',$row[6]),
                      'status' => str_replace('"','',$row[7]),'salutation' => str_replace('"','',$row[12]), 'dob' => str_replace('"','',$row[13]),
                        'pob' => str_replace('"','',$row[14])]);
                  $contact_id = DB::connection('mysql2')->table('contacts')->where('customerId',str_replace('"','',$row[0]))->first();

                  Subscription::updateOrCreate([
                      'service_id' => str_replace('"','',$row[8]), 'partner_id' => str_replace('"','',$row[9]), 'customerId' => str_replace('"','',$row[0])
                  ], ['service_id' => str_replace('"','',$row[8]),'contact_id' => $contact_id->id,'partner_id' => str_replace('"','',$row[9]), 'customerId' => str_replace('"','',$row[0]),
                      'status' => str_replace('"','',$row[10]), 'billing_period' => str_replace('"','',$row[11])]);
              }

              //delete the file
              unlink($file);
          }*/
        })->dailyAt('23:59');


        $schedule->call(function () {
                $relances_impayees= DB::table('bills')
                ->where([['status','Impayé'],['attempt_number_inflation','<',2],['deadline','<',date('Y-m-d H:i:s')]]);
                $message='';

                foreach($relances_impayees as $relance_impayee){
                    DB::table('bills')
                        ->where([['id',$relance_impayee->id]])
                        ->update(['attempt_number_inflation' => $relance_impayee->attempt_number_inflation + 1, 'last_inflation_date' => date('Y-m-d H:i:s')]);

                    $contacts_relances_impayees = DB::table('users')
                    ->where([['customerId',$relance_impayee->customerId]]);

                    $sms = new SmsController();
                    $sms->send_reflation($relance_impayee->phone,$contacts_relances_impayees->first_name,$relance_impayee->amount);


                }

        })->twiceMonthly(8, 13, '18:00');


        $schedule->call(function () {

            $faker = Faker::create('fr_FR');

            $actived_contracts= DB::table('contracts')
                ->where([['status','Y'], [DB::raw('CONCAT(substr(end_date, 7, 4),substr(end_date, 4, 2),substr(end_date, 1, 2))'),'>',date('Ymd')]])
                ->get();

            $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            
            // creation des factures tous les 27 du mois
            foreach($actived_contracts as $actived_contract){
                //gestion de la date de paiement de la facture
                $one_more_year = date("m") == 12 ? '+1' : '+0';
                $day_of_pay = $actived_contract->delay == 0 ? '01' : '0'.$actived_contract->delay;
                $delay= date("Y", strtotime($one_more_year.' year')).'-'.date("m",strtotime('+1 month')).'-'.$day_of_pay.' 23:59:00';
                $order_number = $faker->vat;
 
                Bill::updateOrCreate([
                    'customerId' => str_replace('"','',$actived_contract->renter_id), 'order_number' => str_replace('"','',$order_number),
                  ], ['customerId' => str_replace('"','',$actived_contract->renter_id), 'order_number' => str_replace('"','',$order_number),
                  'title' => str_replace('"','','location'),'deadline' => $delay, 'status' => 'En attente',
                  'amount' => str_replace('"','',$actived_contract->monthly_pm), 'created_at' => date('Y-m-d H:i:s'),
                  'month' => str_replace('"','',$months[intval(date("m",strtotime('+1 month')))]), 'year' => str_replace('"','',date("Y", strtotime($one_more_year.' year'))),
                  'updated_at' => date('Y-m-d H:i:s')]);
            }

                //var_dump($actived_contracts);
        })->monthlyOn(27, '18:00');;



       /* $path = base_path("storage/pending_invoices/*.csv");

        //run 2 loops at a time
        foreach (array_slice(glob($path),0,2) as $file) {

            //read the data into an array
            $data = array_map('str_getcsv', file($file));

            //loop over the data
            foreach($data as $row) {

                //insert the record or update if the email already exists
                Invoice::updateOrCreate([
                    'customerId' => str_replace('"','',$row[0]), 'order_number' => str_replace('"','',$row[2]),
                ], ['subscription_id' => str_replace('"','',$row[1]),'order_number' => str_replace('"','',$row[2]), 'title' => $row[3],
                    'min_payment_due' => str_replace('"','',$row[4]), 'tot_payment_due' => str_replace('"','',$row[5]), 'payment_due_date' => str_replace('"','',$row[6]),
                    'payment_method' => str_replace('"','',$row[7]),'payment_status' => str_replace('"','',$row[8]), 'provider' => str_replace('"','',$row[9]),
                      'import_status' => str_replace('"','',$row[10]), 'paid_amount' => str_replace('"','',$row[11]), 'bill' => str_replace('"','',$row[12])]);

            }

            //delete the file
            unlink($file);
        }*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
