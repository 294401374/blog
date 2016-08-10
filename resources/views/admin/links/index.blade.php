@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 友情链接
    </div>    
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_title">
                <h3>友情链接</h3>
            </div>
            <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                <a href="{{url('admin/links')}}"><i class="fa fa-refresh"></i>全部友情链接</a>
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
                        <th>连接名称</th>
                        <th>连接标题</th>                    
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,{{$v->id}})" name="ord[]" value="{{$v->links_order}}">
                            </td>
                            <!-- 也可以用数组的方式{{$v['id']}} -->
                            <td class="tc">{{$v->id}}</td>
                            <td>
                                <a href="#">{{$v->links_name}}</a>
                            </td>
                            <td>{{$v->links_title}}</td>                         
                            <td>
                                <a href="{{url('admin/links/'.$v->id.'/edit')}}">修改</a>
                                <a href="javascript::" onclick="delLinks({{$v->id}})">删除</a>
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
    function changeOrder(obj,links_id){
        links_order= $(obj).val();
        $.post("{{url('admin/links/changeorder')}}",{'_token':'{{csrf_token()}}','links_id':links_id,'links_order':links_order},function(data){
            // alert(data.msg);layer的官方网站http://layer.layui.com/
            if (data.status) {
                // location.href=location.href;
                layer.msg(data.msg, {icon: 6});
            }else{
                layer.msg(data.msg, {icon: 5});
            }            

        });
    }
    function delLinks(links_id){
        //询问框
        layer.confirm('确定要删除这个链接吗？', {
          btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/links/')}}/"+links_id,{'_method':'delete','_token':"{{csrf_token()}}",'links_id':links_id},function(data){
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