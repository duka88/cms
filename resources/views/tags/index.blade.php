@extends('layouts.app')

@section('content')
 
  <div class="d-flex justify-content-end mb-1">
     <a href="{{ route('tags.create')}}" class="btn btn-success ">Add Tag</a>
  </div>

  <div class="card card-default">
  	<div class="card-header">Tags</div>
  	<div class="card-body">
  		<table class="table">
  			<thead>
  				<th>#</th>
  				<th>Name</th>
  				<th>Count</th>
  				<th>Actions</th>
          
  			</thead>
  			<tbody>

  			@foreach($tags as $key=>$tag)  				
  				<tr>
  					<td>
  						{{$key+1}}
  					</td>
  					<td>
  						{{$tag->name}}
  					</td>
            <td>
            {{$tag->posts->count()}}
            </td>
  					<td>
              <div class="d-flex">
    						<a href="{{ route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm text-white mr-2">
    						Edit</a>
    				
                 <form action="{{route('tags.destroy', $tag->id)}}" method="POST" id="deleteForm">
                     @csrf
                     @method('DELETE')
    					       <button type="submit" class="btn btn-danger btn-sm text-white" >Delete</button>
             
                  </form>
					    </div>
  					</td>
  				</tr>
  			@endforeach	
  			</tbody>
  		</table>


			




   {{$tags->links()}}
  	</div>
  </div>


 


@endsection  

     