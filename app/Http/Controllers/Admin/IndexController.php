<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Model\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
	// 显示后台首页
    public function index(){
    	return view('Admin.index');
    }
    // 显示后台首页的内容页面
    public function info(){
    	return view('Admin.info');
    }
    // 更改管理员密码
    public function pass(){
        if ($input=Input::all()) {
            // 规则
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            // 报错信息
            $message= [
                'password.required'=>'新密码不能为空！',
                'password.between' =>'新密码必须要在6~20位数之间！',
                'password.confirmed'=>'两次密码不一致！',
            ];
            // 引入Validator这个服务
           $Validator=Validator::make($input,$rules,$message);
            
           // 如果$Validator的规则通过(passes())的话
           // 失败是fails()函数，通过是passes()
            if ($Validator->passes()) {
                
                $user = User::first();
                $password = Crypt::decrypt($user->pwd);
                $oldp = $input['password_o'];
                if ($oldp==$password) {
                    $user->pwd=Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码跟换成功');
                    // dd($input['password']);
                }else{
                    return back()->with('errors','原密码错误！');
                }
                
            }else{
                // dd($Validator->errors()->all());
                // back()反回原来的页面  withErrors()返回给模版参数。
                return back()->withErrors($Validator);
            }
        }else{            
            return view('admin.pass');
        }        
    }
}
