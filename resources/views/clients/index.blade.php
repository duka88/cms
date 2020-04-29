@extends('layouts.app')

@section('content') 

    <div class="d-flex  justify-content-between mb-1">
      <form class="d-flex" action="{{route('clients.index')}}" method="GET">
       <input class="form-control" type="text" name="search" placeholder="Search"
        value="{{request()->query('search')}}">
        <button type="submit" class="btn btn-success ml-2">Search</button>
     </form>
     <a href="{{ route('clients.create')}}" class="btn btn-success ">Add Customer</a>
   </div>
    <div class="card card-default">
  	<div class="card-header">Posts</div>
  	<div class="card-body">
  		<table class="table">
  			<thead>
  				<th>#</th>
  				<th>Name</th>
  				<th>Company</th>
                <th>Email</th>
  				<th>Services</th>
  				<th></th>
  			</thead>
  			<tbody>
             @foreach($clients as  $key=>$client)
  		       <tr>
  					<td>
  						{{$key+1}}
  					</td>
  					<td>
              <a href="{{ route('clients.show' , ['client' => $client->id]) }}">
  						  {{$client->name}}
              </a>
  					</td>
  					<td>                
  						  {{$client->company}}              
  					</td>
  					<td>
  						{{$client->email}}
  					</td>
  					<td>
  					   @foreach($client->services as  $service)
    						<span> 
                    <a href="{{ route('services.show' , ['service' => $service->id]) }}">
                     {{$service->name}}
                  </a>
              </span>
  					   @endforeach
  					</td>
  				</tr>
  			 @endforeach	
  			</tbody>
  		</table> 


			



    {{$clients->appends(['search' => request()->query('search')])->links()}}
  	</div>
  </div>

@endsection  