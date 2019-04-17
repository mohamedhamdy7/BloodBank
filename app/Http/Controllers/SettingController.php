<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record=Setting::all();
        return view('setting.index',compact('record'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $record=Setting::findOrFail($id);

        return view('setting.edit',compact('record'));
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
        $this->validate($request,[
            'about_app'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'android_app_url'=>'required',
            'facebook_url'=>'required',
            'whatsapp_url'=>'required',
            'google_url'=>'required',
            'instagram_url'=>'required',
            'youtube_url'=>'required',
            'twitter_url'=>'required',



        ],[
            'about_app.required'=>'plz fill the form',
            'phone.required'=>'plz fill the form',
            'email.required'=>'plz fill the form',
            'android_app_url.required'=>'plz fill the form',
            'facebook_url.required'=>'plz fill the form',
            'whatsapp_url.required'=>'plz fill the form',
            'google_url.required'=>'plz fill the form',
            'instagram_url.required'=>'plz fill the form',
            'youtube_url.required'=>'plz fill the form',
            'twitter_url.required'=>'plz fill the form',
        ]);
        if (Setting::all()->count()>0)
        {
            $record=Setting::findOrFail($id);
            $record->update($request->all());

        }
        else{
            Setting::create($request->all());
        }

        flash()->success('تم التعديل بنجاح');
        return redirect(route('setting.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
