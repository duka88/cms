<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    
    public function index()
    {
        $tags = Tag::with('posts')->paginate(15);

        return view('tags.index')->with('tags', $tags);
    }

    public function all_tags(){

        $tags = Tag::all();

        return TagResource::collection($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        

        Tag::create([
           'name' => $request->name
        ]);

        session()->flash('success', 'Tag created successfully.');

        return redirect(route('tags.index'));


    }

    public function api_store(CreateTagRequest $request){
        

       $tag =  Tag::create([
           'name' => $request->name
        ]);

       

        return  new TagResource($tag);


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
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
           'name' => $request->name
        ]);

        $tag->save();

        session()->flash('success', 'Tag updated successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
          session()->flash('error', "Can't delete tag while have posts");

          return redirect()->back();

       }

       $Tag->delete();

        session()->flash('success', 'Tag deleted successfully.');

        return redirect(route('tags.index'));
    }
}
