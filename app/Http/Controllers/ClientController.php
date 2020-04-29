<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Link;
use App\Budget;
use App\DevTime;
use App\Type;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Resources\ClientResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $search = request()->query('search');

       if($search){

          $clients = Client::where("name", "LIKE", "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%")->orWhere('company', 'LIKE', "%{$search}%")->with('services')->paginate(15);
       }else{
         $clients = Client::with('services')->paginate(15);
       }    

        return view('clients.index')->with('clients',  $clients);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequest $request)
    {


       

       $client = Client::create([
         'name' => $request->name,
         'email' => $request->email,
         "company" => $request->company,
         'industry_id' => $request->industry_id

       ]);

      if(request()->addlink){ 
        $links = json_decode(request()->addlink[0]);

         foreach($links as $link){
           $lined = Link::create([
                'name' => $link->link,
                'type_id' => $link->type->id,
                'client_id' => $client->id,

              
             ]);       
         }
       }
       Budget::create([
         'curent' =>  $request->curent,
         'client_id' => $client->id
       ]); 
        
       DevTime::create([
         'time-frame' =>  $request['time-frame'],
         'client_id' => $client->id
       ]);

       if($request->service_id){
          $client->services()->attach($request->service_id);
       }
       

        session()->flash('success', 'Client added successfully.');

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $links = Link::where('client_id', $client->id)->with('type')->get()->toArray();



        return view('clients.single')->with('client', $client)->with('links', $links);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
