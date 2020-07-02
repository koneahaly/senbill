<?php

namespace App\Console;

use App\Contact;
use App\Subscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

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
      $schedule->call(function () {
        DB::table('bills')
            ->where([['status','En attente'],['deadline','<',date('Y-m-d H:i:s')]])
            ->update(['status' => 'Impayé']);

                //set the path for the csv files
          $path = base_path("storage/pending_contacts/*.csv");

          //run 2 loops at a time
          foreach (array_slice(glob($path),0,2) as $file) {

              //read the data into an array
              $data = array_map('str_getcsv', file($file));

              //loop over the data
              foreach($data as $row) {

                  //insert the record or update if the email already exists
                  Contact::updateOrCreate([
                      'customerId' => $row[0],
                  ], ['email' => $row[1],'phone' => $row[2], 'address_1' => $row[3],
                      'address_2' => $row[4], 'first_name' => $row[5], 'last_name' => $row[6],
                      'status' => $row[7],'salutation' => $row[12], 'dob' => $row[13],
                        'pob' => $row[14]]);
                  $contact_id = DB::connection('mysql2')->table('contacts')->where('customerId',$row[0])->first();

                  Subscription::updateOrCreate([
                      'service_id' => $row[8], 'partner_id' => $row[9], 'customerId' => $row[0]
                  ], ['service_id' => $row[8],'contact_id' => $contact_id->id,'partner_id' => $row[9], 'customerId' => $row[0],
                      'status' => $row[10], 'billing_period' => $row[11]]);
              }

              //delete the file
              unlink($file);
          }
        });

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
