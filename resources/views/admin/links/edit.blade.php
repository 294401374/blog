@extends('layouts.admin')
@section('content')

    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>  &raquo; 编辑友情链接
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑友情链接管理</h3>
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
                <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                <a href="{{url('admin/links')}}"><i class="fa fa-refresh"></i>全部友情链接</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/links/'.$field->id)}}" method="post">
        <!-- token验证 -->
        {{method_field('PUT')}}
        {{csrf_field()}}
            <table class="add_tab">
                <tbody>                    
                     <tr>
                        <th><i class="require">*</i>链接名称：</th>
                        <td>
                            <input type="text" name="links_name" value="{{$field->links_name}}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必填</span>
                        </td>
                    </tr>
                     <tr>
                        <th><i class="require">*</i>url：</th>
                        <td>
                            <input type="text" class="lg" name="links_url" value="{{$field->links_url}}" >
                        </td>
                    </tr>           
                    <tr>
                        <th>连接标题：</th>
                        <td>
                            <input type="text" class="lg" name="links_title" value="{{$field->links_title}}">
                        </td>
                    </tr>                                      
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" class="sm" name="links_order" value="{{$field->links_order}}">
                        </td>
                    </tr>                   
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection