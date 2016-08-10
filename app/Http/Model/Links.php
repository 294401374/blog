<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';
    // 如果你的主键是user_id的话可以在这里设置
    protected $primaryKey = 'id';
    // 如果没有下面的设置的话 数据库更新时候就得多加两个字段updata和一个字段
    public $timestamps = false;
     // 用create方法填充数据时候会有个保护措施 $guarded=[];是表示哪些字段不能填充
    // 在文档的Eloquent ORM篇章细看 
    protected $guarded=[];
}
