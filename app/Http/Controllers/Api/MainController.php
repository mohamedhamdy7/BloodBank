<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Governorate;
use App\Post;
use App\Setting;
use App\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function governorates(){
        $governorates= Governorate::all();
        return responseJson(1,'success',$governorates);
    }

    public function cities(Request $request){
        $cities=City::where(function ($query)use ($request){
           if ($request->has('governorate_id')){
               $query->where('governorate_id',$request->governorate_id);
           }
        })->get();
        return responseJson(1,'success',$cities);
    }
    public function posts(){
        // filter -> keyword - category_id
        $posts= Post::with('category')->paginate(10);
        return responseJson(1,'success',$posts);
    }
    public function donationRequest(Request $request)
    {

        $validation = validator()->make($request->all(), [
            'patient_name' => 'required',
            'patient_age' => 'required:digits',
            'blood_type_id' => 'required|exists:blood_types,id',
            'blood_number' => 'required:digits',
            'hospital_name' => 'required',
            'phone' => 'required|digits:11',
            'city_id' => 'required|exists:cities,id',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first());
        }
        //create donation request
        $donationRequest = $request->user()->requests()->create($request->all());
        //dd($donationRequest);
        //هجيب ال مستخدمين اللى متوافقين مع الفصيله
        // $client=$donationRequest->city->governorate->clients->where('blood_type_id',$request->blood_type_id)->pluck('clients.id')->toArray();
//        $send ='';
        $clientIds = $donationRequest->city->governorate->clients()->whereHas('blood_types', function ($query) use ($request){


            $query->where('blood_type_client.blood_type_id',$request->blood_type_id);

                      })
                                             ->pluck('clients.id')->toArray();




        if (count($clientIds)) {
            //create notification in DB
            $notification = $donationRequest->notifications()->create([
                'title' => 'يوجد حاله تبرع قريبه منك',
                'content' => $donationRequest->blood_type->name . "يحتاج الى فصيله دم",

                //->load('blood_types')
            ]);
            // dd($notification);
            //attach clients to this notification in DB
            $notification->clients()->attach($clientIds);

            //ابعت الاشعارات على الفون
            $tokens = Token::whereIn('client_id', $clientIds)->where('token', '!=', null)->pluck('token')->toArray();
            if (count($tokens))
            {

                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                info("firebase result: " . $send);
//                info("data: " . json_encode($data));
            }
        }
        return responseJson(1, 'تم الاضافة بنجاح',$donationRequest);
    }
        public function postFavourite(Request $request){

        $validation=validator()->make($request->all(),[
            'post_id'=>'required|exists:posts,id',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }


        $toggle=$request->user()->posts()->toggle($request->post_id);


            return responseJson(1,'success',$toggle);

        }

        public function myFavourite(Request $request){

           $posts=$request->user()->posts()->latest()->paginate(10);
           //$posts = $request->user()->favourites()->with('category')->latest()->paginate(20);// oldest()
           return responseJson(1,'success',$posts);


        }
        public function setting(){

        $data=Setting::firstOrNew();
        return responseJson(1,$data);
        }

        public function contacts(Request $request){
        $validation=validator()->make($request->all(),[
            'title'=>'required',
                'message'=>'required',
            ]

       );
        if($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }

        $contacts=$request->user()->contacts()->create([
            'title'=>$request->title,
            'message'=>$request->message
        ]);
        if ($contacts){
            return responseJson(1,'success',$contacts);
        }

        }


}
