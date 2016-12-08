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
                <th>Project ID</th>
                <th>Image</th>
                <th>Action</th>
                  </tr>
                @if(isset($response['data']['projectImage']))
                    @foreach($response['data']['projectImage'] as $image)

                <tr>
                    <td>{{$image->projectId}}</td>
                    <td><img src="{{ url('/').'/'.$image->image}}" width="100px" height="100px">
                        <br />
                    </td>
                    <td>
                        {{Form::open(array('url'=>'maliksajidawan786@gmail.com/delete/image','method'=>'POST'))}}
                        <input hidden name="image_id" value="{{$image->id}}">
                        <button><span type="submit" ></span>Delete</button>
                        {{Form::close()}}

                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>


@endsection