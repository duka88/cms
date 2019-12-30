@extends('layouts.app')

@section('content')
 
  <div class="d-flex justify-content-end mb-1">
     <a href="{{ route('posts.create')}}" class="btn btn-success ">Add Post</a>
  </div>

  <div class="card card-default">
  	<div class="card-header">Posts</div>
  	<div class="card-body">
  		<table class="table">
  			<thead>
  				<th>#</th>
  				<th>Name</th>
  				<th></th>
  				<th></th>
  			</thead>
  			<tbody>

  		 	@foreach($posts as $key=>$post)  				
  				<tr>
  					<td>
  						{{$key+1}}
  					</td>
  					<td>
  						{{$post->name}}
  					</td>
  					<td>
             @if(!$post->trashed())              
    						<a href="{{ route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">
    						Edit</a>
              @endif
  					</td>
  					<td>
              <form action="{{ route('posts.destroy', $post->id)}}" method="POST">
                @csrf
                @method('DELETE')
                   <button type="submit" class="btn btn-danger btn-sm " >
                     {{$post->trashed() ? 'Delete' : 'Trash'}} 
                  </button>
              </form>
  					
  					</td>
  				</tr>
  			@endforeach	
  			</tbody>
  		</table> 


			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
                 <form action="" method="POST" id="deleteForm">

                 	 @csrf
                 	 @method('DELETE')

				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="deleteModalLabel">Delete post</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>                 
				      <div class="modal-body">
				       <h3 class="text-center font-weight-bold">
				       	  Are You Shure
				       </h3>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				        <button type="submit" class="btn btn-primary">Delete</button>
				      </div>
				    </div>
                </form>
			  </div>
			</div>





  	</div>
  </div>


  @endsection