<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\P8Mail;

class MailController extends Controller
{
    public function contact_mail(Request $request){
         
       $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => $request->body
       ];
   
    Mail::to('your_receiver_email@gmail.com')->send(new P8Mail($details));
    }
}
