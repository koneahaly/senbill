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
   public function html_email() {
      $data = array('name'=>"SENBILL");
      Mail::send('emails.contact', $data, function($message) {
         $message->to('yacinenana@gmail.com', 'Yacine Ndiaye')->subject
            ('Inscription sur SenBill réussie');
         $message->from('admin@services2sn.com','SEN BILL');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function paymentOK_email() {
      $data = array('name'=>"SENBILL");
      Mail::send('emails.paymentSuccessful', $data, function($message) {
         $message->to('yacinenana@gmail.com', 'Yacine Ndiaye')->subject
            ('Paiement réussi');
         $message->from('admin@services2sn.com','SEN BILL');
      });
      echo "HTML Payment Email Sent. Check your inbox.";
   }
   public function newBill_email() {
      $data = array('name'=>"SENBILL");
      Mail::send('emails.newBill', $data, function($message) {
         $message->to('yacinenana@gmail.com', 'Yacine Ndiaye')->subject
            ('Nouvelle facture dispo');
         $message->from('admin@services2sn.com','SEN BILL');
      });
      echo "HTML new Bill Email Sent. Check your inbox.";
   }
   public function lateBill_email() {
      $data = array('name'=>"SENBILL");
      Mail::send('emails.lateBill', $data, function($message) {
         $message->to('yacinenana@gmail.com', 'Yacine Ndiaye')->subject
            ('Echeance facture dépassée');
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
}
