<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public  function index(){
    	// $name = '后盾网';
    	// $kouhao = '人人做后盾';
    	$data = [
    		'name' =>'后盾网',
    		'kouhao' => '人人zuoh’'

    	];
    	$title ='houweudsanwe laravel';
    	return view('mylaravel',compact('data','title'));
    }
    public function child(){
        // return view('child');
        // echo config('database.connections.mysql.prefix');
        $pdo = DB::connection()->getPdo();
        dd($pdo);
        $user = DB::table('user')->where('id','>',1)->get();
        dd($user);
    }

}
