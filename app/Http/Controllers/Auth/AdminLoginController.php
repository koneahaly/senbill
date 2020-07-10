<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest:admin');
	}
    public function showLoginForm()
    {
    	return view('auth.admin-login');
    }

		public function display_dashboard()
    {
    	return view('auth.dashboardLogin');
    }

    public function login(Request $request)
    {
    	$this->validate($request,[
    		'email'=> 'required|email',
    		'password' => 'required|min:6'
    	]);
    	if(Auth::guard('admin')->attempt(['email' => $request->email,'password' =>$request->password],$request->remember))
    	{
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	return $this->sendFailedLoginResponse($request);
    }

		public function dashboardLogin(Request $input)
    {
    	$this->validate($input,[
    		'email'=> 'required|email',
    		'password' => 'required|min:6'
    	]);
    	if(Auth::guard('partner')->attempt(['email' => $input->email,'password' =>$input->password],$input->remember))
    	{
				Session::put('email_partner', $input->email);
				$infos_partenaires['infos_partenaires'] = DB::connection('mysql2')->table('partners')->where('email',$input->email)->first();
				foreach ($infos_partenaires as $info_partenaire) {
					Session::put('social_name', $info_partenaire->social_name);
					Session::put('partner_id', $info_partenaire->id);
				}
				return view('dashboard.dashboardWelcome')->with($infos_partenaires);
    	}
    	return $this->sendFailedLoginResponse($input);
    }

		public function display_panel()
    {
				$infos_partenaires['infos_partenaires'] = DB::connection('mysql2')->table('partners')->where('email',session()->get('email_partner'))->first();
				return view('dashboard.dashboardWelcome')->with($infos_partenaires);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    public function username()
    {
        return 'email';
    }
}
