<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Conf;
use App\Http\Model\Category;
class IndexController extends CommonController
{
	// 前台首页
    public function Index(){    
    	// 点击量最高的几篇文章(站长片)
    	$hot   = Article::orderBy('art_view','desc')->take(6)->get();  		
    	// 图文列表
    	$data  = Article::orderBy('art_time','desc')->paginate(6);
    	
    	// 友情链接
    	$links = Links::orderBy('links_order','asc')->get();

		return view('Home.index',compact('hot','top','data','new','links'));
    }
    // 列表页
    public function cate($cate_id){
    	$cate = Category::find($cate_id);
    	// 图文列表
    	$data  = Article::where('cid',$cate_id)->orderBy('art_time','desc')->paginate(4);
    	// 查看次数自增
    	Category::where('id',$cate_id)->increment('cate_view');
    	$category = Category::where('cate_pid',$cate_id)->get();
    	return view('Home.list',compact('cate','data','category'));
    }
    // 文章列表
    public function article($art_id){
    	$field       = Article::Join('cate','article.cid','=','cate.id')->where('article.id',$art_id)->select('article.id as art_id','cate.id as cate_id','article.*','cate.*')->first();
    	$art['next'] = Article::where('id','>',$art_id)->orderBy('id','asc')->first();
    	$art['pre']  = Article::where('id','<',$art_id)->orderBy('id','desc')->first();
    	$data 		 = Article::where('cid',$field->cate_id)->take(6)->orderBy('id','desc')->get();
    	// dd($data);
    	// 查看次数自增
    	Article::where('id',$art_id)->increment('art_view');
    	return view('Home.new',compact('field','art','data'));
    }
}
