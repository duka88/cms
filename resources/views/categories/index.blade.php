@extends('layouts.app')

@section('content')
 
  <div class="d-flex justify-content-end mb-1">
     <a href="{{ route('categories.create')}}" class="btn btn-success ">Add Category</a>
  </div>

  <div class="card card-default">
  	<div class="card-header">Categories</div>
  	<div class="card-body">
  		<table class="table">
  			<thead>
  				<th>#</th>
  				<th>Name</th>
  				<th>Post Count</th>
  				<th>Actions</th>
        
  			</thead>
  			<tbody>

  			@foreach($categories as $key=>$category)  				
  				<tr>
  					<td>
  						{{$key+1}}
  					</td>
  					<td>
  						{{$category->name}}
  					</td>
            <td>
              {{$category->posts->count()}}
            </td>
  					<td>
  						<a href="{{ route('categories.edit', $category->id)}}" class="btn btn-info btn-sm mr-2 text-white">
  						Edit</a>
  					
  						<a  class="btn btn-danger btn-sm deleteBtns text-white" id="{{$category->id}}">
						  Delete
						</a>
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
				        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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




    {{$categories->links()}}
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

            form.action = '/categories/' + item.id;

	      	 $('#deleteModal').modal('show');
	      	  
	      })
      })
    })	
    </script>



@endsection      