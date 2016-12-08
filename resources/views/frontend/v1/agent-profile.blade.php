@extends('frontend.v1.frontend')
@section('content')
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/property-agent-detail.css">
    @foreach($response['data']['banners']['topBanners'] as $banner)
        <a><img src="{{url('/').'/'.$banner->image}}" width="100px" height="100px"></a>
    @endforeach
    <div class="agent-detail-page">
        <div class=" detail-holder container">
            <div class="frame">
                <div class="agent-detail-holder">
                    <?php
                    $image = url('/') . "/assets/imgs/no.png";
                    if ($response['data']['agent']->agencies[0]->logo != "") {
                        $image = url('/') . '/temp/' . $response['data']['agent']->agencies[0]->logo;
                    }
                    ?>
                    <div class="agent-picture">
                        <img src="{{$image}}" alt="image description">
                        {{--<a class="add-to-favorite added" href="#"></a>--}}
                        {{--<span class="premiumProperty text-upparcase">Premium</span>--}}
                    </div>
                    <div class="agent-description">
                        <div class="layout">
                            <div class="left-side">
                                <h1><span>{{$response['data']['agent']->agencies[0]->name}}</span></h1>
                                <span class="location">Lahore</span>
                            </div>
                            <div class="right-side">

                                @if($response['data']['agent']->trustedAgent)
                                    <span class="trusted-agent"><span class="icon-premium-badge"></span>Trusted</span>
                                @endif
                            </div>
                        </div>
                        @if(sizeof($response['data']['agent']->agencies) > 0 )
                            @if((sizeof($response['data']['agent']->agencies[0]->locations)) > 0)
                                <div class="agent-societies">
                                    <span class="small-heading">Locations we deal in</span>
                                    <div class="agent-mask ">
                                        <div class="agent-slideset">
                                            @foreach($response['data']['agent']->agencies[0]->locations as $location )
                                                @if($location != null)
                                                    <div class="agent-slide">
                                                        <a>
                                                            @if( isset($location->location->path) && $location->location->path !=null)
                                                                <img src="{{url('/').'/' .$location->location->path}}" alt="image description">
                                                            @else
                                                                <span class="image-description">{{$location->location->location}}</span>
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <a href="#" class="btn-prev"><span class="icon-left-arrow"></span></a>
                                        <a href="#" class="btn-next"><span class="icon-rights-arrow"></span></a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="info-blockAgent" id="fixed-block">
                    <span class="heading text-upparcase">Contact Details</span>
                    <ul class="agentDetail-list">
                        <li>
                            <span class="icon-user"></span>
                            <span class="text-tag">{{$response['data']['agent']->fName.' '.$response['data']['agent']->lName}}</span>
                        </li>
                        <li>
                            <span class="icon-location"></span>
                            <address>{{$response['data']['agent']->address}}</address>
                        </li>
                        <li>
                            <span class="icon-mobile"></span>
                            <span class="text-tag"><a href="tel:{{$response['data']['agent']->mobile}}"></a>{{$response['data']['agent']->mobile}}</span>
                        </li>
                        <li>
                            <span class="icon-old-phone"></span>
                            <span class="text-tag"><a href="tel:{{$response['data']['agent']->phone}}">{{$response['data']['agent']->phone}}</a></span>
                        </li>
                    </ul>
                    {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'inquiry-email-form'))}}
                    <span class="small-heading">Send email</span>
                    <div class="field-holder">
                        <label for="name">Name</label>

                        <div class="input-holder"><input type="text" id="name" name="name"></div>
                    </div>
                    <div class="field-holder">
                        <label for="email">Email</label>

                        <div class="input-holder"><input type="email" id="email" name="email" required></div>
                    </div>
                    <div class="field-holder">
                        <label for="phone">phone</label>

                        <div class="input-holder"><input type="tel" id="phone" name="phone" required></div>
                    </div>
                    <div class="field-holder">
                        <label for="subject">subject</label>

                        <div class="input-holder"><input type="text" id="subject" name="subject"></div>
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
            <div class="overview-section">
                <span class="small-heading full-width">Agent Overview</span>
                <p>{{$response['data']['agent']->agencies[0]->description}}</p>
            </div>
            @if($response['data']['userPropertiesState'] !=null)
                <div class="extra-feature-section">
                    <span class="small-heading">Properties LISTING</span>
                    <div class="layout">
                        @foreach($response['data']['userPropertiesState'] as $key=>$propertySubTypes)
                            <div class="col">
                                <span class="small-heading">{{$key}}</span>
                                <ul class="list">
                                    @foreach($propertySubTypes as $propertySubType)
                                        <li><span>{{$propertySubType->subType}}</span><span>{{$propertySubType->totalProperties}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection