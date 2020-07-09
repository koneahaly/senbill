<?php

namespace App\Console;

use App\Contact;
use App\Subscription;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

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

      $faker = Faker::create('fr_FR');
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
      fclose($fp);

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
