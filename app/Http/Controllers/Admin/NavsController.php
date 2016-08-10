<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Navs;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    //
    // Get admin/navs  全部导航栏列表
    public function index(){
    	$data = navs::orderBy('navs_order','asc')->get();
    	return view('admin.navs.index',compact('data'));
    }
    // 接受ajax的数据
    public function changeOrder(){
        $input = Input::all();
        $navs=navs::find($input['navs_id']);
        $navs->navs_order = $input['navs_order'];
        // 更新完成之后会有个返回值 成功返回1失败返回0
        $rs = $navs->update();
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
    // Get admin/navs/create 添加导航栏
    public function create(){
        return view('admin.navs.add');
    }
    // Post admin/navs 添加分类提交
    public function store(){
        // except('_token');除了_token数据外的所有数据
        $input = Input::except('_token');
        // 规则
        $rules = [
                'navs_name'=>'required',
                'navs_url'=>'required',
            ];
            // 报错信息
            $message= [
                'navs_name.required'=>'分类名称不能为空！',     
                'navs_url.required'=>'分类地址不能为空！',            
            ];
            // 引入Validator这个服务
           $Validator=Validator::make($input,$rules,$message);
            if ($Validator->passes()) {
                $rs=navs::create($input);
                if ($rs) {
                   return redirect('admin/navs');
                }else{
                    return back()->with('errors','导航栏添加错误，请稍候重试！');
                }       
            }else{
                return back()->withErrors($Validator);
            }
    }
    //get.admin/navs/{navs}/edit  编辑导航栏
    public function edit($navs_id){
        $field=navs::find($navs_id);
        return view('admin.navs.edit',compact('field'));
    }
    // Put admin/navs{} 更新导航栏 put方法提交的方法
    public function update($navs_id){
        $input=Input::except('_token','_method'); 
        $rs = navs::where('id',$navs_id)->update($input);
        if ($rs) {
            return redirect('admin/navs');  
        }else{
            return back()->with('errors','分类更新失败，请稍候重试！');
        }
    }
    public function show(){

    }
     // Delete admin/navs/{} 删除单个
    public function destroy(){
    // public function destroy($cate_id){ 这个方法也是可以的
        $input = Input::except('_method','_token');
            $rs = navs::where('id',$input['navs_id'])->delete();
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
