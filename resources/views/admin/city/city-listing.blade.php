@extends('admin.admin2')
@section('content')

    <style>
        table, th, td {
            border: 1px solid black;

        }
    </style>
    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
        <br/>
            <table style="width:50%">
                <tr>
                <th>City ID</th>
                <th>City Name</th>
                <th>Priority</th>
                <th>Image</th>
                <th>Action</th>
                  </tr>

                @if(isset($response['data']['cities']))
                    @foreach($response['data']['cities'] as $city)
                <tr>
                    <td>{{$city->id}}</td>
                    <td>{{$city->city}}</td>
                    <td>{{$city->priority}}</td>
                    <td><img src="{{ url('/').'/'.$city->path}}" width="100px" height="100px">
                        <br />
                      <a href="{{URL::To('maliksajidawan786@gmail.com/get/project/images').'?project_id='.$city->id}}">Edit Images</a>
                    </td>
                    <td>
                        {{Form::open(array('url'=>'maliksajidawan786@gmail.com/delete/city','method'=>'POST'))}}
                        <input hidden name="city_id" value="{{$city->id}}">
                        <button><span type="submit" ></span>Delete</button>
                        {{Form::close()}}
                        <br />
                        {{Form::open(array('url'=>'get/update/city/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="city_id" value="{{$city->id}}">
                        <button><span type="submit" ></span>Update</button>
                        {{Form::close()}}
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>

    <?php
    $for_previous_link = $_GET;
    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
    $convertPreviousToQueryString  = http_build_query($for_previous_link);
    $previousResult = URL('/maliksajidawan786@gmail.com/city/listing').'?'.$convertPreviousToQueryString;
    ?>
    <?php
    $totalPaginationValue = intval(ceil($response['data']['citiesCount'] / config('constants.Pagination')));
    $for_next_link = $_GET;
    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
    $convertToQueryString  = http_build_query($for_next_link);
    $nextResult = URL('/maliksajidawan786@gmail.com/city/listing').'?'.$convertToQueryString;
    ?>
    <ul class="pager">
        @if($totalPaginationValue !=0)
            <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
        @endif
        <?php
        $paginationValue = intval(ceil($response['data']['citiesCount'] / config('constants.Pagination')));
        $query_str_to_array = $_GET;
        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
        $query_str_to_array['page'] = $i;
        $queryString  = http_build_query($query_str_to_array);
        $result = URL('/maliksajidawan786@gmail.com/city/listing').'?'.$queryString;
        ?>
        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
        <?php }?>
        @if($totalPaginationValue !=0)
            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
        @endif
    </ul>

@endsection