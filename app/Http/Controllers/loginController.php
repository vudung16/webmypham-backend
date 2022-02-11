<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
class loginController extends Controller
{
    public function show(){

    }
    public function postLogin(Request $request){
       
        $kt = [
            'name'=>$request->name,
            'password'=>$request->password,
        ];
        if(Auth::attempt($kt)){
			$checkRole = Auth::user()->role;
            if( $checkRole == 1 ){
                return redirect('admin/home');
            }
            else{
                $checkid = is_null(Profile::select(['user_id'])->where([Auth::user()->id=>'cosmetics_profile.user_id']));
                if( $checkid ){
                    return redirect('home');
                }
                else{
                    return redirect('home');
                } 
            }
        }
        else{
            return redirect('login');
        }
    }
    public function getLogin(){
        return view('login');
    }
    public function logout(){
        Auth::logout();
		return redirect('home');
    }
}