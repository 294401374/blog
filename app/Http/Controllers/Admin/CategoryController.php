<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{	
	// Get admin/category  全部分类列表
    public function index($pid=0){
    	$categorys = (new Category)->tree();
    	return view('admin.category.index')->with('data',$categorys);
    }    
     // 接受ajax的数据
    public function changeOrder(){
        $input = Input::all();
        $category=Category::find($input['cate_id']);
        $category->cate_order = $input['cate_order'];
        // 更新完成之后会有个返回值 成功返回1失败返回0
        $rs = $category->update();
        if ($rs) {
            $data = [
                'status'=>'1',
                'msg'   =>'排序编号更改成功！',
            ];
        }else{
            $data = [
                'status'=> '0',
                'msg'   => '排序编号更改失败，请重试！',
            ];
        }
        return $data;
    }
    // Post admin/category 添加分类提交
    public function store(){
        // except('_token');除了_token数据外的所有数据
        $input = Input::except('_token');
        // 规则
        $rules = [
                'cate_name'=>'required',
            ];
            // 报错信息
            $message= [
                'cate_name.required'=>'分类名称不能为空！',                
            ];
            // 引入Validator这个服务
           $Validator=Validator::make($input,$rules,$message);
            if ($Validator->passes()) {
                $rs=Category::create($input);
                if ($rs) {
                   return redirect('admin/category');
                }else{
                    return back()->with('errors','分类添加错误，请稍候重试！');
                }       
            }else{
                return back()->withErrors($Validator);
            }
    }
    // Get admin/category/create 添加分类 
    public function create(){
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }
      //get.admin/category/{category}/edit  编辑分类
    public function edit($cate_id){
        $data = Category::where('cate_pid',0)->get();
        $field=Category::find($cate_id);
        // dd($cate_id);
        return view('admin.category.edit',compact('field','data'));
    }
    // Put admin/category{} 更新分类 put方法提交的方法
    public function update($cate_id){
        $input=Input::except('_token','_method');
        // dd($input);
        $rules = [
                'cate_name'=>'required',
            ];
            // 报错信息
            $message= [
                'cate_name.required'=>'分类名称不能为空！',                
            ];
            // 引入Validator这个服务
           $Validator=Validator::make($input,$rules,$message);
            if ($Validator->passes()) {
                $rs = Category::where('id',$cate_id)->update($input);
                if ($rs) {
                    return redirect('admin/category');  
                }else{
                    return back()->with('errors','分类更新失败，请稍候重试！');
                }
            }else{
                return back()->withErrors($Validator);
            }
            //更新数据
        // $rs = Category::where('id',$cate_id)->update($input);
        // if ($rs) {
        //     return redirect('admin/category');  
        // }else{
        //     return back()->with('errors','分类更新失败，请稍候重试！');
        // }
    }
    // Get admin/category/{} 显示单个分类信息
    public function show(){

    }
    // Delete admin/category/{} 删除单个分类
    public function destroy(){
    // public function destroy($cate_id){ 这个方法也是可以的
        $input = Input::except('_method','_token');
        $cate = Category::where('cate_pid',$input['cate_id'])->get();
        // dd(count($cate));
        if (count($cate)) {
             $data = [
                    'status' => 0,
                    'msg'    => '此分类下面有子分类不能删除!',
                ];           
        }else{
            $rs = Category::where('id',$input['cate_id'])->delete();
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
        }             
        return $data;
    }
    
   


}
