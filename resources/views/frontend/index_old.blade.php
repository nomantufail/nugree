@extends('frontend.frontend_old')
@section('content')
<div class="main-visual">
        <div class="property-search-holder">

            <div class="tabs-holder">
                {{ Form::open(array('url' => 'search','method' => 'GET')) }}
                <ul class="main-links">
                    <li>
                        <label for="buy1">
                            <input type="radio" name="purpose_id" value="1" id="buy1" checked >
                            <span class="fake-label">Buy</span>
                        </label>
                    </li>
                    <li>
                        <label for="rent1">
                            <input type="radio" name="purpose_id" id="rent1" value="2">
                            <span class="fake-label">Rent</span>
                        </label>
                    </li>
                </ul>
                <div class="tab-content">

                    <ul class="propertyType-buttons">
                        @foreach($response['data']['propertyTypes'] as $propertyType)
                            <li>
                                <label for="{{$propertyType->name."_".$propertyType->id}}">
                                    <input type="radio" id="{{$propertyType->name."_".$propertyType->id}}" @if($propertyType->id == 1) checked @endif
                                           name="property_type_id" class="property_type" value="{{$propertyType->id}}">
                                    <span class="fake-label">{{$propertyType->name}}</span>
                                </label>
                            </li>
                        @endforeach

                    </ul>
                    <ul>
                        <li>
                            <label>Society:</label>

                            <div class="input-holder">
<span class="fake-select">
<select name="society_id" id="society" class="js-example-basic-single">
    <option  value="">All Societies</option>
    @foreach($response['data']['societies'] as $society)
        <option value="{{$society->id}}">{{$society->name}}</option>
    @endforeach
</select>
</span>
         </div>
            </li>

             <li>
                <label>Block:</label>
                    <div class="input-holder">
                        <span class="fake-select">
                            <span class="load">
                                <select name="block_id" id="blocks" class="js-example-basic-single">
                                    <option selected value="">All Blocks</option>
                                </select>
                            </span>
                        </span>
                    </div>
                </li>
                    </ul>
                    <ul>
                        <li>
                            <label>Property SubType:</label>
                            <div class="input-holder">
                                <span class="fake-select">
                                   <span class="load">
                                    <select name="sub_type_id" id="property_sub_types" class="js-example-basic-single">
                                        <option selected value="">Property SubType</option>
                                    </select>
                                  </span>
                                </span>
                            </div>
                        </li>
                        <li class="bedrooms">
                            <label>Bedrooms:</label>

                            <div class="input-holder">
<span class="fake-select">
<select name="property_features[28]" id="bedrooms-select" >
    <option value="" selected>Any</option>
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    <option value=6>6</option>
    <option value=7>7</option>
    <option value=8>8</option>
    <option value=9>9</option>
    <option value=10>10</option>


</select>
</span>
                            </div>
                        </li>
                    </ul>
                    <ul class="inline">
                        <li class="full">Price Range (Rs)</li>
                        <li class="priceArea">
                            <span>From:</span>
                            <div class="input-holder"><input type="number" name="price_from" class="PriceField priceInputFrom">
                                <span class="price-Range detailedPriceFrom">Please enter the price</span>
                            </div>
                        </li>
                        <li class="priceArea">
                            <span>to:</span>
                            <div class="input-holder"><input type="number" name="price_to" class="PriceField priceInputTo"><span class="price-Range detailedPriceTo">Please enter the price</span></div>
                        </li>
                    </ul>
                    <ul class="inline">
                        <li class="full">
                            <label>Land Area</label>

                            <div class="fake-select">
                                <select name="land_unit_id" name="land_unit_id">
                                    @foreach($response['data']['landUnits'] as $landUnit)
                                        <option value="{{$landUnit->id}}" @if($landUnit->id == 3) selected @endif>{{$landUnit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        <li>
                            <span>From:</span>

                            <div class="input-holder"><input type="number" name="land_area_from"></div>
                        </li>
                        <li>
                            <span>to:</span>

                            <div class="input-holder"><input type="number" name="land_area_to"></div>
                        </li>
                    </ul>
                    <div class="btn-holder">
                        <button type="submit">Find Property<span class="icon-search"></span></button>
                    </div>
                </div>
                {{Form::close()}}
            </div>

        </div>
        <a href="#content" class="smooth-scroll down-scroll"><span class="icon-angle-down"></span></a>
    </div>
    <div id="content">
        <div class="container">
            <div class="page-holder">
                <div class="index-page">
                    <h1>featured home</h1>

                    <div class="step-slider">
                        <div class="mask">
                            <div class="slideset">
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img01.jpg" width="600"
                                                height="450" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img02.jpg" width="600"
                                                height="400" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img03.jpg" width="800"
                                                height="600" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img04.jpg" width="823"
                                                height="459" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img05.jpg" width="600"
                                                height="400" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn-prev" href="#"><span class="icon-circle-left"></span></a>
                        <a class="btn-next" href="#"><span class="icon-circle-right"></span></a>
                    </div>
                    <h1>featured plots</h1>

                    <div class="step-slider">
                        <div class="mask">
                            <div class="slideset">
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img01.jpg" width="600"
                                                height="450" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img02.jpg" width="600"
                                                height="400" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img03.jpg" width="800"
                                                height="600" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img04.jpg" width="823"
                                                height="459" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                                <div class="slide">
                                    <div class="image-holder"><img
                                                src="{{url('/')}}/web-apps/frontend/assets/images/img05.jpg" width="600"
                                                height="400" alt="image description"></div>
                                    <div class="description">
                                        <strong class="heading">ax air avenue</strong>

                                        <p>Lahore</p>
                                        <span class="price">Rs 2.99 crore</span>
                                        <a href="#" class="btn">see more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn-prev" href="#"><span class="icon-circle-left"></span></a>
                        <a class="btn-next" href="#"><span class="icon-circle-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.property_type').trigger('change');
            $('#society').trigger('change');
        });
    </script>
@endsection