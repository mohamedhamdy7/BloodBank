<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class governorate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $records=\App\Governorate::paginate(28);
        return view('governorate.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('governorate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Name is required'
        ]);
        $record=\App\Governorate::create($request->all());
        flash()->success("success");
        return redirect(route('governorate.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=\App\Governorate::findOrFail($id);
        return view('governorate.edit',compact('model'));
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
        $record=\App\Governorate::findOrFail($id);
        $record->update($request->all());
        return redirect(route('governorate.index'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=\App\Governorate::findOrFail($id);
        $record->delete();
        return redirect(route('governorate.index'));
        // return view('governorate.index');
    }

    public function trashed(){
        $name=\App\Governorate::onlyTrashed()->get();
        //return view('showTrash',compact('name'));
        //return back();
        return view('governorate.showTrash',compact('name'));
    }

    public function restore($id){
        $name=\App\Governorate::onlyTrashed()->find($id);
        $name->restore();
        return redirect(route('governorate.index'));
        //return view('governorate.index');
    }

    public function deleteforce($id){
        $name=\App\Governorate::onlyTrashed()->find($id);
        $name->forceDelete();
        return redirect(route('governorate.index'));

    }
}
