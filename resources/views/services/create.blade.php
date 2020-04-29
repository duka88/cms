@extends('layouts.app')

@section('content') 

  <div class="card card-default">
  	<div class="card-header">
  	 {{ isset($service) ? 'Edit Service' : 'Create service'}}
    </div>

  	<div class="card-body">
       @include('partials.errors')

  		<form 
  		action="{{ isset($service) ? route('services.update', $service->id) : route('services.store')}}" 
  		 method="POST">
       
           @csrf
            
            @if(isset($service))
               @method('PUT')
            @endif   

  			<div class="form-group">
  				<label for="name"></label>
  				<input type="text" value="{{ isset($service) ? $service->name : ''}}" 
  				 id="name" class="form-control" name="name">
  			</div>
  			<div class="form-group">
  				<button type="submit" class="btn btn-success">
  				{{ isset($service) ? 'Edit Service' : 'Add Service'}}
  			</button>
  			</div>
  		</form>
  	</div>
  </div>

@endsection  