<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Mail\ResetPassword;
use App\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request){
       $validation=validator()->make($request->all(),[
         'name'=>'required',
         'email'=>'required|unique:clients',
         'password'=>'required|confirmed',
           'phone'=>'required|unique:clients',
           'birth_date'=>'required',
           'donation_last_date'=>'required',
           'city_id'=>'required',
           'blood_type_id'=>'required',
       ]);
       if ($validation->fails()){
           return responseJson(0,$validation->errors()->first());
       }

       $request->merge(['password'=>bcrypt($request->password)]);

       $client=Client::create($request->all());
        $client->api_token=str_random(60);
        $client->save();
        $data=[
            'api_token'=>$client->api_token,
            'client'=>$client->load('city.governorate','blood_type')
        ];
        return responseJson(1,'تم الاضافه بنجاح',$data);

    }
    public function login(Request $request){
        $validation=validator()->make($request->all(),[
            'password'=>'required',
            'phone'=>'required',

        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }
        $client=Client::where('phone',$request->phone)->first();
        if ($client){
            if (Hash::check($request->password,$client->password)){
                return responseJson(1,'تم التسجيل بنجاح',['api_token'=>$client->api_token,'client'=>$client]);
            }
            else{
                return responseJson(0,'المعلومات التى ادخلتها غير صحيحه');
            }
        }
        else{
            return responseJson(0,'المعلومات التى ادخلتها غير صحيحه');
        }
    }


    /*public function profile(Request $request){
        $validation=validator()->make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:clients',
            'password'=>'required|confirmed',
            'phone'=>'required|unique:clients',
            'birth_date'=>'required',
            'donation_last_date'=>'required',
            'city_id'=>'required',
            'blood_type_id'=>'required',
        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }

        $request->merge(['password'=>bcrypt($request->password)]);

        $client=Client::where('api_token',$request->api_token)->update($request->all());
        $client->api_token=str_random(60);

        return responseJson(1,'تم التعديل بنجاح',['api_token'=>$client->api_token,'client'=>$client]);
    }*/

   /* public function profile(Request $request)
    {
//        return $request->user();
        return auth()->guard('api')->user();
        //$client=Client::where('api_token',$request->api_token)->first();
        if ($client){

            $validation = validator()->make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:clients',
                'password' => 'required|confirmed',
                'phone' => 'required|unique:clients',
                'birth_date' => 'required',
                'donation_last_date' => 'required',
                'city_id' => 'required',
                'blood_type_id' => 'required|exists:blood_types,id',
            ]);
            if ($validation->fails()) {
                return responseJson(0, $validation->errors()->first(),$validation->errors());
            }

            $client->name=$request->name;
            $client->birth_date=$request->birth_date;
            $client->email=$request->email;
            $client->phone=$request->phone;
            $client->city_id=$request->city_id;
            $client->blood_type_id=$request->blood_type_id;
            $client->donation_last_date=$request->donation_last_date;
            $client->password=bcrypt($request->password);
            //$client->api_token=str_random(60);
            $client->update();
            return responseJson(1,'تم التعديل بنجاح',['client'=>$client]);
        }

    }*/


    public function profile(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'password' => 'confirmed',


            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }
        $loginUser = $request->user();
        $loginUser->update($request->all());
        if ($request->has('password'))
        {
            $loginUser->password = bcrypt($request->password);
        }
        $loginUser->save();
        if ($request->has('governorate_id'))
        {
            $loginUser->governorates()->detach($request->governorate_id);
            $loginUser->governorates()->attach($request->governorate_id);
        }
        $data = [
            'user' => $request->user()->fresh()->load('city.governorate','blood_type')
        ];
        return responseJson(1,'تم تحديث البيانات',$data);
    }




    public function forgetpass(Request $request){
        $validation=validator()->make($request->all(),[
            'phone'=>'required',
        ]);

        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }
        $client=Client::where('phone',$request->phone)->first();

        if ($client){
            $code=rand(1111,9999);

            $update=$client->update(['pin_code'=>$code]);


            if ($update){
                     //send sms

                //smsMisr($request->phone,"your reset code is : ".$code);
                return responseJson(1,'برجاء فحص هاتفك',['pin_code'=>$code]);
                //send email
                Mail::to($client->email)
                    ->bcc("mohamedhamdi232@gmail.com")
                    ->send( new ResetPassword($client));
                return responseJson(1,'برجاء فحص هاتفك',['pin_code'=>$code]);
            }
        }
        else{
            return responseJson(0,' phone number is error ,plz sure your number');
        }
    }
    public function newpass(Request $request){
        $validation=validator()->make($request->all(),[
            'password'=>'required',
            'phone'=>'required',
            'pin_code'=>'required',

        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }

        $user=Client::where('pin_code',$request->pin_code)
                       ->where('pin_code','!=',0)
                       ->where('phone',$request->phone)->first();

        if($user){

            $user->password=bcrypt($request->password);
            $user->pin_code=null;
            $user->save();
            if ($user->save()){
                return responseJson(1,'تم تغيير كلمه المرور بنجاح');
            }
            else{
                return responseJson(0,'حدث خطأ');
            }

        }
        else{
            return responseJson(0,'هذا الcode خطأاو ال phone');
        }
    }
    public function registerToken(Request $request){

        $validation=validator()->make($request->all(),[
            'token'=>'required',
            'platform'=>'required|in:android,ios'
        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }

        Token::where('token',$request->token)->delete();
        $data=$request->user()->tokens()->create($request->all());
       //$data=["token"=>$request->user()->tokens()];
        return responseJson(1,'تم التسجيل بنجاح', $data->load('client'));

    }
    public function removeToken(Request $request){

        $validation=validator()->make($request->all(),[
            'token'=>'required',

        ]);
        if ($validation->fails()){
            return responseJson(0,$validation->errors()->first());
        }

        Token::where('token',$request->token)->delete();

        return responseJson(1,"تم الحذف بنجاح");
    }
}
