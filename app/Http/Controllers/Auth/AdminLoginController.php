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

			$infos_global_partenaires['infos_global_partenaires'] = DB::connection('mysql2')->table('partners')->get();
			if($input->email == 'admin@elektra.sn' && $input->password == 'rootroot'){
				return view('partners')->with($infos_global_partenaires);
			}

    	if(Auth::guard('partner')->attempt(['email' => $input->email,'password' =>$input->password],$input->remember))
    	{
				Session::put('email_partner', $input->email);
				$infos_partenaires['infos_partenaires'] = DB::connection('mysql2')->table('partners')->where('email',$input->email)->first();
				foreach ($infos_partenaires as $info_partenaire) {
					Session::put('social_name', $info_partenaire->social_name);
					Session::put('partner_id', $info_partenaire->id);
					Session::put('service_id', $info_partenaire->service_id);
					Session::put('full_name', $info_partenaire->email);
				}
				$infos_partenaires['infos_partenaires'] = DB::connection('mysql2')->table('partners')->where('email',session()->get('email_partner'))->first();
				$nb_contacts['nb_contacts'] = DB::connection('mysql2')->table('contacts')->where('in_elektra','Y')->where('partner_id',Session::get('partner_id'))->count();
				$paid_amount['paid_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->sum('paid_amount');
				$pending_amount['pending_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','En attente')->where('provider',session()->get('social_name'))->sum('tot_payment_due');
				$unpaid_amount['unpaid_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Impayée')->where('provider',session()->get('social_name'))->sum('tot_payment_due');
				$nb_paid_amount['nb_paid_amount'] = DB::connection('mysql2')->table('invoices')->where('provider',session()->get('social_name'))->where('payment_status','Payée')->count();
				$nb_pending_amount['nb_pending_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','En attente')->where('provider',session()->get('social_name'))->count();
				$nb_unpaid_amount['nb_unpaid_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Impayée')->where('provider',session()->get('social_name'))->count();

				$nb_paid_om['nb_paid_om'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','OrangeMoney')->count();
				$nb_paid_cb['nb_paid_cb'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','CB')->count();
				$nb_paid_fc['nb_paid_fc'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','FreeCash')->count();
				$nb_paid_em['nb_paid_em'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','Emoney')->count();
				$nb_paid_wz['nb_paid_wz'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','Wizall')->count();


				$offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',$infos_partenaires['infos_partenaires']->service_id)->first();

				$infos_reports_c1['infos_reports_c1'] = DB::table('reports')->where('monthly_pm','<',150000)->where('status','A')->count();
				$infos_proprio_c1['infos_proprio_c1'] = DB::table('owns')->where('monthly_pm','<',150000)->where('status','<>','D')->count();
				$mean_price_c1['mean_price_c1'] = DB::table('owns')->where('monthly_pm','<',150000)->where('status','<>','D')->avg('monthly_pm');

				$infos_reports_c2['infos_reports_c2'] = DB::table('reports')->where('status','A')->where('monthly_pm','>',150000)->where('monthly_pm','<',500000)->count();
				$infos_proprio_c2['infos_proprio_c2'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',150000)->where('monthly_pm','<',500000)->count();
				$mean_price_c2['mean_price_c2'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',150000)->where('monthly_pm','<',500000)->avg('monthly_pm');

				$infos_reports_c3['infos_reports_c3'] = DB::table('reports')->where('status','A')->where('monthly_pm','>',500000)->count();
				$infos_proprio_c3['infos_proprio_c3'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',500000)->count();
				$mean_price_c3['mean_price_c3'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',500000)->avg('monthly_pm');

				$nb_contacts_proprio['nb_contacts_proprio'] = DB::table('users')->join('services', 'users.customerId', '=', 'services.customerId')->where('services.service_6','proprietaire')->count();
				$nb_contacts_loc['nb_contacts_loc'] = DB::table('users')->join('services', 'users.customerId', '=', 'services.customerId')->where('services.service_5','locataire')->count();

				//dd($offer['offer']);
				//dd($paid_amount['paid_amount']);
				return view('dashboard.dashboardWelcome')->with($infos_partenaires)->with($nb_contacts)
				->with($pending_amount)->with($paid_amount)->with($unpaid_amount)
				->with($nb_paid_amount)->with($nb_pending_amount)->with($nb_unpaid_amount)
				->with($nb_paid_om)->with($nb_paid_fc)->with($nb_paid_cb)->with($nb_paid_em)->with($nb_paid_wz)->with($offer)
				->with($infos_reports_c1)->with($infos_proprio_c1)->with($mean_price_c1)
				->with($infos_reports_c2)->with($infos_proprio_c2)->with($mean_price_c2)
				->with($infos_reports_c3)->with($infos_proprio_c3)->with($mean_price_c3)
				->with($nb_contacts_proprio)->with($nb_contacts_loc);
    	}
    	return $this->sendFailedLoginResponse($input);
    }

		public function display_panel()
    {
		$infos_partenaires['infos_partenaires'] = DB::connection('mysql2')->table('partners')->where('email',session()->get('email_partner'))->first();
		$nb_contacts['nb_contacts'] = DB::connection('mysql2')->table('contacts')->where('in_elektra','Y')->where('partner_id',Session::get('partner_id'))->count();
		$paid_amount['paid_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->sum('paid_amount');
		$pending_amount['pending_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','En attente')->where('provider',session()->get('social_name'))->sum('tot_payment_due');
		$unpaid_amount['unpaid_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Impayée')->where('provider',session()->get('social_name'))->sum('tot_payment_due');
		$nb_paid_amount['nb_paid_amount'] = DB::connection('mysql2')->table('invoices')->where('provider',session()->get('social_name'))->where('payment_status','Payée')->count();
		$nb_pending_amount['nb_pending_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','En attente')->where('provider',session()->get('social_name'))->count();
		$nb_unpaid_amount['nb_unpaid_amount'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Impayée')->where('provider',session()->get('social_name'))->count();

		$nb_paid_om['nb_paid_om'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','OrangeMoney')->count();
		$nb_paid_cb['nb_paid_cb'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','CB')->count();
		$nb_paid_fc['nb_paid_fc'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','FreeCash')->count();
		$nb_paid_em['nb_paid_em'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','Emoney')->count();
		$nb_paid_wz['nb_paid_wz'] = DB::connection('mysql2')->table('invoices')->where('payment_status','Payée')->where('provider',session()->get('social_name'))->where('payment_method','Wizall')->count();

		$offer['offer'] = DB::connection('mysql2')->table('offers')->where('id',$infos_partenaires['infos_partenaires']->service_id)->first();

		$infos_reports_c1['infos_reports_c1'] = DB::table('reports')->where('monthly_pm','<',150000)->where('status','A')->count();
		$infos_proprio_c1['infos_proprio_c1'] = DB::table('owns')->where('monthly_pm','<',150000)->where('status','<>','D')->count();
		$mean_price_c1['mean_price_c1'] = DB::table('owns')->where('monthly_pm','<',150000)->where('status','<>','D')->avg('monthly_pm');

		$infos_reports_c2['infos_reports_c2'] = DB::table('reports')->where('status','A')->where('monthly_pm','>',150000)->where('monthly_pm','<',500000)->count();
		$infos_proprio_c2['infos_proprio_c2'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',150000)->where('monthly_pm','<',500000)->count();
		$mean_price_c2['mean_price_c2'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',150000)->where('monthly_pm','<',500000)->avg('monthly_pm');

		$infos_reports_c3['infos_reports_c3'] = DB::table('reports')->where('status','A')->where('monthly_pm','>',500000)->count();
		$infos_proprio_c3['infos_proprio_c3'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',500000)->count();
		$mean_price_c3['mean_price_c3'] = DB::table('owns')->where('status','<>','D')->where('monthly_pm','>',500000)->avg('monthly_pm');

		$nb_contacts_proprio['nb_contacts_proprio'] = DB::table('users')->join('services', 'users.customerId', '=', 'services.customerId')->where('services.service_6','proprietaire')->count();
		$nb_contacts_loc['nb_contacts_loc'] = DB::table('users')->join('services', 'users.customerId', '=', 'services.customerId')->where('services.service_5','locataire')->count();

				//dd($offer['offer']);
				return view('dashboard.dashboardWelcome')->with($infos_partenaires)->with($nb_contacts)
				->with($pending_amount)->with($paid_amount)->with($unpaid_amount)
				->with($nb_paid_amount)->with($nb_pending_amount)->with($nb_unpaid_amount)
				->with($nb_paid_om)->with($nb_paid_fc)->with($nb_paid_cb)->with($nb_paid_em)->with($nb_paid_wz)->with($offer)
				->with($infos_reports_c1)->with($infos_proprio_c1)->with($mean_price_c1)
				->with($infos_reports_c2)->with($infos_proprio_c2)->with($mean_price_c2)
				->with($infos_reports_c3)->with($infos_proprio_c3)->with($mean_price_c3)
				->with($nb_contacts_proprio)->with($nb_contacts_loc);
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
