@extends('admin.admin2')
@section('content')
    <div class="pages-holder">
        <div class="pendingForAdmin-property-holder">
            <div class="property-form-table">
                <div class="property-filter">
                    <form class="by-user-sorting">
                        <ul>
                            <li>
                                <label>Show</label>
                                <select>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                </select>
                            </li>
                        </ul>
                    </form>
                    <ul class="quick-links">
                        <li><a href="#" class="delete"><span class="icon-bin"></span>Delete</a></li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <ul class="properties-table accordion">
                        <li>
                            <div class="t-head by-id">
                                <input type="checkbox" id="ID">
                                <label><span class="descending">ID</span></label>
                            </div>
                            <div class="t-head by-type"><span class="descending">Type</span></div>
                            <div class="t-head by-location"><span class="descending">Location</span></div>
                            <div class="t-head by-price"><span class="descending">Price (PKR)</span></div>
                            <div class="t-head"><span class="descending">Listed Date</span></div>
                            <div class="t-head by-view"><span class="descending">Views</span></div>
                            <div class="t-head"><span class="descending">Controls</span></div>
                        </li>
                        @foreach($response['data']['properties'] as $property)
                        <li class="accordion-row">
                            <div class="t-data by-id">
                                <input type="checkbox">
                                <label for="id1">{{$property->id}}</label>
                            </div>
                            <div class="t-data by-type"><p>{{$property->type->parentType->name}}.</p></div>
                            <div class="t-data by-location"><p>{{$property->location->location->location}}</p></div>
                            <div class="t-data by-price"><p>Rs {{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</p></div>
                            <div class="t-data">
                                <time datetime="2016-04-18">{{$property->createdAt}}</time>
                            </div>
                            <div class="t-data by-view">{{$property->totalViews}}</div>
                            <div class="t-data">
                                @if($property->propertyStatus->id != 5)
                                {{Form::open(array('url'=>'maliksajidawan786@gmail.com/property/approve','method'=>'POST','class'=>'rejectApprove-form'))}}
                                    <input hidden name="propertyId" value="{{$property->id}}">
                                 <button class="accept" title="Accept"><span class="icon-checkmark" type="submit"></span></button>
                                {{Form::close()}}
                                    @else{{Form::open(array('url'=>'maliksajidawan786@gmail.com/property/deActive','method'=>'POST','class'=>'rejectApprove-form'))}}
                                <input hidden name="propertyId" value="{{$property->id}}">
                                <button ><span  type="submit"></span>DA</button>
                                {{Form::close()}}
                                @endif
                                @if($property->isVerified != 1)
                                {{Form::open(array('url'=>'maliksajidawan786@gmail.com/property/verify','method'=>'POST','class'=>'rejectApprove-form'))}}
                                <input hidden name="propertyId" value="{{$property->id}}">
                                <button><span type="submit" ></span>V</button>
                                {{Form::close()}}

                                    @else
                                        {{Form::open(array('url'=>'maliksajidawan786@gmail.com/property/deVerify','method'=>'POST','class'=>'rejectApprove-form'))}}
                                        <input hidden name="propertyId" value="{{$property->id}}">
                                        <button><span type="submit" ></span>DV</button>
                                        {{Form::close()}}
                                    @endif
                                    @if($property->propertyStatus->id != 15)
                                        {{Form::open(array('url'=>'maliksajidawan786@gmail.com/property/reject','method'=>'POST','class'=>'rejectApprove-form'))}}
                                    <input hidden name="propertyId" value="{{$property->id}}">
                                <button class="delete" title="Delete the property" type="submit"><span class="icon-sign"></span></button>
                                {{Form::close()}}
                                    @endif
                                <a class="details opener" title="Details"><span class="icon-notebook"></span></a>
                            </div>
                            <div class="slide">
                                <div class="two-cols">
                                    <div class="col">
                                        <h1>Owner info:</h1>
                                        <p><b>Owner Name:</b> {{$property->contactPerson}}</p>
                                        <p><b>Owner Email:</b> {{$property->email}}</p>
                                        <p><b>Owner Phone:</b> {{$property->phone}}</p>
                                        <p><b>Owner Fax:</b> {{$property->fax}}</p>
                                    </div>
                                    <div class="col">
                                        <h1>property title:</h1>
                                        <p>{{$property->title}}</p>
                                        <h1>property description:</h1>
                                        <p>{{$property->description}}.</p>
                                    </div>
                                </div>
                                <a href="{{URL::to('get/property')}}?propertyId={{$property->id}}" class="btn-more">View more</a>
                            </div>
                        </li>
                      @endforeach
                    </ul>
                </div>
                <ul class="pager">
                    <li><a><span class="icon-chevron-thin-left"></span>Previous</a></li>
                    <li><span class="static">Showing <em><b>2</b></em> of <em><b>551</b></em> pages</span></li>
                    <li class="disable"><a>Next<span class="icon-chevron-thin-right"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection