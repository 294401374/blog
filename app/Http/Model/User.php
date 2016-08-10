<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //默认表名是users 所以改成自己的
    protected $table = 'user';
    // 如果你的主键是user_id的话可以在这里设置
    protected $primaryKey = 'id';
    // 如果没有下面的设置的话 数据库更新时候就得多加两个字段updata和一个字段
    public $timestamps = false;
}
