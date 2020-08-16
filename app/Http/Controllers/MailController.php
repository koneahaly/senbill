<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
   public function html_verify_email($email,$customer,$name='SEN BILL') {
      $data = array('name'=>$name,'email' => $email, 'customer' => $customer);
      Mail::send('emails.verify', $data, function($message) use ($data){
         $message->to($data['email'], $data['customer'])->subject
            ('Vérification de l\'adresse mail');
         $message->from('admin@services2sn.com',$data['name']);
      });
      //echo "HTML Email Sent. Check your inbox.";
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
}
