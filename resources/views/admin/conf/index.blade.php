@extends('layouts.admin')
@section('content')

    <!--面包屑配置项 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 配置项
    </div>    
    
        <div class="result_wrap">
            <!--快捷配置项 开始-->
            <div class="result_title">
                <h3>配置项</h3>
                 @if(count($errors)>0)
                    <div class="mark">
                        @if(is_object($errors))
                            @foreach($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        @else
                            <p>{{$errors}}</p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
                <a href="{{url('admin/conf')}}"><i class="fa fa-refresh"></i>全部配置项</a>
            </div>
        </div>
            <!--快捷配置项 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
            <form action="{{url('admin/conf/changecontent')}}" method="post">
                {{csrf_field()}}
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>标题</th>
                        <th>名称</th>      
                        <th>内容</th>              
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,{{$v->id}})" name="ord[]" value="{{$v->conf_order}}">
                            </td>
                            <!-- 也可以用数组的方式{{$v['id']}} -->
                            <td class="tc">{{$v->id}}</td>
                            <td>
                                <a href="#">{{$v->conf_title}}</a>
                            </td>
                            <td>{{$v->conf_name}}</td> 
                            <td>
                                <input type="hidden" name="conf_id[]" value="{{$v->id}}">
                                {!!$v->_html!!}
                            </td>                        
                            <td>
                                <a href="{{url('admin/conf/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript::" onclick="delconf({{$v->id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach                         
                </table>   
                    <div class="btn_group">

                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </div>             
                </form>               
            </div>
        </div>
    
    <!--搜索结果页面 列表 结束-->
    <!-- 异步更改排序cate_order -->
<script>
    function changeOrder(obj,conf_id){
        conf_order= $(obj).val();
        $.post("{{url('admin/conf/changeorder')}}",{'_token':'{{csrf_token()}}','conf_id':conf_id,'conf_order':conf_order},function(data){
            // alert(data.msg);layer的官方网站http://layer.layui.com/
            if (data.status) {
                // location.href=location.href;
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }            

        });
    }
    function delconf(conf_id){
        //询问框
        layer.confirm('确定要删除这个链接吗？', {
          btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/conf/')}}/"+conf_id,{'_method':'delete','_token':"{{csrf_token()}}",'conf_id':conf_id},function(data){
                if(data.status){
                    location.href=location.href;
                    layer.msg(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
            
        }, function(){
          
        });
        // alert($cate_id);
    }
</script>


@endsection