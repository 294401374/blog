<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //get Admin/article 全部文章列表
    public function index(){
    	$data = Article::orderBy('id','dec')->paginate(10);
    	return view('admin.article.index',compact('data'));
    }
    public function create(){
    	$data = (new Category)->tree();
    	return view('admin.article.add',compact('data'));
    }
    // Post admin/category 添加文章提交
    public function store(){
    	$input = Input::except('_token');
    	// dd($input);
    	$input['art_time'] = time();
        // 规则
        $rules = [
                'art_title'=>'required',
                'art_content'=>'required',
            ];
            // 报错信息
        $message= [
            'art_title.required'=>'文章标题不能为空！',
            'art_content.required'=>'文章内容不能为空！',              
        ];
        // 引入Validator这个服务
       $Validator=Validator::make($input,$rules,$message);
        if ($Validator->passes()) {
            $rs = Article::create($input);
            if ($rs) {
               return redirect('admin/article');
            }else{
                return back()->with('errors','数据填充失败，请稍候重试！');
            }       
        }else{
            return back()->withErrors($Validator);
        }
    }
    //get.admin/article/{aritcle}/edit  编辑文章
    public function edit($art_id){
        $data = (new Category)->tree();
        $field = Article::find($art_id);
    	return view('admin.article.edit',compact('data','field'));
    }
    public function update($art_id){
        $input=Input::except('_token','_method');
        // 规则
        $rules = [
                'art_title'=>'required',
                'art_content'=>'required',
            ];
            // 报错信息
        $message= [
            'art_title.required'=>'文章标题不能为空！',
            'art_content.required'=>'文章内容不能为空！',              
        ];
        // 引入Validator这个服务
       $Validator=Validator::make($input,$rules,$message);
        if ($Validator->passes()) {
            $rs = Article::where('id','')->updata($input);
            if ($rs) {
               return redirect('admin/article');
            }else{
                return back()->with('errors','数据修改错误，请稍候重试！');
            }       
        }else{
            return back()->withErrors($Validator);
        }
    }
    // Delete admin/article/{} 删除单个文章
    public function destroy(){
        $input = Input::except('_method','_token');
            $rs = Article::where('id',$input['art_id'])->delete();
            if ($rs) {
                $data = [
                    'status' => 1,
                    'msg'    => '删除成功',
                ];
            }else{
                $data = [
                    'status' => 0,
                    'msg'    => '删除失败',
                ];
            }                     
        return $data;
    }
}
