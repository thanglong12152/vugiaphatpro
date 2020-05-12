<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    public function create(Request $request){
        $res = $request->all();

        $data =  User::create([
            'name' => '',
            'email' => $res['email'],
            'password' => md5($res['password']),
            'remember_token' => $res['_token'],
            'is_admin' => 2
        ]);
        dd($data);
        if($data){
            return view('frontend/login')->with('flash_message_success','Đăng ký thành công');
        }else{
            return view('frontend/login')->with('flash_message_error','Đăng ký thất bại');
        }
    }
}
