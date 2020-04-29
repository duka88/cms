@extends('layouts.app')

@section('content') 

  <div class="card card-default">
  	<div class="card-header">
  	 {{ isset($client) ? 'Edit Client' : 'Add Client'}}
    </div>

  	<div class="card-body">
       @include('partials.errors')

  		<form 
  		action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store')}}" 
  		 method="POST">       
           @csrf            
            @if(isset($client))
               @method('PUT')
            @endif   

  			<div class="form-group">
  				<label for="name">Name*</label>
  				<input type="text" value="{{ isset($client) ? $client->name : ''}}" 
  				 id="name" class="form-control" name="name">
  			</div>

        <div class="form-group">
          <label for="email">Email*</label>
          <input type="email" value="{{ isset($client) ? $client->email : ''}}" 
           id="email" class="form-control" name="email">
        </div>
        <vue-links ></vue-links>
        <div class="form-group">
          <label for="company">Company</label>
          <input type="text" value="{{ isset($client) ? $client->company : ''}}" 
           id="company" class="form-control" name="company">
        </div>

         <vue-industry :ind_id="{{isset($client) ? $client->industry : 0}}"></vue-industry>


         <div class="form-group">
          <label for="curent">Budget*</label>
          <input type="number" value="{{ isset($client) ? $client->curent : ''}}" 
           id="curent" class="form-control" name="curent" min="0">
        </div>

      
        <vue-services :ser_id="{{isset($client) ? $client->services : 0}}"></vue-services>         

        <div class="form-group">
          <label for="time-frame">Time Frame*</label>
          <input type="date" value="{{ isset($client) ? $client->time-frame : ''}}" 
           id="time-frame" class="form-control" name="time-frame" >
        </div>

  			<div class="form-group">
  				<button type="submit" class="btn btn-success">
  				{{ isset($client) ? 'Edit Client' : 'Add Client'}}
  			</button>
  			</div>
  		</form>
  	</div>
  </div>

@endsection  