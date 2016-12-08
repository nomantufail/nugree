@extends('frontend.v1.frontend')
@section('content')
    <div class="index-page">
        <div class="news-slideshow">
            <div class="mask">
                <div class="container">
                    {{ Form::open(array('url' => 'search','method' => 'GET' ,'class'=>'mainSearch-form')) }}
                    <input type="hidden" name="wanted" id="wanted-pro" value="0" checked>
                    <ul class="typeOfBuying">
                        <li>
                            <label for="buy" class="customRadio">
                                <input type="radio" name="purpose_id" id="buy" value="1" checked>
                                <span class="fake-label">Buy</span>
                            </label>
                        </li>
                        <li>
                            <label for="rent" class="customRadio">
                                <input type="radio" name="purpose_id" id="rent" value="2">
                                <span class="fake-label">Rent</span>
                            </label>
                        </li>
                        {{--<li>--}}
                            {{--<label for="wanted" class="customRadio">--}}
                                {{--<input type="radio" name="purpose_id" value="3" id="wanted">--}}
                                {{--<span class="fake-label">Wanted</span>--}}
                            {{--</label>--}}
                        {{--</li>--}}
                    </ul>
                    <ul class="subTypes">
                        <li>
                            <label for="all" class="customRadio">
                                <input type="radio" name="property_type_id" id="all" checked value="">
                                <span class="fake-radio"></span>
                                <span class="fake-label">All Types</span>
                            </label>
                        </li>
                        @foreach($response['data']['propertyTypes'] as $propertyType)
                            <li>
                                <label for="{{$propertyType->id}}" class="customRadio">
                                    <input type="radio" name="property_type_id" id="{{$propertyType->id}}" value="{{$propertyType->id}}" >
                                    <span class="fake-radio"></span>
                                    <span class="fake-label">{{$propertyType->name}}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <span class="select-load">
                        <select class="js-example-basic-single" id="cities-select" name="city_id">
                            <option value="">Select City</option>
                            @foreach($response['data']['cities'] as $city)
                                <option value="{{$city->id}}" @if($city->id == 1) selected @endif>{{$city->name}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="select-load">
                        <input id="selectbox" class="ajax-locations-select" name="location_id">
                    </span>
                    <button type="submit">Search<span class="icon-arrow-right"></span></button>
                    {{Form::close()}}
                    {{--<div class="btn-holder">--}}
                        {{--<ul class="total-slides">--}}
                            {{--<li><span class="cur-num">0</span></li>--}}
                            {{--<li><span class="all-num">0</span></li>--}}
                        {{--</ul>--}}
                        {{--<div class="btn-container">--}}
                            {{--<a href="#" class="btn-prev"><span class="icon-arrow-left"></span></a>--}}
                            {{--<a href="#" class="btn-next"><span class="icon-arrow-right"></span></a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="slideset">
                    <div class="slide">
                        <img src="{{url('/')}}/web-apps/frontend/assets/images/gawadar.jpg" alt="gawadar city">
                        <div class="container">
                            <div class="caption">
                                <h2>Gwadar <span>City</span></h2>
                                <strong>Land Of Opportunites</strong>
                                <a href="#join-us-pro" class="btn-default lightbox">Join us !</a>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <img src="{{url('/')}}/web-apps/frontend/assets/images/lahore.jpg" alt="gawadar city">
                        <div class="container">
                            <div class="caption">
                                <h2>Lahore <span>City</span></h2>
                                <strong>our campaign starts form Lahore and growing...</strong>
                                <a href="#join-us-pro" class="btn-default lightbox">Join us !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="agent-slider">
            <h2>Top Agents</h2>
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
                                 <div class="slide"><a href="{{ URL::to('agent/'.$agent->agencies[0]->slug) }}"><img src="{{$image}}" alt="image description"></a></div>
                            <?php }?>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="cities-section text-center">
            <h2><span>Top</span> Cities</h2>
            <div class="layout">
                <div class="col">
                    <a href="{{URL::to('city').'/'.$response['data']['importantCities'][0]->slug}}">
                        <img src="{{ \App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$response['data']['importantCities'][0]->path}}" alt="image description">
                        <span class="title">{{$response['data']['importantCities'][0]->city}}</span>
                    </a>
                </div>
                <div class="col">
                    <ul>
                        @for($i=1;$i<sizeof($response['data']['importantCities']);$i++)
                         <li><a href="{{URL::to('city').'/'.$response['data']['importantCities'][$i]->slug}}">
                                <img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$response['data']['importantCities'][$i]->path}}" alt="image description">
                                 <span class="title">{{$response['data']['importantCities'][$i]->city}}</span>
                             </a>
                         </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="projects-slideshow">
            <div class="mask">
                <h2>Projects</h2>
                <div class="slideset">
                  @foreach($response['data']['projects'] as $project)
                    <div class="slide">
                        <img src="@if(isset($project->images[0]->image)){{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$project->images[0]->image}}@endif" alt="image description">
                        <div class="container">
                            <div class="caption">
                                <strong class="heading">{{$project->title}}</strong>
                                <p>{{str_limit($project->description,400)}}<a href="#">{{--Read more..--}}</a></p>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
                <a href="#" class="btn-prev"><span class="icon-keyboard_arrow_left"></span></a>
                <a href="#" class="btn-next"><span class="icon-keyboard_arrow_right"></span></a>
                {{--<a href="#" class="btn-default">View all projects</a>--}}
            </div>
        </div>
        <div class="mobile-app">
            <div class="container">
                <img src="{{url('/')}}/web-apps/frontend/assets/images/img07.png" alt="image description" class="mobile-img">
                <div class="caption text-center">
                    <h2><span>Mobile</span> App</h2>
                    <strong class="heading">Coming Soon..</strong>
                    <div class="logo"><img src="{{url('/')}}/web-apps/frontend/assets/images/logo.png" alt="nugree"></div>
                </div>
            </div>
        </div>
        <div class="about-us text-center" id="about-us">
            <h2><span>About</span> Us</h2>
            <div class="description">
                {{--<h2>What is Lorem Ipsum?</h2>--}}
                <p>Nugree.com is a friendly property portal.We are providing maximum features with minimum exercise, here you can find your desired property on few clicks.</p>
                <p>Nugree.com is providing flexible search for users which will provide potential clients and investors.
                    we are still working on it, to make it a best property portal.
                    Your Suggestions are welcome here: </p>
            </div>
        </div>
        <div class="latest-news">
            <div class="mask">
                <div class="slideset">
                    @foreach($response['data']['news'] as $news)
                        <div class="slide">
                            <div class="container">
                                <h2>{{str_limit($news->title,30)}}</h2>
                                <p>{{ str_limit($news->description,150)}}</p>
                                <a href="get/news?news_id={{$news->id}}" class="btn-default">READ MORE</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="heading-btns">
                <h2>NEWS</h2>
                <a href="#" class="btn-prev"><span class="icon-arrow-left"></span></a>
                <a href="#" class="btn-next"><span class="icon-arrow-right"></span></a>
            </div>
        </div>
        <a href="#wrapper" class="search-property back-to-top"><span class="icon-search"></span> Search <br>property</a>
        <div class="popup-holder">
            <div id="join-us-pro" class="lightbox generic-lightbox">
                <span class="lighbox-heading">Join us for <span>Project</span></span>
               {{Form::open(array('url' => 'join-us','method' => 'POST' ,'class'=>"inquiry-email-form"))}}
                    <input type="hidden" name="type" value="join_us">
                    <div class="field-holder">
                        <label for="join-name">Name</label>
                        <div class="input-holder"><input type="text" id="join-name" name="name" required></div>
                    </div>
                    <div class="field-holder">
                        <label for="join-email">Email</label>
                        <div class="input-holder"><input type="email" id="join-email" name="email" required></div>
                    </div>
                    <div class="field-holder">
                        <label for="join-phone">Mobile</label>
                        <div class="input-holder"><input type="tel" id="join-phone" name="phone" required></div>
                    </div>
                    <div class="field-holder">
                        <label for="purpose-id">Purpose</label>
                        <div class="input-holder">
                            <input type="text" id="purpose-id" name="purpose">
                        </div>
                    </div>
                    <div class="field-holder">
                        <label for="join-address">Address</label>
                        <div class="input-holder"><input type="text" id="join-address" name="address"></div>
                    </div>
                    <div class="field-holder">
                        <label for="join-message">Message</label>
                        <div class="input-holder">
                            <textarea id="join-message" name="message"></textarea>
                            <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms of Use</a></p>
                        </div>
                    </div>
                    <button type="submit">SEND</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection