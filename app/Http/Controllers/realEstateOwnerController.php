<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Own;
use App\User;
use App\Image;
use App\Ref_building_scale;
use App\Service;
use App\Contract;
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




class realEstateOwnerController extends Controller
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


    public function display_transactions()
    {
      $s=Auth::user()->customerId;

      $user['user'] = DB::table('users')->where('customerId',$s)->first();
      $myuser = DB::table('users')->where('customerId',$s)->first();
      $profilNotif = 0;

      if(!empty($myuser->date_activation_code)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = 1;
      }

      if(!empty($myuser->date_verify_email)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = $profilNotif + 1;
      }
      Session::push('profilNotif', $profilNotif);

      $list_renter_id=array();
      $list_housings_infos = [];
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $infos_occupants=DB::table('owns')->select('occupant_id')->where('owner_id',$s)->get();
      $infos_housings=DB::table('owns')->select('occupant_id','current_occupant_name','title')->where('owner_id',$s)->get();
      foreach($infos_occupants as $infos_occupant){
        array_push($list_renter_id,$infos_occupant->occupant_id);
      }
      foreach($infos_housings as $infos_housing){
        $list_housings_infos[$infos_housing->occupant_id] = [$infos_housing->occupant_id,$infos_housing->current_occupant_name,$infos_housing->title];
      }
      $data_bills['data_bills'] =DB::table('bills')->whereIn('customerId',$list_renter_id)->whereNotNull('title')->get();
      $numberOfBillsNonPaid = (int)DB::table('bills')->where('status','<>','paid')->whereIn('customerId',$list_renter_id)->whereNotNull('title')->count();
      $data_infos_housing['data_infos_housing'] = $list_housings_infos;
      return view('ownerTransactions')->with($data_bills)->with($user)->with($data_infos_housing)->with(compact('numberOfBillsNonPaid'))->with($actived_services)->with(compact('profilNotif'));

    }
    public function display_locataires()
    {
      $s=Auth::user()->customerId;

      $user['user'] = DB::table('users')->where('customerId',$s)->first();
      $myuser = DB::table('users')->where('customerId',$s)->first();

      $profilNotif = 0;

      if(!empty($myuser->date_activation_code)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = 1;
      }

      if(!empty($myuser->date_verify_email)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = $profilNotif + 1;
      }
      Session::push('profilNotif', $profilNotif);

      $list_renter_id=array();
      $list_housings_title = [];
      $list_contracts_infos = [];
      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $data_contracts=DB::table('contracts')->where('owner_id',$s)->where('status','<>','D')->get();
      $infos_housings=DB::table('owns')->select('occupant_id','title')->where('owner_id',$s)->where('status','<>','D')->get();
      $infos_locations=DB::table('owns')->select('occupant_id')->where('owner_id',$s)->where('status','<>','D')->get();
      $nb_locataires=(int)DB::table('owns')->where('owner_id',$s)->where('status','N')->where('status','<>','D')->count();
      foreach($infos_locations as $infos_location){
        array_push($list_renter_id,$infos_location->occupant_id);
      }
      foreach($infos_housings as $infos_housing){
        $list_housings_title[$infos_housing->occupant_id] = $infos_housing->title;
      }
      foreach($data_contracts as $data_contract){
        $list_contracts_infos[$data_contract->renter_id] = [$data_contract->bail,$data_contract->monthly_pm,$data_contract->start_date,
        $data_contract->end_date,$data_contract->frequency,$data_contract->delay,$data_contract->status];
      }

      $data_locations['data_locations'] =DB::table('users')->whereIn('customerId',$list_renter_id)->get();
      $data_housing_title['data_housing_title'] = $list_housings_title;
      $data_contracts_compact['data_contracts_compact'] = $list_contracts_infos;
      return view('mes-locataires')->with($data_locations)->with($data_housing_title)->with($data_contracts_compact)->with('nb_locataires',$nb_locataires)->with($actived_services)->with(compact('profilNotif'));

    }
    public function display_properties()
    {
      $s=Auth::user()->customerId;

      $profilNotif = 0;

      if(!empty($myuser->date_activation_code)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = 1;
      }

      if(!empty($myuser->date_verify_email)){
        $profilNotif = $profilNotif + 0;
      }
      else{
        $profilNotif = $profilNotif + 1;
      }
      Session::push('profilNotif', $profilNotif);

      //DEBUT DEFAULT IMAGE DISPLAYING
      $photos_housing = Image::all()->where('status','<>','D');
      $images = [];
      foreach ($photos_housing as $key=>$photo) {
        $img_default_url = DB::table('images')->where('housing_id',$photo->housing_id)->get()->last();

        if($photo->url == $img_default_url->url){
            $images[] = [
              'id' => $photo->id,
              'housing_id' => $photo->housing_id,
              'name' =>  $photo->filename,
              'src' =>  $img_default_url->url
              ];
        }
      
      }
     
      $images_housing_id = array();
      foreach ($photos_housing as $key=>$photo) {
            $img_s[] = [
              'id' => $photo->id,
              'housing_id' => $photo->housing_id,
              'name' =>  $photo->filename,
              'src' =>  $photo->url
              ];
      }
      
      //END DEFAULT IMAGE DISPLAYING

      //bareme ref table
      $scales_housing = Ref_building_scale::all();

      $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
      $infos_perso['infos_perso']=DB::table('users')->where('customerId',$s)->first();
      $infos_log['infos_log']=DB::table('owns')->where('owner_id',$s)->where('status','<>','D')->get();
      $nb_log=(int)DB::table('owns')->where('owner_id',$s)->where('status','<>','D')->count();
      return view('ownerProperties')->with($infos_perso)->with($infos_log)->with('nb_log',$nb_log)->with($actived_services)->with(compact('profilNotif', 'images','img_s','scales_housing'));

    }

    public function add_housing(Request $given){
     
      //dd($given->strong_option_meuble_selected);
     //dd($given);
      $this->validate($given,[
          'title'=> 'required|min:4|max:255',
          'address'=> 'required|min:10|max:255',
          'city'=> 'required|min:3|max:45',
          'surface' => 'required|numeric',
          'strong_option_category_selected'=>'required',
          'monthly_pm'=>'required|numeric',
          'monthly_pm_rec'=>'required|numeric',
          'strong_option_fees_selected'=>'required',
          'strong_option_meuble_selected'=>'required',
          'file' => 'required|max:2048'
      ]);

      $s=Auth::user()->customerId;
      if (Own::create([
        'owner_id' => $s,
        'title' => $given->title,
        'address' => $given->address,
        'city' => $given->city,
        'surface' => $given->surface,
        'category' => $given->strong_option_category_selected,
        'monthly_pm' => $given->monthly_pm,
        'monthly_pm_rec' => $given->monthly_pm_rec,
        'fees' => $given->strong_option_fees_selected,
        'nb_rooms' => $given->strong_option_selected,
        'housing_type' => $given->strong_option_meuble_selected,
        'status' =>$given->status_housing,
      ])
      ){

        //dd($given->file('file'));
        if ($given->hasFile('file')) {
          $file_raw = $given->file('file');
	        $file = $file_raw;
          $imageName = $s."_".$given->title."_".$given->address."_".$file->getClientOriginalName();
          $path = $file->store('housingimages', 's3');
          $housing_id = Own::latest('id')->first();
          $upload = new Image();
          $upload->housing_id = $housing_id->id;
          $upload->filename = $imageName;
          $upload->url = Storage::disk('s3')->url($path);
          $upload->default_img_url = Storage::disk('s3')->url($path);
          $upload->save();
      }
    }
      return back()->withSuccess('Le logement a été correctement ajouté!');
      // return redirect()->back()->with('message', 'Le logement a Ã©tÃ© correctement ajoutÃ©!');
    }

  

    public function update_housing(Request $given){


        $this->validate($given,[
            'title'=> 'required|min:4|max:255',
            'address'=> 'required|min:10|max:255',
            'city'=> 'required|min:3|max:45',
            'strong_option_fees_selected'=>'required',
            'file' => 'image|max:2048'
        ]);

        $s=Auth::user()->customerId;
          DB::table('owns')
              ->where('owner_id', $s)->where('id',$given->housing_id_m)
              ->update(['title' => $given->title, 'address' => trim($given->address),'city' => $given->city,'fees' => $given->strong_option_fees_selected,
               'nb_rooms' => $given->strong_nb_rooms_housing,'housing_type' => $given->type_housing_m,'status' => $given->strong_status_housing]);

        if($given->status_housing_m == "Y"){
          DB::table('contracts')
              ->where('owner_id', $s)->where('id_own',$given->housing_id_m)
              ->update(['status' => 'N']);
        }

        if ($given->hasFile('file')) {
          $file = $given->file('file');
          $imageName = $s."_".$given->title."_".$given->address."_".$file->getClientOriginalName();
          $path = $given->file('file')->store('images', 's3');
          $upload = new Image();
          $upload->housing_id = $given->housing_id_m;
          $upload->filename = $imageName;
          $upload->url = Storage::disk('s3')->url($path);
          $upload->status = 'A';
          $upload->default_img_url = Storage::disk('s3')->url($path);
          $upload->save();
      }

        return redirect()->back()->with('message', 'Le logement a été correctement modifié!');
      }

      public function delete_housing(Request $given,$id){
        $s=Auth::user()->customerId;
        //dd($id);
        DB::table('owns')
            ->where('id',$id)
            ->update(['status' => 'D']);

        DB::table('contracts')
            ->where('id_own',$id)
            ->update(['status' => 'D']);

        return redirect()->intended(route('ownerProperties'));
      }

      public function delete_image(Request $given){

        DB::table('images')
            ->where('id',$given->image_id)
            ->update(['status' => 'D']);

        //Log::info('Mes informations 1.', ['data' => $given->data]);
        //Log::info('Mes informations 2.', ['data' => $given->request]);
        //Log::info('Mes informations 3.', ['data' => $given->image_id]);
      }

      public function add_occupant(Request $given){
        $s=Auth::user()->customerId;

        $given->validate([
            'name' => 'required|string|string|max:255',
            'first_name' => 'required|string|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|string|max:13|unique:users',
            'customerId' =>'required|string|max:25|min:10|unique:users',
            'monthly_pm' => 'required',
            'bail' => 'required',
            'start_date' =>'required',
        ]);

        $renter_check_id=DB::table('users')->select('customerId')->where('customerId',$given->customerId)->count();
        if($renter_check_id < 1){
          $occupant_id = $given->customerId;
          if(strpos($given->phone,'+221') !== false){
            $treat_phone = $given->phone;
          }
          else{
            $treat_phone = "+221".$given->phone;
          }
          User::create([
              'civilite' => $given->civilite,
              'name' => $given->name,
              'first_name' => $given->first_name,
              'email' => $given->email,
              'dob' => $given->dateOB,
              'pob' => $given->placeOB,
              'phone' => $treat_phone,
              'customerId' =>$given->customerId,
              'address' =>trim($given->housing_address),
              'password' => bcrypt($given->name.'123'),
            ]);

            $service = new Service;
            $service->customerId= $given->customerId;
            $service->service_5='locataire';
            $service->type_service_5='postpaid';
            $service->save();
        }
        $renter_id=DB::table('users')->select('customerId')->where('customerId',$given->customerId)->first();
        $info_own =  DB::table('owns')->select('*')->where('owner_id', $s)->where('id',$given->housing_id)->first();

        $contract = new Contract;
        $contract->id_own=$given->housing_id;
        $contract->owner_id=$s;
        $contract->renter_id=$renter_id->customerId;
        $contract->bail=$given->bail;
        $contract->monthly_pm=$given->monthly_pm;
        $contract->status='Y';
        $contract->fees=$info_own->fees;
        $contract->delay=$given->delay;
        $contract->start_date=$given->start_date;
        $contract->end_date=$given->end_date;
        $contract->frequency=$given->frequency;
        $contract->save();

        if($contract->bail > 0){

          $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'AoÃ»t', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
          $month_int = date('n') - 1; //to begin at zero as table index

          $faker = Faker::create('fr_FR');
          $order_number = $faker->vat;

          $bill = new Bill;
          $bill->customerId=$renter_id->customerId;
          $bill->initial=0;
          $bill->final=0;
          $bill->month=$months[$month_int];
          $bill->year=date("Y");
          $bill->units=0;
          $bill->order_number=$order_number;
          $bill->title="location";
          $bill->amount=$contract->bail + ($contract->bail * 0.035);
          $bill->status="En attente";
          $bill->save();

          //send mail notifaction for new bill
          $renter_infos=DB::table('users')->where('customerId',$renter_id->customerId)->first();
          $co = new MailController();
          $co->newBill_email($renter_infos->email,$order_number,$contract->bail + ($contract->bail * 0.035),date('Y-m-d'),$renter_infos->first_name.' '.$renter_infos->name,'location','SEN BILL');
        }

        DB::table('owns')
            ->where('owner_id', $s)->where('id',$given->housing_id)
            ->update(['status' => 'N','current_occupant_name' => $given->first_name.' '.$given->name,'occupant_id' => $given->customerId]);

            $proprio=DB::table('users')->where('customerId',$s)->first();

            $co = new MailController();
            $co->html_verify_email($given->email,$given->first_name.' '.$given->name,'SEN BILL');
            $co->html_email_pro($given->email,$given->first_name.' '.$given->name,$proprio->first_name.' '.$proprio->name,$given->name.'123','SEN BILL');

            return redirect()->back()->with('message', 'Le locataire a été correctement ajouté au logement, il recevra sous peu un email l\'invitant à  rejoindre Senbill pour payer ses factures!');
      }

      public function update_occupant(Request $given){
        $s=Auth::user()->customerId;

        $given->validate([
            'name' => 'required|string|string|max:255',
            'first_name' => 'required|string|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|string|max:13',
            'customerId' =>'required|string|max:25|min:10',
            'monthly_pm' => 'required',
            'bail' => 'required',
            'start_date' =>'required',
        ]);

        DB::table('users')
            ->where('customerId', $given->occupant_id)
            ->update(['civilite' => $given->civilite,'name' => $given->name,'first_name' => $given->first_name,'email' => $given->email,
          'dob' => $given->dateOB, 'pob' => $given->placeOB, 'phone' => $given->phone, 'customerId' => $given->customerId]);

        DB::table('owns')
            ->where('occupant_id',$given->occupant_id)
            ->update(['current_occupant_name' => $given->first_name.' '.$given->name]);

        DB::table('contracts')
            ->where('renter_id',$given->occupant_id)
            ->update(['bail' => $given->bail, 'monthly_pm' => $given->monthly_pm,
          'delay' =>$given->delay, 'start_date' => $given->start_date, 'end_date' => $given->end_date,
           'frequency' => $given->frequency]);

          return redirect()->back()->with('message', 'Le locataire a été correctement modifié');
      }

      public function delete_occupant(Request $given,$id){
        $s=Auth::user()->customerId;
        //dd($id);
        DB::table('contracts')
            ->where('renter_id',$id)
            ->update(['status' => 'D']);

        DB::table('owns')
            ->where('occupant_id',$id)
            ->update(['status' => 'N', 'occupant_id' => NULL]);

        return redirect()->intended(route('mes-locataires'));
      }

      public function display_log(Request $given, $id){
        $s=Auth::user()->customerId;
        $actived_services['actived_services'] = DB::table('services')->where('customerId',$s)->first();
        $infos_log['infos_log']=DB::table('owns')->where('id',$id)->first();
        $proprio_id = ($infos_log['infos_log'])->owner_id;
        $infos_pro['infos_pro']=DB::table('users')->where('customerId',$proprio_id)->first();
        $infos_img['infos_img']=DB::table('images')->where('housing_id',$id)->where('status','<>','D')->orderBy('id', 'asc')->get();
        return view('logement')->with($actived_services)->with($infos_log)->with($infos_img)->with($infos_pro);
      }
}
