<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function ChangeIndex()
    {
        return view('user.reset-password');
    }


    public function changePasswordSave(Request $request)
    {
        $messages = [
            'old-password' => 'required',
            'password' => 'required|confirmed',
        ];
        $rules = [
            'old-password.required' => 'كلمة السر الحالية مطلوبة',
            'password.required' => 'كلمة السر مطلوبة',
        ];
        $this->validate($request,$messages,$rules);
        $user = Auth::user();
        if (Hash::check($request->input('old-password'), $user->password)) {
            // The passwords match...
            $user->password = bcrypt($request->input('password'));
            $user->save();
            flash()->success('تم تحديث كلمة المرور');
            return view('user.reset-password');
        }else{
            flash()->error('كلمة المرور غير صحيحة');
            return view('user.reset-password');
        }
    }

}
