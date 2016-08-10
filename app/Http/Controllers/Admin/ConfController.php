<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Conf;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfController extends Controller
{
    //
    // Get admin/conf  全部配置列表
    public function index(){
    	$data = Conf::orderBy('conf_order','asc')->get();
        // dd($data[0]['field_type']);
        foreach ($data as $k => $v) {
            switch ($v->field_type) {
                case 'input':
                    $data[$k]->_html='<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'"/>';
                    // echo $data->_html;
                    break;                
                case 'textarea':
                   $data[$k]->_html='<textarea type="text" class="lg" name="conf_content[]" >'.$v->conf_content.'</textarea>';
                   // echo $data->_html;
                    break;
                case 'radio':
                    // 1|开启,0|关闭
                    $str='';
                    $arr = explode(',', $v->field_value);
                    foreach ($arr as $n => $m) {
                        $a = explode('|',$m);
                        $c = $v->conf_content==$a[0]?' checked':'';
                        $str.='<input type="radio" name="conf_content[]" value="'.$a[0].'" '.$c.'/>'.$a[1];
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
    	return view('admin.conf.index',compact('data'));
    }
    // // 更改内容的
    public function changeContent(){
        $input = Input::all();
        foreach ($input['conf_id'] as $k => $v) {
           // echo $k .'=>'. $v;
            Conf::where('id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','配置更改成功！');
    }
    // 接受ajax的数据
    public function changeOrder(){
        $input = Input::all();
        $conf=conf::find($input['conf_id']);
        $conf->conf_order = $input['conf_order'];
        // 更新完成之后会有个返回值 成功返回1失败返回0
        $rs = $conf->update();
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
    // 写入配置项文件
    public function putFile(){
        $conf = Conf::pluck('conf_content','conf_name')->all();
        // 要写进去的配置文件路径        
        $path = base_path().'\config\web.php';
        // 把变量写进去了
        $str = '<?php return '.var_export($conf,true).';';
        // 函数把一个字符串写入文件中。
        file_put_contents($path,$str);
    }
    // Get admin/conf/create 添加配置
    public function create(){
        return view('admin.conf.add');
    }
    // Post admin/conf 添加分类提交
    public function store(){
        // except('_token');除了_token数据外的所有数据
        $input = Input::except('_token');
        // 规则
        $rules = [
                'conf_name'=>'required',
                'conf_title'=>'required',
            ];
            // 报错信息
            $message= [
                'conf_name.required'=>'分类名称不能为空！',     
                'conf_title.required'=>'分类标题不能为空！',            
            ];
            // 引入Validator这个服务
           $Validator=Validator::make($input,$rules,$message);
            if ($Validator->passes()) {
                $rs=Conf::create($input);
                if ($rs) {
                   return redirect('admin/conf');
                }else{
                    return back()->with('errors','配置添加错误，请稍候重试！');
                }       
            }else{
                return back()->withErrors($Validator);
            }
    }
    //get.admin/conf/{conf}/edit  编辑配置
    public function edit($conf_id){
        $field=conf::find($conf_id);
        return view('admin.conf.edit',compact('field','data'));
    }
    // Put admin/conf{} 更新配置 put方法提交的方法
    public function update($conf_id){
        $input=Input::except('_token','_method'); 
        // dd($input);
        $rs = conf::where('id',$conf_id)->update($input);
        if ($rs) {
            $this->putFile();
            return redirect('admin/conf');  
        }else{
            return back()->with('errors','分类更新失败，请稍候重试！');
        }
    }
    public function show(){

    }
     // Delete admin/conf/{} 删除单个
    public function destroy(){
    // public function destroy($cate_id){ 这个方法也是可以的
        $input = Input::except('_method','_token');
            $rs = conf::where('id',$input['conf_id'])->delete();
            if ($rs) {
                $this->putFile();
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
