@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 自定义导航
    </div>    
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_title">
                <h3>自定义导航</h3>
            </div>
            <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加自定义导航</a>
                <a href="{{url('admin/navs')}}"><i class="fa fa-refresh"></i>全部自定义导航</a>
            </div>
        </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th width="15%">导航名称</th>
                        <th width="10%">导航别名</th> 
                        <th>URL</th>                   
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,{{$v->id}})" name="ord[]" value="{{$v->navs_order}}">
                            </td>
                            <!-- 也可以用数组的方式{{$v['id']}} -->
                            <td class="tc">{{$v->id}}</td>
                            <td>
                                <a href="#">{{$v->navs_name}}</a>
                            </td>
                            <td>{{$v->navs_alias}}</td>   
                            <td>{{$v->navs_url}}</td>                        
                            <td>
                                <a href="{{url('admin/navs/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript::" onclick="delnavs({{$v->id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>                
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <!-- 异步更改排序cate_order -->
<script>
    function changeOrder(obj,navs_id){
        navs_order= $(obj).val();
        $.post("{{url('admin/navs/changeorder')}}",{'_token':'{{csrf_token()}}','navs_id':navs_id,'navs_order':navs_order},function(data){
            // alert(data.msg);layer的官方网站http://layer.layui.com/
            if (data.status) {
                // location.href=location.href;
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }            

        });
    }
    function delnavs(navs_id){
        //询问框
        layer.confirm('确定要删除这个链接吗？', {
          btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/navs/')}}/"+navs_id,{'_method':'delete','_token':"{{csrf_token()}}",'navs_id':navs_id},function(data){
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