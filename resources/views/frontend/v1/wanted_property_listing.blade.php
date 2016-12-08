@extends('frontend.v1.frontend')
@section('content')
    <script>
        $(document).ready(function(){
            $('.property_type').trigger('change');
        });
        var propertySubtypes = '<?php  echo $response['data']['propertySubtypes']; ?>';
        propertySubtypes = JSON.parse(propertySubtypes);
        var old_subtype = parseInt('<?php echo $response['data']['oldValues']['subTypeId']; ?>');

        $(document).on('change','.property_type',function(){

            var list = [];
            $('li.type').find("input:radio:checked").each(function () {
                list.push($(this).val());
            });
            var propertyTypeId = ($(this).attr('propertyType'))? list: $(this).attr('propertyType');
            $('#propertySubtype').empty();
            if(propertyTypeId.length > 0){
                $.each(propertySubtypes[propertyTypeId], function (i, subtype)
                {
                    $('#propertySubtype').append(
                            '<li>'+
                            '<label for="propertySubtype_'+subtype.id+'" class="customRadio">'+
                            '<input type="radio" id="propertySubtype_'+subtype.id+'" '+ ((old_subtype == subtype.id)?'checked':'') +'  name="sub_type_id" class="property_sub_type filter-form-input" value="'+subtype.id+'">'+
                            '<span class="fake-checkbox"></span>'+
                            '<span class="fake-label">'+subtype.name+'</span>'+
                            '</label>'+
                            '</li>'
                    );
                });
            }

        });


    </script>
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/property-agent-listing.css">
    <div class="listing-page">
        @if(isset($response['data']['banners']['topBanners']) && (sizeof($response['data']['banners']['topBanners'])) > 0)
            <div class="ads-slideshow">
                <div class="mask">
                    <div class="slideset">
                        <div class="slide">
                            @if(isset($response['data']['banners']['topBanners'][0]))
                                <a @if($response['data']['banners']['topBanners'][0]->banner_link !=="")href="{{$response['data']['banners']['topBanners'][0]->banner_link}}"@endif><img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'. $response['data']['banners']['topBanners'][0]->image}}" alt="image description"></a>
                            @endif
                            @if(isset($response['data']['banners']['topBanners'][1]))
                                <a @if($response['data']['banners']['topBanners'][1]->banner_link !=="")href="{{$response['data']['banners']['topBanners'][1]->banner_link}}"@endif><img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$response['data']['banners']['topBanners'][1]->image}}" alt="image description"></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <a class="aside-opener-filters togglerSearchButton">More Filters <b>(Land Area / Price...)</b><span class="button"><b></b></span></a>
            <div id="aside-holder">
                <aside id="aside">
                    <div class="top-head">
                        <p>Wanted Search Filters</p>
                        <a class="close togglerSearchButton"><span class="icon-cross"></span></a>
                    </div>
                    <form cla ss="filter-form" id="properties-filter-form" method="get" action="<?= url('wanted-properties') ?>">
                        <ul class="filters-links text-upparcase">
                            <li class="active">
                                <a class="filters-links-opener">Wanted property</a>
                                <div class="slide">
                                    <ul class="filterChecks">
                                        <li>
                                            <label for="wanted-pro" class="customRadio">
                                                <input type="radio" name="wanted" id="wanted-pro" value="1" checked>
                                                <span class="fake-checkbox"></span>
                                                <span class="fake-label">Wanted</span>
                                            </label>
                                            <img src="{{url('/') . "/assets/imgs/z.png" }}">
                                        </li>
                                      </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">PROPERTY FOR</a>
                                <div class="slide">
                                    <ul class="filterChecks">
                                        <li>
                                            <label for="buy-filter" class="customRadio">
                                                <input type="radio" name="purpose_id" id="buy-filter" value="1" @if($response['data']['oldValues']['purposeId'] == 1) checked @endif>
                                                <span class="fake-checkbox"></span>
                                                <span class="fake-label">BUY</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label for="rent-filter" class="customRadio">
                                                <input type="radio" name="purpose_id" id="rent-filter" value="2" @if($response['data']['oldValues']['purposeId'] == 2) checked @endif>
                                                <span class="fake-checkbox"></span>
                                                <span class="fake-label">Rent</span>
                                            </label>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">Property Type</a>
                                <div class="slide">
                                    <ul class="filterChecks">
                                        @foreach($response['data']['propertyTypes'] as $propertyType)
                                            <li class="type">
                                                <label for="{{$propertyType->name."_".$propertyType->id}}" class="customRadio">
                                                    <input type="radio" id="{{$propertyType->name."_".$propertyType->id}}"
                                                           @if($response['data']['oldValues']['propertyTypeId'] == $propertyType->id)checked @endif
                                                           name="property_type_id" class="property_type filter-form-input" value="{{$propertyType->id}}" propertyType="{{$propertyType->id}}">
                                                    <span class="fake-checkbox"></span>
                                                    <span class="fake-label">{{$propertyType->name}}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">Property SUB-Type</a>
                                <div class="slide">
                                    <ul class="filterChecks" id="propertySubtype">
                                    </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">LOCATION / SOCIETY</a>
                                <div class="slide">
                                    <ul class="filterChecks">
                                        <li>
                                            <select class="js-example-basic-single" name="city_id" id="cities-select">
                                                <option value="">Select City</option>
                                                @foreach($response['data']['cities'] as $city)
                                                    <option value="{{$city->id}}" @if($response['data']['oldValues']['cityId'] == $city->id) selected @endif>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                        <li>
                                            <input id="selectbox" class="ajax-locations-select" name="location_id">
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">LAND AREA</a>
                                <div class="slide">
                            <span class="fake-select">
                                <select name="land_unit_id">
                                    @foreach($response['data']['landUnits'] as $landUnit)
                                        <option value="{{$landUnit->id}}" @if($landUnit->id == $response['data']['oldValues']['landUnitId'] || $landUnit->id == 3) selected @endif>{{$landUnit->name}}</option>
                                    @endforeach
                                </select>
                            </span>
                                    <div class="fromTo">
                                        <div class="field-holder">
                                            <input type="number" placeholder="From" name="land_area_from" value="{{$response['data']['oldValues']['landAreaFrom']}}" >
                                        </div>
                                        <div class="field-holder">
                                            <input type="number" placeholder="To" name="land_area_to" value="{{$response['data']['oldValues']['landAreaTo']}}">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="active">
                                <a class="filters-links-opener">PRICE RANGE</a>
                                <div class="slide">
                                    <div class="fromTo full-width">
                                        <div class="field-holder">
                                            <input type="number" placeholder="From"  name="price_from" id="convertFrom" value="{{$response['data']['oldValues']['priceFrom']}}" class="priceInputFrom PriceField">
                                        </div>
                                        <div class="field-holder">
                                            <input type="number" placeholder="To"   name="price_to" id="convertTo" value="{{$response['data']['oldValues']['priceTo']}}" class="priceInputTo PriceField">
                                        </div>
                                    </div>
                                    <span class="calculatedPrice">Please enter the price</span>
                                </div>
                            </li>

                        </ul>
                        <ul class="filter-btn">
                            <li><button type="submit" class="btn-search">Search</button></li>
                            <li><button type="reset" class="btn-reset">Reset</button></li>
                        </ul>
                    </form>
                </aside>
                <ul class="banners">
                    @if(isset($response['data']['banners']['leftBanners']))
                        @foreach($response['data']['banners']['leftBanners'] as $leftBanner )
                            <li><a @if($leftBanner->banner_link !="") href="{{$leftBanner->banner_link}}" @endif><img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$leftBanner->image}}" alt="image desktop"></a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <section id="content">
                <div class="propertyNotFound hidden">
                    <strong class="no-heading">sorry, no property found</strong>
                    <p>Maybe your search was to specific, please try searching with another term.</p>
                </div>
                <?php
                $favourites =0;
                ?>
                <div class="sort-by">
                    <span class="label">Sort by:</span>
                <span class="fake-select">
                                    <select name="sort_by" id="sort">
                                        <option value='' selected >Default Order</option>
                                        <option value='price_asc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'price_asc') selected @endif>Price Low to High</option>
                                        <option value='price_desc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'price_desc') selected @endif>Price High to Low</option>
                                        <option value='land_asc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'land_asc') selected @endif>Area Low to High</option>
                                        <option value='land_desc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'land_desc') selected @endif>Area High to Low</option>
                                    </select>
                                </span>
                </div>
                <?php
                $countForBanner =0;
                $betweenCountIndex=0;
                ?>
                @foreach($response['data']['properties'] as $property)

                    <article class="publicProperty-post">
                        <div class="image-holder">
                            <div class="listing-image-slider">
                                <div class="mask">
                                    <div class="slideset">

                                        <?php
                                        $image = url('/')."/assets/imgs/no.jpg";
                                        foreach($property->documents as $document)
                                        {
                                            if($document->type == 'image' && $document->main == true && $document->path != "")
                                            {
                                                $image = url('/').'/temp/'.$document->path;
                                            }
                                        }
                                        $countForBanner++;
                                        ?>
                                        {{--@if(sizeof($property->documents) > 0)--}}
                                        {{--@foreach($property->documents as $document)--}}
                                        {{--<div class="slide">--}}
                                        {{--<a href="property?propertyId={{$property->id}}">--}}
                                        {{--@if($document->type == 'image'  && $document->path != "")--}}
                                        {{--<img src="{{ url('/').'/temp/'.$document->path}}" alt="image description">--}}
                                        {{--@endif--}}
                                        {{--</a>--}}
                                        {{--</div>--}}
                                        {{--@endforeach--}}
                                        {{--@else--}}
                                        <div class="slide">
                                            <a href="property?propertyId={{$property->id}}">
                                                <img src="{{$image}}" alt="image description">
                                            </a>
                                        </div>
                                        {{-- @endif--}}
                                    </div>
                                </div>
                                <a href="#" class="btn-prev"><span class="icon-keyboard_arrow_left"></span></a>
                                <a href="#" class="btn-next"><span class="icon-keyboard_arrow_right"></span></a>
                            </div>
                        </div>

                        <div class="caption text-left">
                            <div class="layout">
                                <h1><a href="property?propertyId={{$property->id}}">{{ ''.$property->land->area.' '.$property->land->unit->name .' '}}{{$property->type->subType->name.' '.(($property->wanted)?'required ':'').'in '.$property->location->location->location." ".'('.$property->location->city->name.')'}}</a></h1>
                                <p>{{str_limit($property->description,148) }}</p>
                                <span class="price">Rs <b>{{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</b></span>
                                <span class="premiumProperty text-upparcase">@if($property->isFeatured !=null){{'Featured'}}@endif</span>
                                <div class="holder-ui">
                                    <ul class="public-ui-features text-capital">
                                        @foreach($property->features as $feature)
                                            @foreach($feature as $featureSection)
                                                @if($featureSection->priority ==1)
                                                    <li>{{$featureSection->name}}:<span>{{$featureSection->value}}</span></li>
                                                @endif
                                            @endforeach

                                        @endforeach
                                    </ul>


                                    <?php
                                    $image = url('/') . "/assets/imgs/no.png";
                                    if ($property->owner->agency != null) {
                                        if ($property->owner->agency->logo != null) {
                                            $image = url('/') . '/temp/' . $property->owner->agency->logo;
                                        }
                                    }
                                    ?>
                                    <a @if(isset($property->owner->isTrusted) && $property->owner->isTrusted == 1 && isset($property->owner->isAgent) && $property->owner->isAgent==1 ) href="{{ URL::to('agent?agent_id='.$property->owner->id) }}" @endif>
                                        <img src="{{$image}}" alt="image description" class="company-logo"></a>
                                </div>
                            </div>
                            <div class="layout links-holder">
                                 <span class="added-time">Property Added
                                     <?php
                                     $startTimeStamp = strtotime(date("Y/m/d"));
                                     $myDate = substr(substr($property->createdAt, 0, 10), 0, 10);
                                     $endTimeStamp = strtotime($myDate);
                                     $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                     $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
                                     // and you might want to convert to integer
                                     $numberDays = intval($numberDays);
                                     $days = "";
                                     if ($numberDays == 0) {
                                         $myTime = substr($property->createdAt, 10, 10);
                                         $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $myTime);

                                         sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);

                                         $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;
                                         $myTime = intval($time_seconds/3600);
                                         $days = 'Hours Ago';
                                     } elseif ($numberDays == 1) {
                                         $days = 'day ago';
                                     } else {
                                         $days = 'days ago';
                                     };
                                     ?>
                                     <b>@if($numberDays !=0){{$numberDays}}  {{$days}} @else {{$myTime .' '.$days}} @endif</b></span>
                                <a href="property?propertyId={{$property->id}}" class="btn-default text-upparcase">VIEW DETAILS <span class="icon-search"></span></a>
                                <ul class="quick-links">
                                    <li><a href="#callPopup" class="lightbox call-agent-btn" data-tel="{{$property->mobile}}"><span class="icon-phone"></span></a></li>
                                    <li><a href="#sendEmail-popup{{$property->id}}" class="lightbox"><span class="icon-empty-envelop"></span></a></li>
                                </ul>
                                <?php
                                $user = (new \App\Libs\Helpers\AuthHelper())->user();
                                ?>
                                <a @if($user ==null)href="#login-to-continue" @endif property_id="{{$property->id}}" user_id="{{($user !=null)?$user->id:""}}"
                                   key="{{($user !=null)?$user->access_token:""}}"   class="add-to-favorite  {{($user == null)?'lightbox':''}}  @if(($response['data']['isFavourite'][$favourites]) != 0)added @endif" id="add-to-favorite{{$property->id}}">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i><i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="popup-holder"><div id="sendEmail-popup{{$property->id}}" class="lightbox generic-lightbox">
                                <span class="lighbox-heading">Send Email</span>
                                {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'inquiry-email-form'))}}
                                <input type="hidden" name="userId" value="{{$property->owner->id}}">
                                <input type="hidden" name="type" value="propertyListing">
                                <input type="hidden" name="propertyId" value="{{$property->id}}">
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

                                    <div class="input-holder"><textarea id="message" name="message" required></textarea>
                                        <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms of Use</a></p>
                                    </div>
                                </div>
                                <button type="submit">SEND</button>
                                {{Form::close()}}
                            </div></div>
                        <?php $favourites++; ?>
                    </article>
                    <?php
                    if(($countForBanner %3) == 0)
                    if(isset($response['data']['banners']['between']) && isset($response['data']['banners']['between'][$betweenCountIndex]))

                    { ?>
                    <a @if($response['data']['banners']['between'][$betweenCountIndex]->banner_link !=="") href="{{$response['data']['banners']['between'][$betweenCountIndex]->banner_link}}" @endif class="between-banner"><img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$response['data']['banners']['between'][$betweenCountIndex]->image}}" ></a>
                    <?php
                    $betweenCountIndex++;

                    }
                    ?>


                @endforeach
                <?php

                $for_previous_link = $_GET;
                $first_page = URL('wanted-properties').'?'.'page=1';
                $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
                ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
                $convertPreviousToQueryString  = http_build_query($for_previous_link);
                $previousResult = URL('/search').'?'.$convertPreviousToQueryString;
                ?>
                <?php
                $totalPaginationValue = intval(ceil($response['data']['totalProperties'] / config('constants.Pagination')));
                $last_page = URL('wanted-properties').'?'.'page='.$totalPaginationValue;
                $for_next_link = $_GET;
                $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
                ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
                $convertToQueryString  = http_build_query($for_next_link);
                $nextResult = URL('/search').'?'.$convertToQueryString;
                ?>
                <ul class="pager">

                    <li><a href="{{$first_page}}" class="first"><span class="icon-arrow1-left"></span></a></li>
                    @if($totalPaginationValue !=0)
                        <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
                    @endif
                    <?php
                    $paginationValue = intval(ceil($response['data']['totalProperties'] / config('constants.Pagination')));
                    $query_str_to_array = $_GET;
                    $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
                    for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
                    $query_str_to_array['page'] = $i;
                    $queryString  = http_build_query($query_str_to_array);
                    $result = URL('/search').'?'.$queryString;
                    ?>
                    <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
                    <?php }?>
                    @if($totalPaginationValue !=0)
                        <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
                    @endif
                    <li><a href="{{$last_page}}" class="last"><span class="icon-arrow1-right"></span></a></li>
                </ul>
            </section>
            <ul class="banners right-banners">
                @if(isset($response['data']['banners']['rightBanners']))
                    @foreach($response['data']['banners']['rightBanners'] as $rightBanner )
                        <li><a @if($rightBanner->banner_link !="") href="{{$rightBanner->banner_link}}" @endif><img src="{{\App\Libs\Helpers\PathHelper::nugreeAdminPublicPath().'/'.$rightBanner->image}}" alt="image desktop"></a></li>
                    @endforeach
                @endif
            </ul>
            <div class="popup-holder">
                <div id="callPopup" class="lightbox call-agent generic-lightbox">
                    <span class="lighbox-heading">Phone Number</span>
                    <p></p>
                    <span class="information"><span class="icon-info"></span>When you call, don't forget to mention that you found this ad on nugree.com</span>
                </div>
                <div id="login-to-continue" class="lightbox generic-lightbox">
                    <p>Dear user, you are not logged in, please <a href="{{ URL::to('/login') }}">Login to continue.</a></p>
                </div>

            </div>
        </div>
    </div>
    <script>
        $("#selectbox").select2('data', {id: 100, location: 'Lorem Ipsum'});
        $(document).ready(function(){
            $( "#cityId" ).trigger( "change" );
        });

    </script>
@endsection