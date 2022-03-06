<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $credentials = $request->only('email', 'password');
        if ( !$token = JWTAuth::attempt($credentials)) {
            $params = 'Tài khoản hoặc mật khẩu không chính xác';
            return $this->responseError($params);
        }
        return $this->responseSuccess($token)->header('Authorization', $token);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->role = 2;
        $user->save();
        return $this->responseSuccess();
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return $this->responseSuccess($user);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
}
