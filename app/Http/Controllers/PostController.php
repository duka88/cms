<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Post;
use App\Tag;
use App\Category;

class PostController extends Controller
{


   public function _construct(){

     // $this->middleware('categotyCount')->only(['create']);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $search = request()->query('search');

       if($search){
         
         $posts = Post::where("name", "LIKE", "%{$search}%")->paginate(15);
       }else{
         $posts = Post::paginate(15);
       }


        

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
       $image = $request->image->store('posts');

       $post = Post::create([
            'title' => $request->title,
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_description' => $request->meta_description,
            'content' => $request->content,
            'image' => $image,            
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
       ]);

       if($request->tag_id){
          $post->tags()->attach($request->tag_id);
       }
       
        session()->flash('success', 'Post created successfully.');

        return redirect(route('posts.index'));
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

         return view('posts.create')->with('post', $post)->with('categories', $categories)->with('tags', $tags);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post){

 
   
        $data = $request->only([ 
            'title', 'name', 'slug', 'meta_description',
            'content', 'image', 'category_id', 'published_at', 'category_id' ]);

        if($request->hasFile('image')){

            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }

       
        $post->update($data);

      if($request->tag_id){
          $post->tags()->sync($request->tag_id);
       }
         
        session()->flash('success', 'Post updated successfully.');

        return redirect(route('posts.index'));
        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
      $post = Post::withTrashed()->where('id', $id)->firstOrFail();

       if($post->trashed()){
          $post->forceDelete();

          $post->deleteImage();

           session()->flash('success', 'Post deleted successfully.');
       }else{        
          $post->delete();

           session()->flash('success', 'Post trashed successfully.');
       }
       

        return redirect()->back();
    }

    public function trashed()
    {
       $posts = Post::onlyTrashed()->paginate(15);

        return view('posts.index')->with('posts', $posts);
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully.');

        return redirect(route('posts.index'));

    }

    public function category(Category $category){

      
        return view("posts.index")->with('posts', $category->posts()->paginate(15));
    }
}
