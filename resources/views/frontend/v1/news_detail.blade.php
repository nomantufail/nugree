@extends('frontend.v1.frontend')
@section('content')
<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/news-detail.css">
  <div class="news-full-page-ui container">
    <div class="col-holder">
        <div class="col">
            <h1><span>Hot</span> News </h1>
            <div class="detail-news-slider">
                <div class="mask">
                    <div class="slideset">
                     @if(isset($response['data']['news']->images[0]))
                        <div class="slide"><img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$response['data']['news']->images[0]->image}}" alt="image description"></div>
                     @endif
                    </div>
                </div>
                {{--<a href="#" class="btn-prev"><span class="icon-keyboard_arrow_left"></span></a>--}}
                {{--<a href="#" class="btn-next"><span class="icon-keyboard_arrow_right"></span></a>--}}
            </div>
            <div class="plugin-date-ui">
                <div class="side">
                    <ul>
                        <li><div class="fb-like" data-href="http://nugree.com/get/news?news_id={{$response['data']['news']->id}}" data-layout="standard" data-action="like" data-size="small" og:title="waqas" data-show-faces="true" data-share="true"></div></li>
                        <li></li>
                    </ul>
                </div>
                <div class="side text-right">
                    <time datetime="2013-08-23"><strong>Date</strong> : {{date("M Y-d",strtotime(stripslashes($response['data']['news']->createdAt)))}}</time>
                </div>
            </div>
            <div class="description">
                <h2>{{$response['data']['news']->title}}</h2>
                <p>{{$response['data']['news']->description}}</p>
            </div>
        </div>
        <div class="col">
            <h1>Recent News Posts</h1>
            <div class="trend-news">
                <div class="mask">
                    <div class="slideset">
                        @foreach($response['data']['recentNews'] as $news)
                        <div class="slide">
                            <a href="{{URL::to('get/news?news_id=').$news->id}}">
                                <time datetime="2013-08-23">{{date("M Y-d",strtotime(stripslashes($news->createdAt)))}}</time>
                                <span>{{str_limit($news->title,40)}}</span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <a href="#" class="btn-prev"><span class="icon-keyboard_arrow_up"></span></a>
                    <a href="#" class="btn-next"><span class="icon-keyboard_arrow_down"></span></a>
                </div>
            </div>
            {{--<div class="subscribe-area">--}}
                {{--<strong class="heading"><span class="icon-newspaper-report"></span>Subscribe For Daily News Alert</strong>--}}
                {{--<span class="slogan">Enter Your Email Address Below</span>--}}
                {{--<form>--}}
                    {{--<div class="input-holder"><input type="email" required></div>--}}
                    {{--<button type="submit"><span>Subscribe</span></button>--}}
                {{--</form>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
@endsection