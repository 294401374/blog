<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Navs;
use App\Http\Model\Article;
use Illuminate\Support\Facades\View;
class CommonController extends Controller
{
    function __construct(){
    	$navs = Navs::all();
    	// 点击量最高的几篇文章(点击排行)
    	$top   = Article::orderBy('art_view','desc')->take(5)->get();
    	// 最新的8篇的文章
    	$new   = Article::orderBy('art_time','desc')->take(8)->get();
    	view::share('navs',$navs);
    	view::share('top',$top);
    	view::share('new',$new);
    }
}
