<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailService
{
   public function sendMail()
   {
       Mail::send('mail', ['username' => Auth::user()->name], function ($message) {
           $message->from(env('MAIL_USERNAME'));
           $message->to(Auth::user()->email)->subject('Service Purchased');
       });
   }
}
