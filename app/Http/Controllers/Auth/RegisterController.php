<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Storage;
//use Faker\Factory;
//use fzaninotto\faker;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/mes-services';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //dd($_POST);
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|string|max:10|unique:users',
            'customerId' =>'required|string|max:25|min:10|unique:users',
            'address' =>'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'customerId' =>$data['customerId'],
            'address' =>$data['address'],
            'password' => bcrypt($data['password']),
            'service_1' => (!empty($data['service_1'])) ? $data['service_1'] : 'NULL',
            'service_2' => (!empty($data['service_2'])) ? $data['service_2'] : 'NULL',
            'service_3' => (!empty($data['service_3'])) ? $data['service_3'] : 'NULL',
            'service_4' => (!empty($data['service_4'])) ? $data['service_4'] : 'NULL',
            'service_5' => (!empty($data['service_5'])) ? $data['service_5'] : 'NULL',
            'service_6' => (!empty($data['service_6'])) ? $data['service_6'] : 'NULL',
        ]);
    }

    public function create_users_demo() {

      $fp = fopen(storage_path('classical_users.txt'), 'w');
      $fc = fopen(storage_path('woyofal_users.txt'), 'w');
      $services = ['eau', 'electricite', 'tv', 'mobile', 'locataire', 'proprietaire'];
      for($i = 0; $i < 10; $i++) {
        $randomNumber = rand(100,999)+(2+$i**2)+(3+$i**3);
        if($i%2 == 0)
          $user_type = 1;
        else
          $user_type = 2;

        $service = rand(1,6);
        $service_index = $service -1;

          User::create([
              'name' => 'stat'.$randomNumber,
              'first_name' => 'stat'.$randomNumber,
              'email' => 'stat'.$randomNumber.'@gmail.com',
              'phone' => '0659594346',
              'customerId' => hexdec(uniqid()),
              'user_type' => $user_type,
              'address' => '26 avenue duschene',
              'password' => bcrypt('demo123'),
              'service_'.$service.'' => $services[$service_index]
          ]);
          if($user_type == 2)
            fwrite($fc, 'stat'.$randomNumber.'@gmail.com,');
          else
            fwrite($fp, 'stat'.$randomNumber.'@gmail.com,');
      }
      fclose($fp);
      fclose($fc);
      return redirect('admin');
    }

}
