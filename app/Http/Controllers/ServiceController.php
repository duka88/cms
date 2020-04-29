<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('clients')->paginate(15);

        return view('services.index')->with('services', $services);
    }
    
    public function all_services(){

        $services = Service::all();

        return ServiceResource::collection($services);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceRequest $request)
    {
        
       Service::create([
           'name' => $request->name
        ]);

        session()->flash('success', 'Service created successfully.');

        return redirect(route('services.index'));
    }
    

    public function api_store(CreateServiceRequest $request){
        

       $service =  Service::create([
           'name' => $request->name
        ]);

       

        return  new ServiceResource($service);


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $clients = $service->clients()->paginate(15);
      
        return view('clients.index')->with('clients',  $clients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('services.create')->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
         $service->update([
           'name' => $request->name
        ]);

        $service->save();

        session()->flash('success', 'Service updated successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
         if($service->clients->count() > 0){
          session()->flash('error', "Can't delete service while have clients");

          return redirect()->back();

       }

       $service->delete();

        session()->flash('success', 'Service deleted successfully.');

        return redirect(route('services.index'));
    }
}
