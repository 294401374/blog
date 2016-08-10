@extends('layouts.home')
@section('info')
<title>{{config('web.web_title')}}</title>
  <!-- <title>ddd</title> -->
  <meta name="keywords" content="寻梦主题的个人博客模板" />
  <meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
@endsection

@section('style')
@parent
<link href="{{asset('resources/views/Home/css/new.css')}}" rel="stylesheet">
@endsection

@section('content')<!doctype html>
<article class="blogs">
  <h1 class="t_nav">
    <span>您当前的位置：
      <a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="{{url('list/'.$field->cate_id)}}">{{$field->cate_name}}</a>
    </span>
    <a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('list/'.$field->cate_id)}}" class="n2">{{$field->cate_name}}</a></h1>

  <div class="index_about">
    <h2 class="c_titile">{{$field->art_title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$field->art_time)}}</span><span>编辑：{{$field->art_editor}}</span><span>查看次数：{{$field->art_view}}</span></p>
    <ul class="infos">
      {!!$field->art_content!!}
    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：{{$field->art_keywords}}</p>
    
    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
      <p>上一篇：
      @if($art['pre'])
        <a href="{{url('a/'.$art['pre']->id)}}">{{$art['pre']->art_title}}</a>
      @else
        <span>已经是第一篇文章</span>
      @endif
      </p>
      <p>下一篇：
        @if($art['next'])
        <a href="{{url('a/'.$art['next']->id)}}">{{$art['next']->art_title}}</a>
        @else
        <span>已经是第最后一篇文章</span>
        @endif
      </p>
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        @foreach($data as $d)
        <li><a href="{{url('a'.$d->id)}}" title="{{$d->art_title}}">{{$d->art_title}}</a></li>
        @endforeach
        <!-- <li><a href="/newstalk/mood/2013-07-24/518.html" title="我希望我的爱情是这样的">我希望我的爱情是这样的</a></li>
        <li><a href="/newstalk/mood/2013-07-02/335.html" title="有种情谊，不是爱情，也算不得友情">有种情谊，不是爱情，也算不得友情</a></li>
        <li><a href="/newstalk/mood/2013-07-01/329.html" title="世上最美好的爱情">世上最美好的爱情</a></li>
        <li><a href="/news/read/2013-06-11/213.html" title="爱情没有永远，地老天荒也走不完">爱情没有永远，地老天荒也走不完</a></li>
        <li><a href="/news/s/2013-06-06/24.html" title="爱情的背叛者">爱情的背叛者</a></li> -->
      </ul>
    </div>
  </div>
  <aside class="right">
    <!-- Baidu Button BEGIN -->   
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->
    <div class="blank"></div>
    <div class="news">     
      @parent
    </div>
  </aside>
</article>
@endsection