@extends('layouts.home')
@section('info')
  <title>{{config('web.web_title')}}</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
@endsection
@section('style')
@parent
<link href="{{asset('resources/views/Home/css/style.css')}}" rel="stylesheet">
@endsection
@section('content')
  <article class="blogs">
<h1 class="t_nav"><span>{{$cate->cate_description}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('list/'.$cate->id)}}" class="n2">{{$cate->cate_name}}</a></h1>
<div class="newblog left">
@foreach($data as $d)
   <h2>{{$d->art_title}}</h2>
   <p class="dateviews"><span>发布时间：{{date('Y-m-d,$d->art_time')}}</span><span>作者：{{$d->art_editor}}</span><span>分类：[<a href="/news/life/">程序人生</a>]</span></p>
    <figure><img src="{{url($d->art_thumb)}}"></figure>
    <ul class="nlist">
      <p>{{$d->art_description}}</p>
      <a title="{{$d->art_title}}" href="{{url('a/'.$d->id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <div class="line"></div>
@endforeach     
    
    <div class="page">
      {{$data->links()}}
    </div>
</div>

<aside class="right">
@if($category->all())
  <div class="rnav">
    <ul>
    @foreach($category as $k=>$c)
      <li class="rnav{{$k+1}}"><a href="{{url('list/'.$c->id)}}" target="_blank">{{$c->cate_name}}</a></li>
    @endforeach
  </div>
@endif
<div class="news">
    @parent
</div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->   
</aside>
</article>
@endsection



<!--[if lt IE 9]>
<script src="{{asset('resources/views/Home/js/modernizr.js')}}"></script>
<![endif]-->


