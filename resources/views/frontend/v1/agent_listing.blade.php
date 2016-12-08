@extends('frontend.v1.frontend')
@section('content')
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/property-agent-listing.css">
        <div class="agent-listing-page">
            <div class="container">
                <a class="aside-opener-filters togglerSearchButton">Search Filters<span class="button"><b></b></span></a>
              <div id="aside-holder">
                <aside id="aside">
                    <div class="top-head">
                        <p>Search Filters</p>
                        <a class="close togglerSearchButton"><span class="icon-cross"></span></a>
                    </div>
                    {{ Form::open(array('url' => 'agents','method' => 'GET','class'=>'filter-form')) }}
                    <ul class="filters-links text-upparcase">
                        <li class="active">
                            <a class="filters-links-opener">Search Agent</a>
                            <div class="slide">
                                <ul class="filterChecks">
                                    <li>
                                        <select  name="location" class="js-example-basic-single">
                                            <option selected disabled>Search by society</option>
                                            <option value="" @if($response['data']['params']['location'] == "") selected @endif>Select Location</option>
                                            @foreach($response['data']['locations'] as $location)
                                                <option value="{{$location->id}}" @if($response['data']['params']['location'] == $location->id) selected @endif>{{$location->location}}</option>
                                            @endforeach
                                        </select>

                                    </li>
                                    <li>
                                        <select  name="agency_name" class="js-example-basic-single">
                                            <option selected disabled>Search by Agents</option>
                                            <option value="" @if($response['data']['params']['agencyName'] == "") selected @endif>All Agent</option>
                                            @foreach($response['data']['allAgents'] as $agent)
                                                <option value="{{$agent->agencies[0]->name}}" @if($response['data']['params']['agencyName'] == $agent->agencies[0]->name) selected @endif>{{$agent->agencies[0]->name}}</option>
                                            @endforeach
                                        </select>

                                    </li>

                                </ul>
                                <input class="btn-default full-width" type="submit" value="Search Agent">
                            </div>
                        </li>
                    </ul>

                    {{Form::close()}}
                </aside>
              </div>
                @foreach($response['data']['banners']['topBanners'] as $banner)
                    <a><img src="{{url('/').'/'.$banner->image}}" width="100px" height="100px"></a>
                @endforeach
                <section id="content">
                    <div class="propertyNotFound hidden">
                        <strong class="no-heading">sorry, no record found</strong>
                        <p>Maybe your search was to specific, please try searching with another term.</p>
                    </div>

                        @foreach($response['data']['agents'] as $agent)
                            <?php
                            $image = url('/')."/assets/imgs/no.png";
                            foreach($agent->agencies as $agency)
                            {
                                if($agency->logo !="")
                                {
                                    $image = url('/').'/temp/'.$agency->logo;
                                }
                            }
                            ?>
                            <article class="publicAgent-post">
                                <div class="post-holder">
                                    <div class="image-holder">
                                        <a href="{{ URL::to('agent').'/'.$agent->agencies[0]->slug }}">
                                            <img src="{{$image}}" alt="image description">
                                        </a>
                                    </div>
                                    <div class="caption text-left">
                                        <div class="layout">
                                            <h1><a href="{{ URL::to('agent').'/'.$agent->agencies[0]->slug }}">{{$agent->agencies[0]->name}}</a></h1>
                                            <p>{{str_limit($agent->agencies[0]->description,67)}}</p>
                                        </div>
                                        <div class="layout">
                                            @if($agent->trustedAgent ==1)
                                                <span class="trusted-agent"><span class="icon-premium-badge"></span>Trusted</span>
                                            @endif
                                            {{--<ul class="star-rating">--}}
                                                {{--<li><a href="#" class="one-star"></a></li>--}}
                                                {{--<li><a href="#" class="two-stars"></a></li>--}}
                                                {{--<li><a href="#" class="three-stars"></a></li>--}}
                                                {{--<li><a href="#" class="four-stars"></a></li>--}}
                                                {{--<li><a href="#" class="five-stars"></a></li>--}}
                                            {{--</ul>--}}
                                        </div>
                                        <div class="layout links-holder">
                                            <div class="links-left">
                                                <a href="{{ URL::to('agent').'/'.$agent->agencies[0]->slug }}" class="btn-default text-upparcase">VIEW DETAILS <span class="icon-search"></span></a>
                                            </div>
                                            <div class="links-right">
                                                <ul class="quick-links">
                                                    <li><a href="#callPopup" class="lightbox call-agent-btn" data-tel="{{$agent->mobile}}" data-name="faizan"><span class="icon-phone"></span></a></li>
                                                    <li><a href="#sendEmail-popup" class="lightbox"><span class="icon-empty-envelop"></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    <ul class="pager">
                        <?php
                        $urlParams = $_GET;
                        $agentLimits = 0;
                        $actualPage = (isset($urlParams['page']))?$urlParams['page']:1;
                        (isset($urlParams['limit'])?$agentLimits = $urlParams['limit']:$agentLimits = config('constants.Pagination'));
                        $totalPages = intval(ceil($response['data']['totalAgentsFound'] / $agentLimits));
                        $pageValue = (isset($urlParams['page']))?$urlParams['page']:1;
                        ?>
                        <?php
                        $for_previous_link = $_GET;
                        $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
                        ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
                        $convertPreviousToQueryString  = http_build_query($for_previous_link);
                        $previousResult = URL('/agents').'?'.$convertPreviousToQueryString;
                        ?>
                        <?php
                        //This section manage the > button in pagination

                        ($pageValue == $totalPages)?$urlParams['page'] = $pageValue:$urlParams['page'] = $pageValue+1;
                        $convertToQueryString  = http_build_query($urlParams);
                        $nextResult = URL('/agents').'?'.$convertToQueryString;
                        ?>
                    </ul>
                    <ul class="pager">
                        <?php
                        $urlParams['page']=1;
                        $convertFirstRecordToQueryString  = http_build_query($urlParams);
                        $firstResult = URL('/agents').'?'.$convertFirstRecordToQueryString;
                        ?>
                        @if($actualPage >=5)
                            <li><a href="{{$firstResult}}" class="first"><span class="icon-arrow1-left"></span></a></li>
                        @endif

                        <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
                        <?php
                        //This is section of code print the pagination
                        $query_str_to_array = $_GET;
                        $agentLimits =0;
                        (isset($query_str_to_array['limit'])?$agentLimits = $query_str_to_array['limit']:$agentLimits = config('constants.Pagination'));
                        $paginationValue = intval(ceil($response['data']['totalAgentsFound'] / $agentLimits));
                        $current_page = (isset($query_str_to_array['page'])) ? $query_str_to_array['page'] : 1;
                        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
                        $query_str_to_array['page'] = $i;
                        $queryString = http_build_query($query_str_to_array);
                        $result = URL('/agents') . '?' . $queryString;
                        ?>
                        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
                        <?php }?>
                        @if($actualPage != $totalPages)
                            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
                        @endif
                        <?php

                        $for_last_link = $_GET;
                        $agentLimits =0;
                        (isset($query_str_to_array['limit'])?$agentLimits = $for_last_link['limit']:$agentLimits = config('constants.Pagination'));
                        $totalPaginationValue = intval(ceil($response['data']['totalAgentsFound'] / $agentLimits));
                        $current_page2 = (isset($for_last_link['page']))? $for_last_link['page']: $totalPaginationValue;
                        $for_last_link['page']=$totalPaginationValue;
                        $convertLastRecordToQueryString  = http_build_query($for_last_link);
                        $lastResult = URL('/agents').'?'.$convertLastRecordToQueryString;
                        ?>
                        @if($current_page2 <=$paginationValue-4)
                            <li><a href="{{$lastResult}}" class="last"><span class="icon-arrow1-right"></span></a></li>
                        @endif
                    </ul>
                </section>
                <div class="popup-holder">
                    <div id="callPopup" class="lightbox call-agent generic-lightbox">
                        <span class="lighbox-heading">Phone Number</span>
                        <p></p>
                        <span class="information"><span class="icon-info"></span>When you call, don't forget to mention that you found this ad on nugree.com</span>
                    </div>
                    <div id="sendEmail-popup" class="lightbox generic-lightbox">
                        <span class="lighbox-heading">Send Email</span>
                        {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'inquiry-email-form'))}}
                        <div class="field-holder">
                            <label for="name">Name</label>

                            <div class="input-holder"><input type="text" id="name" name="name"></div>
                        </div>
                        <div class="field-holder">
                            <label for="email">Email</label>

                            <div class="input-holder"><input type="email" id="email" name="email"
                                                             required></div>
                        </div>
                        <div class="field-holder">
                            <label for="phone">phone</label>

                            <div class="input-holder"><input type="tel" id="phone" name="phone"
                                                             required></div>
                        </div>
                        <div class="field-holder">
                            <label for="subject">subject</label>

                            <div class="input-holder"><input type="text" id="subject" name="subject">
                            </div>
                        </div>
                        <div class="field-holder">
                            <label for="message">message</label>

                            <div class="input-holder"><textarea id="message" name="message"
                                                                required></textarea>
                                <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms of Use</a></p>
                            </div>
                        </div>
                        <button type="submit">SEND</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>

@endsection