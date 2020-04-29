@extends('layouts.app')

@section('content') 

  <div class="card card-default">
  	<div class="card-header">
  	 {{ isset($user) ? 'Edit user' : 'Create user'}}
    </div>

  	<div class="card-body">
       @include('partials.errors')

  		<form 
  		action="{{ isset($user) ? route('users.update', $user->id) : route('users.store')}}" 
  		 method="POST">
       
           @csrf
            
            @if(isset($user))
               @method('PUT')
            @endif   

  			<div class="form-group">
  				<label for="name"></label>
          <input type="hidden" name="id" value="{{ isset($user) ? $user->id : ''}}" >
  				<input type="text" value="{{ isset($user) ? $user->name : old('name')}}" 
  				 id="name" class="form-control" name="name">
  			</div>
        <div class="form-group">
          <label for="email"></label>
          <input type="email" value="{{ isset($user) ? $user->email : old('email')}}" 
           id="email" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label for="password"></label>
          <input type="password" value="{{ isset($user) ? $user->password : ''}}" 
           id="password" class="form-control" name="password">
        </div>
  			<div class="form-group">
       
    				<button type="submit" class="btn btn-success">
    				{{ isset($user) ? 'Edit user' : 'Add user'}}
    			</button>
      
  			</div>
  		</form>
  	</div>
  </div>

@endsection  