@extends('layouts.app')

@section('content') 

  <div class="card card-default">
  	<div class="card-header">
  	 {{ isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>

  	<div class="card-body">
        @if($errors->any())

          <div class="alert alert-danger">
          	<ul class="list-group">
          		@foreach($errors->all() as $error)
                  <li class="list-group-item text-danger">{{$error}}</li>
          		@endforeach
          	</ul>
          </div>

        @endif

  		<form 
  		action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" 
  		 method="POST" enctype="multipart/form-data">
       
           @csrf
            
            @if(isset($Post))
               @method('PUT')
            @endif   
      
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" value="{{ isset($post) ? $post->name : ''}}" 
           id="name" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label for="slug">Slug</label>
          <input type="text" value="{{ isset($post) ? $post->slug : ''}}" 
           id="slug" class="form-control" name="slug">
        </div>

  			<div class="form-group">
  				<label for="title">Title</label>
  				<input type="text" value="{{ isset($post) ? $post->title : ''}}" 
  				 id="title" class="form-control" name="title">
  			</div>


        <div class="form-group">
          <label for="meta_description">Meta Description</label>
          <textarea rows='3' value="{{ isset($post) ? $post->description : ''}}" 
           id="meta_description" class="form-control" name="meta_description"></textarea>
        </div>

        <div class="form-group">
          <label for="content">Content</label>         
           <input id="content" type="hidden" name="content">
           <trix-editor input="content"></trix-editor>
        </div>

        <div class="form-group">
          <label for="published_at">Published at</label>
          <input type="text" value="{{ isset($post) ? $post->published_at : ''}}" 
           id="published_at" class="form-control" name="published_at">
        </div>

        <div class="form-group">
          <label for="image">Feature Image</label>
          <input type="file" value="{{ isset($post) ? $post->image : ''}}" 
           id="image" class="form-control" name="image">
        </div>


  			<div class="form-group">
  				<button type="submit" class="btn btn-success">
  				{{ isset($post) ? 'Edit Post' : 'Add Post'}}
  			</button>
  			</div>
  		</form>
  	</div>
  </div>

@endsection  

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>

@endsection 

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">

@endsection 