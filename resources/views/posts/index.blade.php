@extends('layouts.app')

@section('content')

  <div class="d-flex justify-content-between mb-1">
     <form class="d-flex" action="{{route('posts.index')}}" method="GET">
       <input class="form-control" type="text" name="search" placeholder="Search"
        value="{{request()->query('search')}}">
        <button type="submit" class="btn btn-success ml-2">Search</button>
     </form>
     <a href="{{ route('posts.create')}}" class="btn btn-success ">Add Post</a>
  </div>

  <div class="card card-default">
  	<div class="card-header">Posts</div>
  	<div class="card-body">
  		<table class="table">
  			<thead>
  				<th>#</th>
  				<th>Name</th>
          <th>Category</th>
  				<th></th>
  				<th></th>
  			</thead>
  			<tbody>

  		 	@forelse($posts as $key=>$post)  				
  				<tr>
  					<td>
  						{{$key+1}}
  					</td>
  					<td>
  						{{$post->name}}

  					</td>
            <td>
              <a href="{{route('posts.category', $post->category->id )}}">
               {{$post->category->name}}
              </a>             
            </td>
  					<td>
             @if(!$post->trashed())              
    						<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
    						Edit</a>

              @else      
                <form action="{{ route('post.restore', $post->id) }}" method="POST">

                  @csrf
                  @method('PUT')
                  
                   <button type="submit" class="btn btn-info btn-sm text-white">
                Restore</button>
                </form>        
               

              @endif
  					</td>
  					<td>
              <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                   <button type="submit" class="btn btn-danger btn-sm " >
                     {{$post->trashed() ? 'Delete' : 'Trash'}} 
                  </button>
              </form>
  					
  					</td>
  				</tr>
         @empty
          
          <h3>No results </h3>

  			@endforelse
  			</tbody>
  		</table> 


			



    {{$posts->appends(['search' => request()->query('search')])->links()}}
  	</div>
  </div>


  @endsection