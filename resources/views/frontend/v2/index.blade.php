@extends('frontend.v2.frontend')
@section('content')

    <div class="page-holder">
        <div class="index-page">
            <div class="ads-slideshow">
                <div class="mask">
                    <div class="slideset">
                        @if(isset($response['data']['banners']['sliderBanners']))
                            @foreach($response['data']['banners']['sliderBanners'] as $banner)
                                <div class="slide"><a @if($banner->banner_link !="")href ="{{$banner->banner_link}}" @endif>
                                        <img src="{{$banner->image}}" alt="image description"></a></div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="agent-logos container">
                <div class="mask">
                    <div class="slideset">
                        @foreach(array_chunk($response['data']['agents'], 12) as $agents)
                            <?php
                            foreach($agents as $agent){
                            $image = url('/') . "/assets/imgs/no.png";
                            foreach ($agent->agencies as $agency)
                            {
                                if ($agency->logo != "")
                                {
                                    $image = url('/') . '/temp/' . $agency->logo;
                                }
                            }
                            ?>
                            <div class="slide"><a href="{{ URL::to('agent?agent_id='.$agent->id) }}"><img src="{{$image}}" alt="Agent Logo"></a></div>
                            <?php }?>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="add-holder-page">
                <ul class="Ads">
                    @if(isset($response['data']['banners']['leftBanners']))
                        @foreach($response['data']['banners']['leftBanners'] as $banner)
                            <li><a @if($banner->banner_link !="")href="{{$banner->banner_link}}" @endif><img src="{{$banner->image}}" alt="Image description"></a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="container-holder">
                    <section class="generic-section">
                        <div class="container">
                            <h1>Latest <span>Update</span></h1>
                            <div class="news-sliderHolder">
                                <div class="news-slideshow">
                                    <div class="mask">
                                        <div class="slideset">
                                            @foreach($response['data']['projects'] as $project)
                                                <div class="slide">

                                                    <div class="layout">
                                                        <div class="news-carousel">
                                                            <div class="news-mask">
                                                                <div class="news-slideset">
                                                                    @foreach($project->images as $image)
                                                                        <div class="news-slide"><a href="#"><img src="{{url('/').'/'.$image->image}}" width="495" height="363" alt="image description"></a></div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="news-pagination"></div>
                                                            <a href="#" class="news-btn-prev"><span class="icon-left-arrow"></span></a>
                                                            <a href="#" class="news-btn-next"><span class="icon-right-arrow"></span></a>
                                                        </div>
                                                        <div class="caption">
                                                            <p><b>{{$project->title}}</b> <br />{{str_limit($project->description,400)}}</p>
                                                            {{--<a href="#" class="btn-default text-upparcase">Learn More</a>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="pagination hidden"></div>
                                    <a href="#" class="btn-prev hidden">next</a>
                                    <a href="#" class="btn-next hidden">ok</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="generic-section">
                        <h1>Top <span>Cities</span></h1>
                        {{--<div class="topSocities-holder">--}}
                        {{--<ul class="socities">--}}
                        {{--@foreach($response['data']['importantCities'] as $city)--}}
                        {{--<li>--}}
                        {{--<a href="{{url('/')}}/search?city_id={{$city->id}}">--}}
                        {{--<img src="{{url('/')}}/{{$city->path}}" alt="PARAGON CITY">--}}
                        {{--<div class="caption">--}}
                        {{--<strong class="heading">{{$society->name}}</strong>--}}
                        {{--<ul class="numberOfproperties">--}}
                        {{--<li><span>Commercial</span><span>{{rand(0,100)}}</span></li>--}}
                        {{--<li><span>Home</span><span>{{rand(0,130)}}</span></li>--}}
                        {{--<li><span>Land</span><span>{{rand(0,120)}}</span></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        <div class="cities">
                            <div class="majorDiv pull-left">
                                <a href="{{url('/')}}/search?city_id={{$response['data']['importantCities'][0]->id}}">
                                    <img src="{{ url('/').'/'.$response['data']['importantCities'][0]->path}}" alt="image description">
                                </a>
                            </div>
                            <ul class="common pull-right">
                                @for($i=1;$i<sizeof($response['data']['importantCities']);$i++)
                                    <li><a href="{{url('/')}}/search?city_id={{$response['data']['importantCities'][$i]->id}}">
                                            <img src="{{url('/').'/'.$response['data']['importantCities'][$i]->path}}" alt="image description"></a></li>
                                @endfor
                            </ul>
                        </div>
                    </section>

                    <section class="generic-section agents">
                        <div class="layout">
                            <h1>Featured <span>Agents</span></h1>
                            <div class="agent-slider">
                                <div class="mask">
                                    <div class="slideset">
                                        @foreach(array_chunk($response['data']['agents'], 9) as $agents)
                                            <div class="slide">
                                                <ul class="agents-logo">
                                                    <?php
                                                    foreach($agents as $agent){
                                                    $image = url('/') . "/assets/imgs/no.png";
                                                    foreach ($agent->agencies as $agency)
                                                    {
                                                        if ($agency->logo != "")
                                                        {
                                                            $image = url('/') . '/temp/' . $agency->logo;
                                                        }
                                                    }
                                                    ?>
                                                    <li><a href="{{ URL::to('agent?agent_id='.$agent->id) }}"><img src="{{$image}}" alt="image description"></a></li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                         @endforeach

                                    </div>
                                </div>
                                <div class="pagination"></div>
                                {{--<a href="#" class="btn-prev"><span class="icon-left-arrow"></span></a>--}}
                                {{--<a href="#" class="btn-next"><span class="icon-right-arrow"></span></a>--}}
                            </div>
                        </div>
                    </section>
                    <section class="generic-section about-us" id="about-us">
                        <div class="container text-center">
                            <h1>About <span>Us</span></h1>
                            <p>nugree.com is friendly portal website. We are providing a maximum feature with minimum exercise, here you can find your desired property on single click.</p>
                            <p>nugree.com is providing flexible search for user which will provide potential clients with a better overall online experience.
                                With modern housing and societies services and a growing population, nugree.com is a unique regional center and offers plenty of lifestyle and investment opportunity.
                                nugree.com is providing a complete property maintenance solution package that address user,s needs. Our approach is simple. We provide professional, trustworthy property management services</p>
                        </div>
                    </section>
                    <section class="generic-section questions" id="contact-us">
                        <div class="container text-center">
                            <h1>Have any <span>Question?</span></h1>
                            <p>Please Let us know if you need some help, our team is always ready to help you!</p>
                            {{ Form::open(array('url' => 'contact_us','method' => 'POST','class'=>'submit-query text-left')) }}

                            <div class="layout">
                                <div class="input-holder"><input type="text" name="name" placeholder="Your Name"></div>
                                <div class="input-holder"><input type="email" name="email" placeholder="Your Email" required></div>
                                <div class="input-holder"><input type="text" name="subject" placeholder="Subject"></div>
                            </div>
                            <div class="layout">
                                <div class="input-holder full-width"><textarea placeholder="Your Message" name="message" required></textarea></div>
                            </div>
                            <button type="submit"><span>Submit</span></button>
                            {{Form::close()}}
                        </div>
                    </section>
                </div>
                <ul class="Ads">
                    @if(isset($response['data']['banners']['rightBanners']))
                        @foreach($response['data']['banners']['rightBanners'] as $banner)
                            <li><a @if($banner->banner_link !="")href="{{$banner->banner_link}}" @endif><img src="{{$banner->image}}" alt="Image description"></a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection