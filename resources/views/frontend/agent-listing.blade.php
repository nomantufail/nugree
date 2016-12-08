@extends('frontend.frontend_old')
@section('content')
    <div id="content">
       <div class="container">
            <div class="page-holder">
                <div class="agentListing-page">
                    <div class="holder">
                        {{ Form::open(array('url' => 'agents','method' => 'GET','class'=>'search-agent')) }}
                            <div class="input-holder">
                                <select  name="society" class="js-example-basic-single">
                                    <option selected disabled>Search by society</option>
                                    <option value="" @if($response['data']['params']['society'] == "") selected @endif>All Societies</option>
                                    @foreach($response['data']['societies'] as $society)
                                    <option value="{{$society->id}}" @if($response['data']['params']['society'] == $society->id) selected @endif>{{$society->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-holder">
                                <select  name="agency_name" class="js-example-basic-single">
                                    <option selected disabled>Search by Agents</option>
                                    <option value="" @if($response['data']['params']['agencyName'] == "") selected @endif>All Agent</option>
                                    @foreach($response['data']['allAgents'] as $agent)
                                        <option value="{{$agent->agencies[0]->name}}" @if($response['data']['params']['agencyName'] == $agent->agencies[0]->name) selected @endif>{{$agent->agencies[0]->name}}</option>
                                    @endforeach
                                </select>
                                    <input type="submit" value="Search Agent">
                            {{Form::close()}}
                    </div>
                </div>


                    <section class="property-posts">
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
                            <article class="post">
                                <div class="post-holder">
                                    <div class="img-holder">
                                        <a href="{{ URL::to('agent?agent_id='.$agent->id) }}">
                                            <img src="{{$image}}" width="300" height="300" alt="image description">
                                        </a>
                                    </div>
                                    <div class="caption">
                                        <strong class="post-heading"><a href="{{ URL::to('agent?agent_id='.$agent->id) }}">{{$agent->agencies[0]->name}}</a></strong>
                                        <p>{{str_limit($agent->agencies[0]->description,150)}}</p>
                                        <div class="holder">
                                            <ul class="quick-links">
                                                <li><a href="tel:{{$agent->agencies[0]->phone}}"><span class="icon-phone_iphone"></span><span class="hidden-xs">{{$agent->agencies[0]->phone}}</span><span class="show-xs">Call Now</span></a></li>
                                                <li><a href="{{ URL::to('agent?agent_id='.$agent->id) }}"><span class="icon-pencil"></span>View Details</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </section>
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
                    <ul class="pager">
                        <?php
                        $urlParams['page']=1;
                        $convertFirstRecordToQueryString  = http_build_query($urlParams);
                        $firstResult = URL('/agents').'?'.$convertFirstRecordToQueryString;
                        ?>
                        @if($actualPage >=5)
                            <a href="{{$firstResult}}">First</a>
                         @endif
                        <li><a href="{{$previousResult}}" class="previous"><span class="icon-chevron-thin-left"></span></a></li>
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
                        <li><a href="{{$nextResult}}" class="next"><span class="icon-chevron-thin-right"></span></a></li>
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
                        <a href="{{$lastResult}}">Last</a>
                        @endif
                    </ul>
            </div>

    </div>

</div>
@endsection