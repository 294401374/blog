<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //
    public function upload(){
    	$file = Input::file('Filedata');
    	// IsValid即实例变量的值是否是个有效的对象句柄。
    	if($file -> isValid()){
	    	$entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
	    	$newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
	    	$path = $file -> move(base_path().'/uploads',$newName);
	    	$filepath = 'uploads/'.$newName;
	    	return $filepath;
    	}
    }
}
