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
                <th>News ID</th>
                <th>News Title</th>
                <th>News Description</th>
                <th>Image</th>
                <th>Action</th>
                  </tr>
                @if(isset($response['data']['news']))
                    @foreach($response['data']['news'] as $news)
                <tr>
                    <td>{{$news->id}}</td>
                    <td>{{$news->title}}</td>
                    <td>{{str_limit($news->description,20)}}</td>
                    <td>
                        @if(isset($news->images[0]))
                        <img src="{{ url('/').'/'.$news->images[0]->image}}" width="100px" height="100px">
                        @endif
                        <br />
                      <a href="{{URL::To('maliksajidawan786@gmail.com/get/news/images').'?news_id='.$news->id}}">Edit Images</a>
                    </td>
                    <td>
                        {{Form::open(array('url'=>'maliksajidawan786@gmail.com/delete/news','method'=>'POST'))}}
                        <input hidden name="news_id" value="{{$news->id}}">
                        <button><span type="submit" ></span>Delete</button>
                        {{Form::close()}}
                        <br />
                        {{Form::open(array('url'=>'get/update/news/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="news_id" value="{{$news->id}}">
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
    $previousResult = URL('/maliksajidawan786@gmail.com/news/listing').'?'.$convertPreviousToQueryString;
    ?>
    <?php
    $totalPaginationValue = intval(ceil($response['data']['newsCount'] / config('constants.Pagination')));

    $for_next_link = $_GET;
    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
    $convertToQueryString  = http_build_query($for_next_link);
    $nextResult = URL('/maliksajidawan786@gmail.com/news/listing').'?'.$convertToQueryString;
    ?>
    <ul class="pager">
        @if($totalPaginationValue !=0)
            <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
        @endif
        <?php
        $paginationValue = intval(ceil($response['data']['newsCount'] / config('constants.Pagination')));
        $query_str_to_array = $_GET;
        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
        $query_str_to_array['page'] = $i;
        $queryString  = http_build_query($query_str_to_array);
        $result = URL('/maliksajidawan786@gmail.com/news/listing').'?'.$queryString;
        ?>
        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
        <?php }?>
        @if($totalPaginationValue !=0)
            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
        @endif
    </ul>

@endsection