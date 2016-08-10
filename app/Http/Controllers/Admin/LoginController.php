<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;

require_once('resources/org/code/Code.class.php');
class LoginController extends CommonController
{
    public function login(){
    	if ($input = Input::all()) {  
    		$code    = new \code; 
    		$getcode = $code->get(); 		
    		if (strtoupper($input['code'])!=$getcode) {
    		   	return back()->with('msg','验证码错误');
    		}   
        $user = User::first();
        if ($user->name != $input['username'] || Crypt::decrypt($user->pwd)!=$input['password'] ) {
            return back()->with('msg','用户名或者密码错误');
          }	
       // $use = User::all();
       // dd($use[0]->name);
          // 正确的话用缓存的方式保存
        session(['user'=>$user]);
    		return redirect('admin/index');
    	}else{
    		return view('admin.login');
    	}
    }
    public function code(){
      // 从底层寻找code类
    	$code = new \code;
    	$code->make();
    }
    public function quit(){
      session(['user'=>null]);
      return redirect('admin/login');
    }

    // 存储密码的实验
    public function crypt(){
  		$str = 123456;
  		$str1 = 'eyJpdiI6IkxQeHl6dGt3SExQdDAxSVErc3dBNWc9PSIsInZhbHVlIjoiMlNpbUFKUWlKZE9Yc2IxVklxQmRiUT09IiwibWFjIjoiM2I0OTI0YTIxMmE4ZmZkOGY2MDc2OGZhMDYzODU4ZjEyMzViN2I3ZjMwMmQxNDRlMjdhNjY5MmYzNTE5YjgxYiJ9';
  		echo Crypt::encrypt($str);
  		echo '<br/>';
  		echo Crypt::decrypt($str1);
    }
    
}
