<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Own;
use App\User;
use App\Image;
use App\Service;
use App\Contract;
use App\Demand;
use App\Demand_info;
use App\Demand_pj;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\middleware\StartSession;
use App\Http\Controllers\MailController;
use Illuminate\Mail\Mailable;
use stdClass;
use Session;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;




class ServicePublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function display_requests()
    {
      $s=Auth::user()->customerId;
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      $infos_demand['infos_demand']=DB::table('demands')
      ->join('demand_infos','demands.id','=','demand_infos.request_id')
      ->leftJoin('services_public','demands.request_service_name','=','services_public.code')
      ->join('sp_type as sty', function ($join) {
        $join->on('sty.code', '=', 'demands.request_type')
        ->On('sty.sp_id', '=', 'services_public.id');
    })
      ->select('demands.*','sty.label as sp_label')->where('demands.customer_id',$s)->where('demands.status','<>','D')->get();
      $nb_dem=(int)DB::table('demands')->where('customer_id',$s)->where('status','<>','D')->count();
      return view('mes-demandes')->with($infos_perso)->with($actived_services)->with($infos_demand)->with(compact('nb_dem'));
    }

    public function submit_request(Request $given){

      $this->validate($given,[
        'service_type'=> 'required',
        'service_name'=> 'required',
        'request_type'=> 'required',
        'status'=>'required'
    ]);
    //dd($given->service_type.' '.$given->service_name.' '.$given->request_type.' '.$given->status);
    $s=Auth::user()->customerId;

    if (Demand::create([
      'customer_id' => $s,
      'request_service_type' => $given->service_type,
      'request_service_name' => $given->service_name,
      'request_type' => $given->request_type,
      'status' => $given->status,
    ])

    ){
      if(strpos($given->request_type,"Mairie") !== false){

        $request_infos = new Demand_info();
        $demand_id = Demand::latest('id')->first();
        $request_infos->request_id = $demand_id->id;
        $request_infos->first_name = $given->first_name;
        $request_infos->last_name = $given->last_name;
        $request_infos->dob = $given->dob;
        $request_infos->pob = $given->pob;
        $request_infos->phone = $given->phone;
        $request_infos->email = $given->email;
        $request_infos->physical_address = $given->physical_address;
        $request_infos->father_first_name = $given->father_first_name;
        $request_infos->father_last_name = $given->father_last_name;
        $request_infos->mother_first_name = $given->mother_first_name;
        $request_infos->mother_last_name = $given->mother_last_name;
        $request_infos->description = $given->description;
        $request_infos->save();

        if ($given->hasFile('file')) {
          $file_raw = $given->file('file');
          $file = $file_raw;
          $imageName = $s."_".$given->service_name."_".$given->request_type."_".$file->getClientOriginalName();
          $path = $file->store('images', 's3');
          $demand_id = Demand::latest('id')->first();
          $upload = new Demand_pj();
          $upload->request_id = $demand_id->id;
          $upload->pj_name = $imageName;
          $upload->pj_link = Storage::disk('s3')->url($path);
          $upload->save();
      }

      }

    
  }
    return back()->with('message','Votre demande a été soumise avec succès aux autorités compétentes!');

    }

    public function update_request(Request $given){

      }

      public function display_demand(Request $given, $name,$id){
        $s=Auth::user()->customerId;
        $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
        $infos_dem['infos_dem']=DB::table('demands')
        ->join('demand_infos','demands.id','=','demand_infos.request_id')
        ->leftJoin('services_public','demands.request_service_name','=','services_public.code')
        ->join('sp_type as sty', function ($join) {
          $join->on('sty.code', '=', 'demands.request_type')
          ->On('sty.sp_id', '=', 'services_public.id');
      })
        ->select('demands.*','demand_infos.*','sty.label as sp_label', 'services_public.*')->where('demands.customer_id',$s)
        ->where('demands.id','=',$id)
        ->where('demands.status','<>','D')->first();
        $infos_pj['infos_pj']=DB::table('demand_pjs')->where('request_id',$id)->orderBy('id', 'asc')->get();
      //dd($infos_pj);
        return view('demande')->with($actived_services)->with($infos_pj)->with($infos_dem);
      }
}
