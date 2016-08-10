<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Links;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //
    // Get admin/links  全部友情连接列表
    public function index(){
    	$data = Links::orderBy('links_order','asc')->get();
    	return view('admin.links.index',compact('data'));
    }
    // 接受ajax的数据
    public function changeOrder(){
        $input = Input::all();
        $links=Links::find($input['links_id']);
        $links->links_order = $input['links_order'];
        // 更新完成之后会有个返回值 成功返回1失败返回0
        $rs = $links->update();
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
    // Get admin/links/create 添加友情链接
    public function create(){
        return view('admin.links.add');
    }
    // Post admin/links 添加分类提交
    public function store(){
        // except('_token');除了_token数据外的所有数据
        $input = Input::except('_token');
        // 规则
        $rules = [
                'links_name'=>'required',
                'links_url'=>'required',
            ];
            // 报错信息
            $message= [
                'links_name.required'=>'分类名称不能为空！',     
                'links_name.required'=>'分类名称不能为空！',            
            ];
            // 引入Validator这个服务
           $Validator=Validator::make($input,$rules,$message);
            if ($Validator->passes()) {
                $rs=Links::create($input);
                if ($rs) {
                   return redirect('admin/links');
                }else{
                    return back()->with('errors','友情链接添加错误，请稍候重试！');
                }       
            }else{
                return back()->withErrors($Validator);
            }
    }
    //get.admin/links/{links}/edit  编辑友情链接
    public function edit($links_id){
        $field=Links::find($links_id);
        return view('admin.links.edit',compact('field'));
    }
    // Put admin/links{} 更新友情链接 put方法提交的方法
    public function update($links_id){
        $input=Input::except('_token','_method'); 
        $rs = Links::where('id',$links_id)->update($input);
        if ($rs) {
            return redirect('admin/links');  
        }else{
            return back()->with('errors','分类更新失败，请稍候重试！');
        }
    }
    public function show(){

    }
     // Delete admin/links/{} 删除单个
    public function destroy(){
    // public function destroy($cate_id){ 这个方法也是可以的
        $input = Input::except('_method','_token');
            $rs = Links::where('id',$input['links_id'])->delete();
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
