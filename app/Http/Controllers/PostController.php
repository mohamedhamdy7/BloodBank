<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record=Post::all();
        return view('post.index',compact('record'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('post.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, array(
            'title_post' => 'required',
            'content_post' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'puplish_date' => 'required',
        ));

        $post = new Post;
        $post->title_post= $request->input('title_post');
        $post->content_post= $request->input('content_post');
        $post->category_id= $request->input('category_id');
        $post->puplish_date= $request->input('puplish_date');
         //dd($record);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( public_path('/uploads/' . $filename ) );
            $post->image = $filename;

        }

         $post->save();

        flash()->success("success");

        return redirect(route('post.index'));
    }


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
        $model=Post::findOrFail($id);
        return view('post.edit',compact('model'));
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

        $record = Post::findOrFail($id);
        $record->update($request->all());
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save( public_path('/uploads/' . $filename ) );
            $record->image = $filename;

        }

        $record->save();
        flash()->success('<p class="text-center" style="font-size:20px; font-weight:900;font-family:Arial" >لقـــد تـــــــم التحــديــــــــث بنــجـــــــاح</p>');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Post::findOrFail($id);
        $record->delete();
        flash()->error('تم الحذف بنجاح');
        return back();
    }
}
