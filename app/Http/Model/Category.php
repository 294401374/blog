<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //默认表明是users 所以改成自己的
    protected $table = 'cate';
    // 如果你的主键是user_id的话可以在这里设置
    protected $primaryKey = 'id';
    // 如果没有下面的设置的话 数据库更新时候就得多加两个字段updata和一个字段
    public $timestamps = false;
    // 用create方法填充数据时候会有个保护措施 $guarded=[];是表示哪些字段不能填充
    // 在文档的Eloquent ORM篇章细看 
    protected $guarded=[];

    // 取出数据
    public function tree($pid=0){
    	$data = $this->getTree($pid);
    	return $data;
    }

    // 无限极分类
    public function getTree($pid=0,&$arr=array(),$space=0){
        $category = Category::where('cate_pid',$pid)->orderBy('cate_order','asc')->get();
        $space = $space+2;       
        foreach($category as $k=>$v){
            // 添加空格和分类的样子
            $v['cate_name']=str_repeat('&nbsp;&nbsp;',$space).'|--'.$v['cate_name'];
            $arr[]=$v;
            $this->getTree($v['id'],$arr,$space);
        }
        return $arr;
    }
}
