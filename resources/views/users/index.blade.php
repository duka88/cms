@extends('layouts.app')

@section('content')
 
  <div class="d-flex justify-content-end mb-1">
     <a href="{{ route('users.create')}}" class="btn btn-success ">Add user</a>
  </div>

  <div class="card card-default">
  	<div class="card-header">Users</div>
  	<div class="card-body">
  		<table class="table">
  			<thead>
  				<th>#</th>
  				<th>Name</th>  			
  				<th>Email</th>
          <th></th>
         
  			</thead>
  			<tbody>

  			@foreach($users as $key=>$user)  				
  				<tr>
  					<td>
  						{{$key+1}}
  					</td>
  					<td>              
  						 {{$user->name}}
              
  					</td>
            <td>
              {{$user->email}}
            </td>
  					<td>
              @if( Auth::user()->role == 'admin') 
    						<a href="{{ route('users.edit', $user->id)}}" class="btn btn-info btn-sm text-white mr-2">
    						Edit</a>
                  <a  class="btn btn-danger btn-sm deleteBtns text-white" id="{{$user->id}}">
                Delete
              </a>
             @endif
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
				        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
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




    {{ $users->links() }}
  	</div>
  </div>


 


@endsection  

@section('script')
 

    <script>
   document.addEventListener('DOMContentLoaded', ()=>{

      let btn = document.querySelectorAll('.deleteBtns');
      let form = document.getElementById('deleteForm');
     

      btn.forEach((item)=>{
      
	      item.addEventListener('click', ()=>{	 

            form.action = '/users/' + item.id;

	      	 $('#deleteModal').modal('show');
	      	  
	      })
      })
    })	
    </script>



@endsection      