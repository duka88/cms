<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Link;
use App\Budget;
use App\DevTime;
use App\credential;

class EditClientController extends Controller
{
    public function name(Request $request){

    	$request->validate([
        'name' => 'required|unique:clients,name,'.$request->id,
        
         ]);
         
        $client = Client::find($request->id);

        $client->update(['name' => $request->name]);

        return 'success';
          
    }

    public function company(Request $request){

    	$request->validate([
        'company' => 'required',
        
         ]);
         
        $client = Client::find($request->id);

        $client->update(['company' => $request->company]);

        return 'success';
          
    }
    public function email(Request $request){

    	$request->validate([
        'email' => 'required|unique:clients,email,'.$request->id,
        
         ]);
         
        $client = Client::find($request->id);

        $client->update(['email' => $request->email]);

        return 'success';
          
    }
    public function industry(Request $request){

    	$request->validate([
         'industry' => 'required',
        
         ]);
         
        $client = Client::find($request->id);

        $client->update(['industry_id' => $request->industry]);

        return 'success';
          
    }

    public function services(Request $request){

         
        $client = Client::find($request->id);

        $client->services()->sync($request->services);

        return 'success';
          
    }
    public function links(Request $request){
    

        $client = Client::find($request->id);

        if( $client->links){
            $client->links()->delete();
        }

        

        foreach($request->links as $link){
            Link::create([
               'name' => $link['link'],
               'type_id' => $link['type_id'],
               'client_id' => $request->id
            ]);

            
        }

         return 'success';
          
    }

    public function budget(Request $request){
          
        $request->validate([
          'curent' => 'min:0',
           'spent' => 'min:0'
         ]);
         
        $client = Client::find($request->id);

        if($client->budget){
          $client->budget()->update([
            'curent' => $request->curent,
            'spent' => $request->spent
           ]);
        }else{
          $client->budget()->create([
            'curent' => $request->curent,
            'spent' => $request->spent
          ]);
        }

    

        return 'success';
          
    }

    public function time(Request $request){
          
    
         
        $client = Client::find($request->id);

      

        if($client->dev_time){
            $client->dev_time()->update([
                'started' => $request->started,
                'time-frame' => $request->time_frame,
                'finished' => $request->finished
            ]);
        }else{
             $client->dev_time()->create([
                'started' => $request->started,
                'time-frame' => $request->time_frame,
                'finished' => $request->finished
            ]);
        }

        return 'success';
          
    }
    public function credentials(Request $request){
    

        $client = Client::find($request->id);

        if( $client->credentials){
            $client->credentials()->delete();
        }

        

        foreach($request->creds as $cred){
            Credential::create([
               'name' => $cred['name'],
               'value' => $cred['value'],
               'client_id' => $request->id
            ]);

            
        }

         return 'success';
          
    }
}
