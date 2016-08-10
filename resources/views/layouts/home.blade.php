<!doctype html>
<html>
<head>
<meta charset="utf-8">

@yield('info')
@section('style')
<link href="{{asset('resources/views/Home/css/base.css')}}" rel="stylesheet">
@show

</head>
<body>
<header>
  <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
      @foreach($navs as $k=>$v)
        <a href="{{$v->navs_url}}"><span>{{$v->navs_name}}</span><span class="en">{{$v->navs_alias}}</span></a>
      @endforeach     
    </nav>
</header>

@section('content')
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <div class="news" style="float:left;">
    <h3>
      <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
      @foreach($new as $n)
        <li>
          <a href="{{url('a/'.$n->id)}}" title="{{$n->art_title}}" target="_blank">{{$n->art_title}}</a>
        </li>
      @endforeach      
    </ul>
    <h3 class="ph">
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
      @foreach($top as $t)
        <li>
          <a href="{{url('a/'.$t->id)}}" title="{{$t->art_title}}" target="_blank">{{$t->art_title}}</a>
        </li>
      @endforeach
    
@show

<footer>
  <!-- <p>Design by xxx <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.blog.cn</a>  -->

  <!-- <a href="/">网站统计</a></p> -->
  {!!config('web.copyright')!!}
</footer>
<!-- <script src="{{asset('resources/views/Home/js/silder.js')}}"></script> -->
</body>
</html>
