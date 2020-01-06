<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    
    public function index(){
        // if(Session::has('adminSession')){

        // }
        // else{
        //     return redirect('admin/login')->with('flash_message_error','Please login to access');
        // }
        return view('admin/index');
    }

    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['admin'=>'1','email'=>$data['email'],'password'=>$data['password']])) {
                // echo "Success";
                // Session::put('adminSession',$data['email']);
                return redirect('admin/');
            }
            else if (Auth::attempt(['admin'=>'0','email'=>$data['email'],'password'=>$data['password']])){
                return redirect('home/');
            }
            else{
                return redirect('admin/login')->with('flash_message_error','Invalid Username or Password');
                //return view('admin/login');
            }
        }
        return view('admin/login');
        
    }

    public function logout(){
        Session::flush();
        return redirect('admin/login')->with('flash_message_logout','Logged out');
    }
    public function forgot_password(){
        return view('admin/forgot_password');
    }

    public function settings(){
        return view('admin/settings');
    }

    public function checkPass(Request $request){
        $data = $request->all();
         //echo "<pre>"; print_r($data);
         $current_password = $data['current_pwd'];
         $check_pass = User::where(['admin'=>'1'])->first();
         if(Hash::check($current_password,$check_pass->password)){
             echo "true"; die;
         }
         else{
             echo "false"; die;
         }
    }
    public function checkProduct(Request $request,$id=null){
        $data = $request->all();
        //echo "<pre>"; print_r($data);
        $productType = $data['productType'];
        switch($productType){
            case '1':
                echo "Bồn tắm";
                break;
            case '2':
                echo "Máy xông hơi";
                break;
            case '3':
                echo "Phòng xông hơi";
                break;
            case '4':
                echo "Quạt đèn trần";
                break;
            case '5':
                echo "Thiết bị vệ sinh";
                break;
            
        }
    }
    public function updatePass(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $check_pass = User::where(['email'=>Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password, $check_pass->password)){
                // echo "true"; die;
                $password = bcrypt($data['new_pwd']);
                User::where(['id'=>'1'])->update(['password'=>$password]);
                return redirect('admin/settings')->with('flash_message_success','Update Success');
            }
            else{
                return redirect('admin/settings')->with('flash_message_error','Update Failed');
            }
        }
    }

   
}
