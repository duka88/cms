<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\P8Mail;

class MailController extends Controller
{
    public function contact_mail(Request $request){
    
       $details = [
        'title' => 'Mail from Passage8.com',
        'body' => $request->mail,
       

       ];
   

    Mail::to('djankov88@gmail.com')->send(new P8Mail($details));

     if (Mail::failures()) {
        return 'error';
     }else{
     	return 'success';
     }

  }

}
 