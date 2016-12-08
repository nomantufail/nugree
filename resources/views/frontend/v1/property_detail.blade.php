@extends('frontend.v1.frontend')
@section('content')
    <?php \App\Libs\Helpers\DaysHelper::convert($response['data']['property']->createdAt)?>
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/property-agent-detail.css">
    @foreach($response['data']['banners']['topBanners'] as $banner)
        <a href=""><img src="{{url('/').'/'.$banner->image}}" width="100px" height="100px"> </a>
    @endforeach
    <div class="propertyDetail-page">
        <div class="container">
            <ul class="breadcrumbs container">
                @foreach($response['data']['breadcrumb'] as $bread)
                    <li><a href="{{$bread['destination']}}">{{$bread['title']}}</a></li>
                @endforeach
            </ul>
            <div class="detail-holder">
                <div class="frame">
                    <div class="property-picture-holder">
                        <h1><a href="{{URL::to('property?propertyId=').$response['data']['property']->id}}"> {{ ''.$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name .' '}}
                                {{$response['data']['property']->type->subType->name.'
                                 '.$response['data']['property']->purpose->name.' in '.$response['data']['property']->location->location->location .'('.$response['data']['property']->location->city->name.')'/*.' in '.$response['data']['property']->location->block->name.' Block'.
                                ' '.$response['data']['property']->location->society->name*/}}</a></h1>
                        <?php
                        $user = (new \App\Libs\Helpers\AuthHelper())->user();
                        ?>
                        <div class="propertyImage-slider">
                            <a @if($user ==null)href="#login-to-continue" @endif property_id="{{$response['data']['property']->id}}" user_id="{{($user !=null)?$user->id:""}}"
                               key="{{($user !=null)?$user->access_token:""}}" class="add-to-favorite {{($user == null)?'lightbox':''}}  @if($response['data']['isFavourite'] != 0)
                               added @endif" id="add-to-favorite{{$response['data']['property']->id}}"><i class="fa fa-heart-o" aria-hidden="true"></i><i class="fa fa-heart" aria-hidden="true"></i></a>
                            {{--<span class="premiumProperty text-upparcase">Premium</span>--}}
                             <div class="popup-holder">
                                <div class="lightbox generic-lightbox" id="login-to-continue">
                                    <p>Dear user ! You are not logged in Please <a href="{{url('/login')}}">Login</a></p>
                                </div>
                            </div>
                            <div class="mask">
                                <?php
                                $images = [];
                                foreach ($response['data']['property']->documents as $document) {
                                    if($document->type == 'image') {
                                        $images[] = url('/') . '/temp/' . $document->path;
                                    }
                                }
                                if (sizeof($images) == 0) {
                                    $images[] = url('/') . "/assets/imgs/no.png";
                                }
                                ?>
                                <div class="slideset">
                                    @foreach($images as $image)
                                        <div class="slide">
                                            <a href="{{$image}}" rel="lighbox" class="lightbox"><img src="{{$image}}" alt="image description"></a>
                                        </div>
                                    @endforeach
                                </div>
                                <span id="propertyImageCurrentSlide" class="current-num"></span>
                            </div>
                            <a href="#" class="propertyImage-slider-btn-prev"><span
                                        class="icon-left-arrow"></span></a>
                            <a href="#" class="propertyImage-slider-btn-next"><span
                                        class="icon-right-arrow"></span></a>

                            <div class="propertyImage-pagination">
                                <div class="propertyImage-mask">
                                    <div class="propertyImage-slideset">
                                        @foreach($images as $image)
                                            <div class="propertyImage-slide ">
                                                <a href="#"><img src="{{$image}}" alt="image description"></a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <span class="paginationCurrent-num-1"></span>
                                </div>
                                <a href="#" class="propertyImage-pagination-btn-prev-1"><span
                                            class="icon-left-arrow"></span></a>
                                <a href="#" class="propertyImage-pagination-btn-next-1"><span
                                            class="icon-right-arrow"></span></a>
                            </div>
                        </div>
                        <span class="views">Views <span
                                    class="number">{{$response['data']['property']->totalViews}}</span></span>
                        <ul class="star-rating">
                            <li><a href="#" class="one-star">star</a></li>
                            <li><a href="#" class="two-stars">star</a></li>
                            <li><a href="#" class="three-stars">star</a></li>
                            <li><a href="#" class="four-stars">star</a></li>
                            <li><a href="#" class="five-stars">star</a></li>
                        </ul>
                    </div>
                    <?php
                    $images = url('/') . "/assets/imgs/no.png";
                    if ($response['data']['property']->owner->agency != null) {
                        if ($response['data']['property']->owner->agency->logo != null) {
                            $images = url('/') . '/temp/' . $response['data']['property']->owner->agency->logo;
                        }
                    }
                    ?>
                    <div class="info-blockProperty" id="fixed-block">
                        <strong class="price"><span>Rs</span>{{App\Libs\Helpers\PriceHelper::numberToRupees($response['data']['property']->price)}}
                        </strong>
                        @if ($response['data']['property']->owner->agency != null)
                            <div class="pictureHolder">
                                @if($response['data']['user']->roles[0]->id ==3 && $response['data']['user']->trustedAgent ==1)
                                    <a href="{{ URL::to('agent?agent_id='.$response['data']['property']->owner->id) }}">
                                        @endif
                                        <img src="{{$images}}" alt="image description"> </a></div>
                        @endif
                        @if($response['data']['property']->owner->agency !=null)

                            <span class="heading">@if($response['data']['user']->roles[0]->id ==3 && $response['data']['user']->trustedAgent ==1)
                                    <a href="{{ URL::to('agent?agent_id='.$response['data']['property']->owner->id) }}">
                                        @endif
                                        {{$response['data']['property']->owner->agency->name}}</a>
                                </span>

                        @endif
                        <div class="layout">
                            <div class="pull-left">
                                @if(isset($response['data']['propertyOwner']->trustedAgent) && $response['data']['propertyOwner']->trustedAgent == 1)
                                    <span class="trusted-agent"><span class="icon-premium-badge"></span>Trusted</span>
                                    <ul class="star-rating">
                                        <li><a href="#" class="one-star">star</a></li>
                                        <li><a href="#" class="two-stars">star</a></li>
                                        <li><a href="#" class="three-stars">star</a></li>
                                        <li><a href="#" class="four-stars">star</a></li>
                                        <li><a href="#" class="five-stars">star</a></li>
                                    </ul>
                                @endif
                            </div>

                            <div class="pull-right">
                                <ul class="quick-links">
                                    <li><a href="#callPopup" class="lightbox call-agent-btn"
                                           data-tel="{{$response['data']['property']->mobile}}"><span class="icon-phone"></span></a></li>
                                    <li><a href="#sendEmail-popup" class="lightbox"><span
                                                    class="icon-empty-envelop"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="popup-holder">
                            <div id="callPopup" class="lightbox call-agent generic-lightbox">
                                <span class="lighbox-heading">Phone Number</span>

                                <p></p>
                                <span class="information"><span class="icon-info"></span>When you call, don't forget to mention that you found this ad on nugree.com</span>
                            </div>
                            <div id="sendEmail-popup" class="lightbox generic-lightbox">
                                <span class="lighbox-heading">Send Email</span>
                                {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'inquiry-email-form'))}}
                                <input type="hidden" name="userId" value="{{$response['data']['property']->owner->id}}">
                                <input type="hidden" name="type" value="property_detail">
                                <input type="hidden" name="propertyId" value="{{$response['data']['property']->id}}">
                                <div class="field-holder">
                                    <label for="name">Name</label>

                                    <div class="input-holder"><input type="text" id="name" name="name" required></div>
                                </div>
                                <div class="field-holder">
                                    <label for="email">Email</label>

                                    <div class="input-holder"><input type="email" id="email" name="email" required></div>
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
                            </div>
                        </div>
                        <span class="small-heading">Summary</span>
                        <ul class="sumery-list">
                            <li>
                                <span class="tag">Property ID</span>
                                <span class="quantity">{{$response['data']['property']->id}}</span>
                            </li>

                            <li>
                                <span class="tag">Location</span>
                                <span class="quantity">{{$response['data']['property']->location->location->location}}</span>
                            </li>
                            {{--@if($response['data']['property']->location->block != null && $response['data']['property']->location->block->name != 'other')--}}
                                {{--<li>--}}
                                    {{--<span class="tag">Block</span>--}}
                                    {{--<span class="quantity">{{$response['data']['property']->location->block->name}}</span>--}}
                                {{--</li>--}}
                            {{--@endif--}}

                            <li>
                                <span class="tag">Type</span>
                                <span class="quantity">{{$response['data']['property']->type->parentType->name}}</span>
                            </li>
                            <li>
                                <span class="tag blue">Area</span>
                                <span class="quantity blue">{{$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name}}</span>
                            </li>
                            <li>
                                <span class="tag blue">Price</span>
                                <span class="quantity blue">{{App\Libs\Helpers\PriceHelper::numberToRupees($response['data']['property']->price)}}</span>
                            </li>
                        </ul>
                        <div class="layout">
                            <div class="pull-left">
                                <span class="timeOfAddedProperty">Property Added
                                    <b>{{\App\Libs\Helpers\DaysHelper::convert($response['data']['property']->createdAt)}}</b></span>

                            </div>
                            <div class="pull-right">
                                <?php
                                $heightPriorityFeatures = [];
                                foreach ($response['data']['property']->features as $section => $features) {
                                    foreach ($features as $feature) {
                                        if ($feature->priority > 0) {
                                            $heightPriorityFeatures[] = $feature;
                                        }
                                    }
                                }
                                ?>
                                <ul class="public-ui-features text-capital">
                                    @foreach($heightPriorityFeatures as $heightPriorityFeature)
                                        <li>
                                            <span><b>{{$heightPriorityFeature->name}}</b></span>
                                            <strong>{{$heightPriorityFeature->value}}</strong>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overview-section">
                    <div class="layout">
                        <span class="small-heading">Property Overview</span>
                        <a href="#" onclick="window.print()" class="btn-hollow"><span class="icon-printer"></span>PRINT DETAILS</a>
                    </div>
                    <p>{{$response['data']['property']->description}}</p>
                </div>
                @if($response['data']['property']->features !=null)
                    <div class="extra-feature-section">
                        <div class="extra-feature-holder">

                            <span class="small-heading">Property Features</span>

                            <div class="feature">
                                @foreach($response['data']['property']->features as $sectionName=>$features)
                                    <span class="small-heading">{{$sectionName}}</span>
                                    <ul class="feature-list">
                                        @foreach($features as $feature)
                                            <li>
                                                <span class="text-feature">{{$feature->name}}</span>
                                                @if($feature->htmlStructure->name =='checkbox')
                                                    <span class="stataus">yes</span>
                                                @else
                                                    <span class="stataus">{{$feature->value}}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection