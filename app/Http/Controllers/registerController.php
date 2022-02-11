<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\db;
class registerController extends Controller
{
    public function postRegister(Request $request){
        $validate = $request->validate(
            [
              'name' => 'required|unique:users',
              'password'=>'required||min:3|max:32',
              'password_confirmation' => 'required|same:password',
            ],
            [  
               'name.required'  => 'Bạn chưa nhập tài khoản',
               'password.required' => 'Bạn chưa nhập mật khẩu',
               'password.max' => 'Mật khẩu phải có ít hơn 32 kí tự',
               'password.min' => 'Mật khẩu phải có nhiều hơn 3 kí tự',
               'name.unique' => 'Tài khoản đã tồn tại',
            ]);
                $profile = Profile::all();
                $user = new User;
                $user->name= $request->name;
                $user->email= $request->email;
                $user->password=Hash::make($request->password);
                $user->save();
               
            if($validate=true){
              return redirect('/addprofile/'.$user->id);   
            } else {
                return redirect('/register')->withErrors($validate);
            }
            
    }
    public function getRegister(){
        return view('/register');
    }
}