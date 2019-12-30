<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\PostCreateRequest;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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

       Post::create([
            'title' => $request->title,
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_description' => $request->meta_description,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category_id,
            'published_at' => $request->published_at,
       ]);
       
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

          Storage::delete($post->image);

           session()->flash('success', 'Post deleted successfully.');
       }else{        
          $post->delete();

           session()->flash('success', 'Post trashed successfully.');
       }
       

        return redirect()->back();
    }

    public function trashed()
    {
       $posts = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $posts);
    }
}
