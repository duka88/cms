@extends('layouts.app')

@section('content') 

  <div class="card card-default">
  	<div class="card-header">
  	 {{ isset($post) ? 'Edit Post' : 'Create Post'}}
    </div>

  	<div class="card-body">
     @include('partials.errors')

  		<form 
  		action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}" 
  		 method="POST" enctype="multipart/form-data" id="app">
       
           @csrf
            
            @if(isset($post))
               @method('PUT')
            @endif   

         @if(isset($post))
              <input type="hidden" name="id" value="{{$post->id}}">
            @endif 
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" value="{{ isset($post) ? $post->name : old('name') }}" 
           id="name" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label for="slug">Slug</label>
          <input type="text" value="{{ isset($post) ? $post->slug : old('slug')}}" 
           id="slug" class="form-control" name="slug">
        </div>

  			<div class="form-group">
  				<label for="title">Title</label>
  				<input type="text" value="{{ isset($post) ? $post->title : old('title')}}" 
  				 id="title" class="form-control" name="title">
  			</div>


        <div class="form-group">
          <label for="meta_description">Meta Description</label>
          <textarea rows='3' 
           id="meta_description" class="form-control" name="meta_description">{{ isset($post) ? $post->meta_description : old('meta_description')}}
           </textarea>
        </div>

        <div class="form-group">
          <label for="content">Content</label>         
          
           <textarea  id="content" name="content" class="form-control">
             @if(isset($post)) 
               {{ $post->content }}

             @else
             {{old('content')}}  
             @endif  
           </textarea> 
        </div>
     
        <vue-categories :cat_id="{{isset($post) ? $post->category_id : ''}}"></vue-categories>
        <vue-tags :tag_id="{{$post->tags}}"></vue-tags>

        <div class="form-group">
          <label for="published_at">Published at</label>
          <input type="date" value="{{ isset($post) ? date('Y-m-d', strtotime($post->published_at) ) : date('Y-m-d', strtotime(now()))}}" 
           id="published_at" class="form-control" name="published_at">
        </div>

        <div class="form-group">
          <label id="imageInput" class=" d-flex justify-content-center align-items-center " for="image">Add Feature Image
              <input type="file" value="{{ isset($post) ? $post->image : ''}}" 
               id="image" class="form-control" name="image" style="display: none">
               <img id="output"
                src="{{ isset($post) ? asset('/storage/'.$post->image) : ''}}" alt="" >
               <p id="cancel">X</p>
           </label>
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

  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

  <script >
    document.addEventListener('DOMContentLoaded', ()=>{
 
        var editor_config = {

        path_absolute : "/",
        selector: "#content",
        menubar: false,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
           relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : '500px',
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);



 
 
     let reader = new FileReader();
     let  img = document.getElementById('imageInput');
     let cancel = document.getElementById('cancel');
     let  output = document.getElementById('output');
     const original = output.src; 
     
    
     img.addEventListener('change',  function(event) {
       let  input = event.target;

       reader.readAsDataURL(input.files[0]);
        reader.onload = function(){
          let  dataURL = reader.result;         
          output.src = dataURL;
        };
      
    });   

    cancel.addEventListener('click', (e)=>{ 
        e.preventDefault();
        output.src = original;
    });  


  }); 
  </script>
@endsection 

 


