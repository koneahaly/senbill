<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email() {
      $data = array('name'=>"Virat Gandhi");

      Mail::send(['text'=>'emails.contact'], $data, function($message) {
         $message->to('koneahaly@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('admin@services2sn.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function html_email($email,$customer,$name='SEN BILL') {
      $data = array('name'=>$name,'email' => $email,'customer' => $customer);
      Mail::send('emails.contact', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
            ('Inscription sur SenBill réussie');
         $message->from('admin@services2sn.com', $data['name']);
      });
      //echo "HTML Email Sent. Check your inbox.";
   }

   public function html_email_pro($email,$customer,$proprio,$mdp,$name='SEN BILL') {
      $data = array('name'=>$name,'email' => $email,'customer' => $customer,
      'proprio' => $proprio,'mdp' => $mdp);
      Mail::send('emails.contact-pro', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
            ('Inscription sur SenBill réussie');
         $message->from('admin@services2sn.com', $data['name']);
      });
      //echo "HTML Email Sent. Check your inbox.";
   }

   public function contact_email(Request $request, $name='SEN BILL') {
      $data = array('name'=>$name,'email' => $request->email,'client' => $request->client,
      'phone' => $request->phone,'msg' => $request->msg, 'proprio' => $request->proprio);
      Mail::send('emails.contact-loc', $data, function($message) use ($data){
         $message->to($data['email'], $data['client'])->subject
            ('Demande de location depuis SENBILL');
         $message->from('admin@services2sn.com', $data['name']);
      });
      return redirect()->back()->withSuccess('Votre message a été envoyé avec succès!');
      //echo "HTML Email Sent. Check your inbox.";
   }


   public function html_verify_email($email,$customer,$name='SEN BILL') {
      $data = array('name'=>$name,'email' => $email, 'customer' => $customer);
      Mail::send('emails.validateEmail', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
         ('Vérification de votre adresse mail');
         $message->from('admin@services2sn.com',$data['name']);
      });
      //echo "HTML Email Sent. Check your inbox.";
   }
   public function paymentOK_email($email,$order_number,$amount,$payment_method,$customer,$service,$name='SEN BILL') {
      $data = array('email' => $email, 'order_number' => $order_number,
      'amount' => $amount, 'payment_method' => $payment_method, 'customer' => $customer,
      'service' => $service,'name'=>"SENBILL");
      Mail::send('emails.paymentSuccessful', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
            ('Paiement effectué avec succès');
         $message->from('admin@services2sn.com',$data['name']);
      });
      //echo "HTML Payment Email Sent. Check your inbox.";
   }
   public function newBill_email($email,$order_number,$amount,$deadline,$customer,$service,$name='SEN BILL') {
      $data = array('email' => $email, 'order_number' => $order_number,
      'amount' => $amount, 'deadline' => $deadline, 'customer' => $customer,
      'service' => $service,'name'=>"SENBILL");
      Mail::send('emails.newBill', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
            ('Une nouvelle facture disponible depuis votre espace client');
         $message->from('admin@services2sn.com',$data['name']);
      });
     // echo "HTML new Bill Email Sent. Check your inbox.";
   }
   public function lateBill_email() {
      $data = array('name'=>"SENBILL", 'email' => $email, 'customer' => $customer);
      Mail::send('emails.lateBill', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
            ('Echeance facture dépassée');
         $message->from('admin@services2sn.com',$data['name']);
      });
      //echo "HTML late Bill Email Sent. Check your inbox.";
   }
   public function validate_email() {
      $data = array('name'=>"SENBILL");
      Mail::send('emails.validateEmail', $data, function($message) use ($data){
         $message->to('yacinenana@gmail.com', 'Yacine Ndiaye')->subject
            ('Vérification de votre  adresse mail');
         $message->from('admin@services2sn.com','SEN BILL');
      });
      echo "HTML late Bill Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }

   public function verify_email(Request $request){
      $mail_to_verify =explode('/',$_SERVER['REQUEST_URI']);
      DB::table('users')
          ->where('email', $mail_to_verify[2])
          ->update(['date_verify_email' => now()]);
          return view('verify-email');
    }

}
