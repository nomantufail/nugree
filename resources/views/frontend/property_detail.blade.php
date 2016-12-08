@extends('frontend.frontend_old')
@section('content')
    <div id="content">
        <div class="container">
            <div class="page-holder">
                @if (Session::has('message'))
                    <span class="alert-success"><span class="icon-checkmark"></span>{{ Session::get('message') }} !<a
                                class="close icon-cross"></a></span>
                @endif
                <div class="propertyDetails-page">
                    <div class="layout">
                        <div class="propertyImage-slider">
                            <strong class="property-title">
                                {{ ''.$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name .' '}}
                                {{$response['data']['property']->type->subType->name.'
                                 '.$response['data']['property']->purpose->name.' in '.$response['data']['property']->location->block->name.' Block'.
                                ' '.$response['data']['property']->location->society->name}}
                            </strong>
                            <div class="mask">
                                <?php
                                use App\Libs\Helpers\AuthHelper;
                                $images = [];
                                foreach ($response['data']['property']->documents as $document)
                                {
                                    if ($document->type == 'image')
                                    {
                                        $images[] = url('/') . '/temp/' . $document->path;
                                    }
                                }
                                if(sizeof($images) == 0)
                                {
                                    $images[] = url('/') . "/assets/imgs/no.png";
                                }
                                ?>
                                <div class="slideset">
                                    @foreach($images as $image)
                                        <div class="slide">
                                            <a href="{{$image}}" rel="lighbox" class="lightbox"><img src="{{$image}}"
                                            alt="image description"></a>
                                        </div>
                                    @endforeach
                                </div>
                                <span id="propertyImageCurrentSlide" class="current-num"></span>
                            </div>

                            <a href="#" class="propertyImage-slider-btn-prev"><span
                                        class="icon-chevron-thin-left"></span></a>
                            <a href="#" class="propertyImage-slider-btn-next"><span
                                        class="icon-chevron-thin-right"></span></a>

                            <div class="propertyImage-pagination">
                                <div class="propertyImage-mask">
                                    <div class="propertyImage-slideset">
                                        @foreach($images as $image)
                                            <div class="propertyImage-slide"><a href="#"><img
                                                            src="{{$image}}"
                                                            alt="image description"></a></div>
                                        @endforeach
                                    </div>
                                    <span class="paginationCurrent-num-1"></span>
                                </div>
                                <a href="#" class="propertyImage-pagination-btn-prev-1"><span
                                            class="icon-chevron-thin-left"></span></a>
                                <a href="#" class="propertyImage-pagination-btn-next-1"><span
                                            class="icon-chevron-thin-right"></span></a>
                            </div>
                        </div>

                        <div class="propertyOwnerInfo">
                            <header>
                                <span class="icon-home-button"></span>
                                <span>Do you want to view this property?</span>
                            </header>
                            <?php
                                $images = url('/') . "/assets/imgs/no.png";
                                if ($response['data']['property']->owner->agency != null)
                                {
                                    if ($response['data']['property']->owner->agency->logo != null)
                                    {
                                        $images = url('/') . '/temp/' . $response['data']['property']->owner->agency->logo;
                                    }
                                }
                            ?>
                            <div class="description">
                                <div class="layout">
                                    @if ($response['data']['property']->owner->agency != null)
                                        <img src="{{$images}}" width="300" height="300" alt="image description">
                                    @endif
                                    <div class="holder">
                                        <strong class="name">{{$response['data']['property']->contactPerson}}</strong>
                                        @if($response['data']['property']->owner->agency !=null)
                                            <span class="agency-name">{{$response['data']['property']->owner->agency->name}}</span>
                                            <a href="{{ URL::to('agent?agent_id='.$response['data']['property']->owner->id) }}"
                                               class="agency-profile">Agency Profile</a>
                                        @endif
                                    </div>
                                </div>
                                <ul class="contact-links">
                                    <li class="popup-holder">
                                        <a class="popup-opener"><span class="icon-envelope"></span>Send Email</a>

                                        <div class="popup">
                                            {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'email-popup'))}}

                                            <strong class="form-heading">Send Email</strong>

                                            <div class="input-field">
                                                <label for="from">From:</label>

                                                <div class="input-holder"><input type="text" id="from" name="from"
                                                                                 required></div>
                                            </div>
                                            <div class="input-field">
                                                <label for="msg">Message:</label>

                                                <div class="input-holder"><textarea id="msg" name="message"
                                                                                    required></textarea></div>
                                            </div>
                                            <div class="input-field"><input type="submit" value="Send"></div>
                                            {{Form::close()}}
                                            <a class="popup-close"><span class="icon-cross"></span></a>
                                        </div>
                                    </li>
                                    <li><a href="tel:{{$response['data']['property']->mobile}}"><span class="icon-phone_iphone"></span>{{$response['data']['property']->mobile}}</a>
                                    </li>
                                </ul>
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
                                <strong class="summary">Summary:</strong>
                                <dl>
                                    <dt>Property ID:</dt>
                                    <dd>{{$response['data']['property']->id}}</dd>
                                    <dt>Society:</dt>
                                    <dd>{{$response['data']['property']->location->society->name}}</dd>
                                    @if($response['data']['property']->location->block != null && $response['data']['property']->location->block->name != 'other')
                                        <dt>Block:</dt>
                                        <dd>{{$response['data']['property']->location->block->name}}</dd>
                                    @endif
                                    <dt>Type:</dt>
                                    <dd>{{$response['data']['property']->type->parentType->name}}</dd>
                                    @foreach($heightPriorityFeatures as $heightPriorityFeature)
                                        <dt>{{$heightPriorityFeature->name}}:</dt>
                                        <dd>{{$heightPriorityFeature->value}}</dd>
                                    @endforeach
                                    <dt>Area:</dt>
                                    <dd><b>{{$response['data']['property']->land->area.' '.$response['data']['property']->land->unit->name}}</b></dd>
                                    <dt>Price:</dt>
                                    <dd>
                                        <b>Rs {{App\Libs\Helpers\PriceHelper::numberToRupees($response['data']['property']->price)}}</b></dd>
                                    <dt>Added:</dt>
                                    <?php
                                    $startTimeStamp = strtotime(date("Y/m/d"));
                                    $myDate =substr($response['data']['property']->createdAt, 0, 10);
                                    $endTimeStamp = strtotime($myDate);
                                    $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                    $numberDays = $timeDiff/86400;  // 86400 seconds in one day
                                    // and you might want to convert to integer
                                    $numberDays = intval($numberDays);
                                    $days = "";
                                    if($numberDays == 0){$days = 'today';}elseif($numberDays == 1){ $days= 'day ago';}else{$days='days ago';};
                                    ?>
                                    <dd>@if($numberDays !=0){{$numberDays}} @endif {{$days}}</dd>
                                    <dt>Total Views:</dt>
                                    <dd>{{$response['data']['property']->totalViews}}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <h1>overview</h1>
                    <div class="overviewText-holder height">
                        <div class="overviewText">
                            <p>{{$response['data']['property']->description}}.</p>
                        </div>
                        <a class="btn-showMore">Show more</a>
                    </div>
                    <div class="extraFeature-block">
                        @if($response['data']['property']->features !=null)
                            <h1>Property Features</h1>
                        @endif
                        @foreach($response['data']['property']->features as $sectionName=>$features)
                            <h2>{{$sectionName}}</h2>

                            <ul class="feature-list">
                                @foreach($features as $feature)
                                    <li>
                                        <span>{{$feature->name}}</span>
                                        @if($feature->htmlStructure->name =='checkbox')
                                            <span class="last-child">yes</span>
                                        @else
                                            <span class="last-child">{{$feature->value}}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        @endforeach
                    </div>
                    <ul class="property-qucikLinks">
                        <li><a onclick="window.print()"><span class="icon-printer"></span>Print this Ad</a></li>
                        <li class="popup-holder">
                            <a class="popup-opener"><span class="icon-envelope"></span>Email to friend</a>

                            <div class="popup">
                                {{Form::open(array('url'=>'property-to-friend','method'=>'POST','class'=>'email-popup'))}}
                                <strong class="form-heading">Send Email</strong>

                                <div class="input-field">
                                    <label for="from1">To:</label>

                                    <div class="input-holder"><input type="text" required name="to" required id="to">
                                    </div>
                                </div>
                                <div class="input-field">
                                    <label for="msg1">Message:</label>

                                    <div class="input-holder"><textarea id="msg" required name="message"
                                                                        required></textarea></div>
                                </div>
                                <div class="input-field"><input type="submit" value="Send"></div>
                                {{Form::close()}}
                                <a class="popup-close"><span class="icon-cross"></span></a>
                            </div>
                        </li>
                        <?php
                        $user = (new AuthHelper())->user();
                        ?>
                        <li>
                            <a class="popup-opener @if($response['data']['isFavourite'] != 0) added-to-favs @endif">
                                <span class="add-to-favs addTo"
                                      property_id="{{$response['data']['property']->id}}" key="{{($user !=null)?$user->access_token:""}}"><span
                                            class="icon-favourites-filled-star-symbol"></span> Add to favorites</span>
                                <span class="addedToFavs remove-to-favs"
                                      property_id="{{$response['data']['property']->id}}"
                                      user_id="{{($user !=null)?$user->id:""}}" key="{{($user !=null)?$user->access_token:""}}"><span
                                            class="icon-favourites-filled-star-symbol"></span> Remove from favorites</span>
                            </a>
                            <div class="popup">
                                <div class="loginToContinue">
                                    <p>Dear user ! You are not logged in Please <a href="{{url('/login')}}">Login</a></p>
                                    <a class="popup-close"><span class="icon-cross"></span></a>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
            </ul>
        </div>
    </div>
@endsection