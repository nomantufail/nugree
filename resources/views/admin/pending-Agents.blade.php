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
                            <div class="t-head by-type"><span class="descending">Name</span></div>
                            <div class="t-head by-location"><span class="descending">Address</span></div>
                            <div class="t-head by-price"><span class="descending">Phone</span></div>
                            <div class="t-head"><span class="descending">Listed Date</span></div>
                            <div class="t-head by-view"><span class="descending">Status</span></div>
                            <div class="t-head"><span class="descending">Controls</span></div>
                        </li>
                        @foreach($response['data']['agents'] as $agent)
                            <li class="accordion-row">
                                <div class="t-data by-id">
                                    <input type="checkbox">
                                    <label for="id1">{{$agent->id}}</label>
                                </div>
                                <div class="t-data by-type"><p>{{$agent->fName.' '.$agent->lName}}</p></div>
                                <div class="t-data by-location"><p>{{$agent->address}}</p></div>
                                <div class="t-data by-price"><p>{{$agent->phone}}</p></div>
                                <div class="t-data">
                                    <time datetime="2016-04-18">{{$agent->createdAt}}</time>
                                </div>
                                <div class="t-data by-view">@if($agent->trustedAgent !=1) Pending @endif</div>
                                <div class="t-data">
                                    {{Form::open(array('url'=>'admin/agent/approve','method'=>'POST'))}}
                                    <input hidden name="userId" value="{{$agent->id}}">
                                    <button class="accept" title="Accept"><span class="icon-checkmark" type="submit"></span></button>
                                    {{Form::close()}}

                                    <a class="details opener" title="Details"><span class="icon-notebook"></span></a>
                                </div>
                                <div class="slide">
                                    <div class="two-cols">
                                        <div class="col">
                                            @if($agent->agencies !=null)
                                            <h1>Owner info:</h1>
                                            <p><b>Owner Name:</b>  {{$agent->agencies[0]->name}}</p>
                                            <p><b>Owner Email:</b> {{$agent->agencies[0]->email}}</p>
                                            <p><b>Owner Phone:</b> {{$agent->agencies[0]->phone}}</p>
                                                @endif
                                        </div>
                                        <div class="col">
                                            @if($agent->agencies !=null)
                                            <h1>property description:</h1>
                                            <p>{{$agent->agencies[0]->description}}.</p>
                                                @endif
                                        </div>
                                    </div>
                                    <a href="{{URL::to('get/agent')}}?userId={{$agent->id}}" class="btn-more">View more</a>
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