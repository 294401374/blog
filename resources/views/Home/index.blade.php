@extends('layouts.home')
@section('info')
<title>{{config('web.web_title')}}</title>
  <meta name="keywords" content="个人博客模板,博客模板" />
  <meta name="description" content="寻梦主题的个人博客模板，优雅、稳重、大气,低调。" />
@endsection
@section('style')
@parent
<link href="{{asset('resources/views/Home/css/index.css')}}" rel="stylesheet"> 
@endsection
<!-- <link href="{{asset('resources/views/Home/css/style.css')}}" rel="stylesheet"> -->
@section('content')  
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>后盾</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>站长</span>推荐 recommend</p>
    </h3>
    <ul>
      @foreach($hot as $h)
        <li>
          <a href="{{url('a/'.$h->id)}}"  target="_blank">
          <img src="{{url($h->art_thumb)}}"></a>
          <span>{{$h->art_title}}</span>
        </li>
      @endforeach  
    </ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    @foreach($data as $d)
      <h3>{{$d->art_title}}</h3>
      <figure><img src="{{url($d->art_thumb)}}"></figure>
      <ul>
        <p>{{$d->art_description}}</p>
        <a  href="{{url('a/'.$d->id)}}" target="_blank" class="readmore">阅读全文>></a>
      </ul>
      <p class="dateview">
        <span style="margin: 0 10px;">{{date('Y-m-d',$d->art_time)}}</span>
        <span>{{$d->art_editor}}</span>
      </p>
    @endforeach
    <div class="page">
      {{$data->links()}} 
    </div>  
  </div>
  <aside class="right">
    <!-- <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div> -->
    @parent
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
      @foreach($links as $l)
        <li><a href="{{url($l->links_url)}}">{{$l->links_name}}</a></li>
      @endforeach
    </ul> 
    </div>  
    <!-- Baidu Button BEGIN -->
    
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->   
    </aside>
</article>
<style>
  .page{ margin:20px 0 0 0; text-align:center; width:100%; overflow: hidden;}

.page ul{}
.page ul li{display: inline-block; margin:0; float:left;}
.page ul li span,.page ul li a{margin: 0 2px;height: 26px;line-height: 26px;border-radius: 50%;width: 26px;text-align: center;display: inline-block;}
.page ul li a {margin: 0 2px;height: 26px;line-height: 26px; border-radius: 50%;width: 26px;text-align: center;display: inline-block;}
.page ul li.active span,.page ul li a:hover{background: #333;color: #FFF;}
.page ul li.disabled span{background: #CCC; color: #FFF;}
.page ul li a{color: #F33;border: #999 1px solid;}
</style>
@endsection

