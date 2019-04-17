<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class citycontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record=City::all();
        return view('city.index',compact('record'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('city.create');
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
            'name'=>'required',
            'governorate_id'=>'required',
        ],[
            'name.required'=>'Name is required',
            'governorate_id.required'=>'Name is required'
        ]);
        $record=City::create($request->all());
        flash()->success("success");
        return redirect(route('city.index'));
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
        $model=City::findOrFail($id);
        return view('city.edit',compact('model'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'name'=>'required',
            'governorate_id'=>'required',
        ],[
            'name.required'=>'Name is required',
            'governorate_id.required'=>'Name is required'
        ]);
        $record = City::findOrFail($id);
        $record->update($request->all());
        flash()->success("success");
        return redirect(route('city.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = City::findOrFail($id);
        $record->delete();
        flash()->error('تم الحذف بنجاح');
        return back();
    }
}
