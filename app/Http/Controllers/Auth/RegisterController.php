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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            'email' => $data['email'],
            'phone' => $data['phone'],
            'customerId' =>$data['customerId'],
            'user_type' =>$data['user_type'],
            'address' =>$data['address'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function create_users_demo() {

      $fp = fopen(storage_path('classical_users.txt'), 'w');
      $fc = fopen(storage_path('woyofal_users.txt'), 'w');
      for($i = 0; $i < 10; $i++) {
        $randomNumber = rand(100,999)+(2+$i**2)+(3+$i**3);
        if($i%2 == 0)
          $user_type = 1;
        else
          $user_type = 2;
          User::create([
              'name' => 'user'.$randomNumber,
              'email' => 'user'.$randomNumber.'@gmail.com',
              'phone' => '0659594346',
              'customerId' => hexdec(uniqid()),
              'user_type' => $user_type,
              'address' => '26 avenue duschene',
              'password' => bcrypt('demo123')
          ]);
          if($user_type == 2)
            fwrite($fp, 'user'.$randomNumber.'@gmail.com,');
          else
            fwrite($fc, 'user'.$randomNumber.'@gmail.com,');
      }
      fclose($fp);
      fclose($fc);
      return redirect('admin');
    }
}
