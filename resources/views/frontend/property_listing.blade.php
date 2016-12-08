@extends('frontend.frontend_old')
@section('content')
    <div id="content">

        <div class="container">
            <div class="page-holder">
                <div class="public-propertyListing">
                    <div class="holder">
                        <span class="searchResult-counter">Showing <b>1</b> to <b>{{$response['data']['propertiesCount'] }}</b> of
                            <b>{{$response['data']['totalProperties']}}</b> properties</span>
                        <ul class="sortBy">
                            <li>Sort By</li>
                            <li>
                                <select>
                                    <option>Default Order</option>
                                    <option>Price low to high</option>
                                    <option>Price high to low</option>
                                    <option>Beds low to high</option>
                                    <option>Bed high to low</option>
                                    <option>Area low to high</option>
                                    <option>Area high to low</option>
                                    <option>Date new to old</option>
                                    <option>Date old to new</option>
                                    <option>Verified only</option>
                                    <option>Hot only</option>
                                    <option>With videos</option>
                                    <option>With photos</option>
                                </select>
                            </li>
                        </ul>
                        <div class="layout">
                            <a href="#SearchPublic-Property" class="mySearch lightbox">My Search<span class="icon-search"></span></a>
                        </div>
                    </div>

                    <section class="property-posts">
                        @foreach($response['data']['properties'] as $property)
                            <article class="post">
                                <?php
                                $image = url('/')."/assets/imgs/no.png";
                                foreach($property->documents as $document)
                                {
                                    if($document->type == 'image' && $document->main == true)
                                    {
                                        $image = url('/').'/temp/'.$document->path;
                                    }
                                }
                                ?>
                                <div class="img-holder"><a href="property?propertyId={{$property->id}}"><img src="{{$image}}" width="600" height="450" alt="image description"></a></div>
                                <div class="caption">
                                    <strong class="post-heading"><a href="property?propertyId={{$property->id}}"><span class="landUnit">{{ ''.$property->land->area.' '.$property->land->unit->name .' '}}</span> {{$property->type->subType->name.'
                        '.$property->purpose->name.' in '.$property->location->block->name.' Block'.
                        ' '.$property->location->society->name}}</a><span
                                                class="price">Rs {{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</span>
                                        <span class="subTitle">{{'('.str_limit($property->title,25).')' }}</span>
                                    </strong>
                                    <address>{{str_limit($property->description,150)}}.</address>
                                    <ul class="property-details">
                                        @foreach($property->features as $feature)
                                            @foreach($feature as $featureSection)
                                                @if($featureSection->priority ==1)
                                                    <li>{{$featureSection->value}} {{$featureSection->name}}</li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                                    <div class="holder">
                                        <ul class="quick-links">
                                            <li><a href="property?propertyId={{$property->id}}"><span class="icon-pencil"></span>More Details</a></li>

                                        </ul>

                                        <?php
                                        $image = url('/') . "/assets/imgs/no.png";
                                        if ($property->owner->agency != null) {
                                            if ($property->owner->agency->logo != null) {
                                                $image = url('/') . '/temp/' . $property->owner->agency->logo;
                                            }
                                        }
                                        ?>
                                        <div class="state-logo"><a href="{{ URL::to('agent?agent_id='.$property->owner->id) }}">
                                                <img src="{{$image}}" width="300" height="300" alt="nugree.com">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </section>
                    <?php
                    $for_previous_link = $_GET;
                    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
                    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
                    $convertPreviousToQueryString  = http_build_query($for_previous_link);
                    $previousResult = URL('/search').'?'.$convertPreviousToQueryString;
                    ?>
                    <?php
                    $totalPaginationValue = intval(ceil($response['data']['totalProperties'] / config('constants.Pagination')));
                    $for_next_link = $_GET;
                    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
                    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
                    $convertToQueryString  = http_build_query($for_next_link);
                    $nextResult = URL('/search').'?'.$convertToQueryString;
                    ?>
                    <ul class="pager">
                        @if($totalPaginationValue !=0)
                        <li><a href="{{$previousResult}}" class="previous"><span class="icon-chevron-thin-left"></span></a></li>
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
                            <li><a href="{{$nextResult}}" class="next"><span class="icon-chevron-thin-right"></span></a></li>
                          @endif
                    </ul>

                    <div class="lightbox" id="SearchPublic-Property">
                        <div class="mySearch-Form">
                            {{ Form::open(array('url' => 'search','method' => 'GET')) }}
                            <ul class="propertyPurpose">
                                <li>
                                    <label for="buy-1">
                                        <input type="radio" name="purpose_id" value="1" id="buy-1" @if($response['data']['oldValues']['purposeId'] == 1) checked @endif>
                                        <span class="fake-label">Buy</span>
                                    </label>
                                </li>
                                <li>
                                    <label for="rent-1">
                                        <input type="radio" name="purpose_id" id="rent-1" value="2" @if($response['data']['oldValues']['purposeId'] == 2) checked @endif>
                                        <span class="fake-label">Rent</span>
                                    </label>
                                </li>
                            </ul>
                            <ul class="propertyType">
                                @foreach($response['data']['propertyTypes'] as $propertyType)
                                    <li>
                                        <label for={{$propertyType->name.$propertyType->id}}>
                                            <input type="radio" id={{$propertyType->name.$propertyType->id}}
                                                    class="property_type"  name="property_type_id" value="{{$propertyType->id}}"
                                                   @if($response['data']['oldValues']['propertyTypeId'] == $propertyType->id)checked @endif>
                                            <span class="fake-label">{{$propertyType->name}}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="fields">
                                <li>
                                    <label>Select Sub Type:</label>
                                    <span class="fake-select">
                                    <span class="load">
                                    <select name="sub_type_id" id="property_sub_types" old_sub_type="{{$response['data']['oldValues']['subTypeId']}}">
                                        <option  value="">All Property SubType</option>
                                        @foreach($response['data']['propertySubtypes'] as $propertySubType)
                                            <option value="{{$propertySubType->id}}">{{$propertySubType->name}}</option>
                                        @endforeach
                                    </select>
                                </span>
                                        </span>
                                </li>
                                <li>
                                    <label>Select Society:</label>
                                    <span class="fake-select">
                                      <span class="load">
                                    <select name="society_id" id="society" class="js-example-basic-single">
                                        <option  value="">All Societies</option>
                                        @foreach($response['data']['societies'] as $society)
                                            <option value="{{$society->id}}" @if($response['data']['oldValues']['societyId'] == $society->id) selected @endif>{{$society->name}}</option>
                                        @endforeach
                                    </select>
                                </span>
                               </span>
                                </li>
                                <li>
                                    <label>Select Block:</label>
                                  <span class="fake-select">
                                      <span class="load">
                                        <select class="js-example-basic-single" name="block_id" id="blocks" old_block="{{$response['data']['oldValues']['blockId']}}">
                                            <option selected value="">Any</option>
                                        </select>
                                      </span>
                                 </span>
                                </li>
                                <li class="bedrooms">
                                    <label>Select Bedrooms:</label>
                                    <span class="fake-select">
                                    <span class="load">
                                    <select name="property_features[28]" id="bedrooms-select">
                                        <option value="">Any</option>
                                        <option value=1 @if($response['data']['oldValues']['propertyFeatures'][28] == 1) selected @endif>1</option>
                                        <option value=2 @if($response['data']['oldValues']['propertyFeatures'][28] == 2) selected @endif>2</option>
                                        <option value=3 @if($response['data']['oldValues']['propertyFeatures'][28] == 3) selected @endif>3</option>
                                        <option value=4 @if($response['data']['oldValues']['propertyFeatures'][28] == 4) selected @endif>4</option>
                                        <option value=5 @if($response['data']['oldValues']['propertyFeatures'][28] == 5) selected @endif>5</option>
                                        <option value=6 @if($response['data']['oldValues']['propertyFeatures'][28] == 6) selected @endif>6</option>
                                        <option value=7 @if($response['data']['oldValues']['propertyFeatures'][28] == 7) selected @endif>7</option>
                                        <option value=8 @if($response['data']['oldValues']['propertyFeatures'][28] == 8) selected @endif>8</option>
                                        <option value=9 @if($response['data']['oldValues']['propertyFeatures'][28] == 9) selected @endif>9</option>
                                        <option value=10 @if($response['data']['oldValues']['propertyFeatures'][28] == 10) selected @endif>10</option>
                                    </select>
                                        </span>
                                        </span>
                                </li>
                                <li>
                                    <label>Price Range (Rs):</label>
                                    <div class="input-holder priceArea"><input type="number" placeholder="From" name="price_from" value="{{$response['data']['oldValues']['priceFrom']}}" class="PriceField priceInputFrom"><span class="price-Range detailedPriceFrom">Please enter the price</span></div>
                                    <div class="input-holder priceArea"><input type="number" placeholder="To" name="price_to"value="{{$response['data']['oldValues']['priceTo']}}" class="PriceField priceInputTo"><span class="price-Range detailedPriceTo">Please enter the price</span></div>
                                </li>
                                <li>

                                        <label>Land Unit</label>
                                        <div class="input-holder add">
                                        <select name="land_unit_id">
                                            @foreach($response['data']['landUnits'] as $landUnit)
                                                <option value="{{$landUnit->id}}" @if($response['data']['oldValues']['landUnitId'] == $landUnit->id) selected @endif>{{$landUnit->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>

                                    <div class="input-holder add"><input type="number" placeholder="From" name="land_area_from" value="{{$response['data']['oldValues']['landAreaFrom']}}"></div>
                                    <div class="input-holder add"><input type="number" placeholder="To" name="land_area_to" value="{{$response['data']['oldValues']['landAreaTo']}}"></div>
                                </li>
                            </ul>
                            <button type="submit"><span class="icon-search"></span>Search my property</button>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).on('loaded','#property_sub_types', function () {
            var subTypeId = parseInt($('#property_sub_types').attr('old_sub_type'));
            if(!isNaN(subTypeId)){
                $("#property_sub_types").val(subTypeId).change();
            }
        });
        $(document).on('loaded','#blocks', function () {
            var subTypeId = parseInt($('#blocks').attr('old_block'));
            if(!isNaN(subTypeId)){
                $("#blocks").val(subTypeId).change();
            }
        });



        $(document).ready(function(){
            $('.property_type').trigger('change');
            $('#society').trigger('change');
        });
    </script>
@endsection