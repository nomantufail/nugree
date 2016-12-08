@extends('admin.admin2')
@section('content')

    <style>
        table, th, td {
            border: 1px solid black;

        }
    </style>
    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
    <table style="width:50%">
        <a href="{{URL::to('get/society/form')}}">Add Property</a>
          <tr>
                <th>Society ID</th>
                <th>City Name</th>
                <th>Society Name</th>
                <th>Action</th>
              </tr>
        @foreach($response['data']['societies'] as $society)
         <tr>
            <td>{{$society->id}}</td>
             <td>Lahore</td>
            <td>{{$society->name}}</td>
             <td>
             {{Form::open(array('url'=>'delete/society','method'=>'POST','class'=>'rejectApprove-form'))}}
              <input hidden name="society_id" value="{{$society->id}}">
                 <button><span type="submit" ></span>Delete</button>
             {{Form::close()}}
                 {{Form::open(array('url'=>'get/update/society/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                 <input hidden name="society_id" value="{{$society->id}}">
                 <button><span type="submit" ></span>Update</button>
                 {{Form::close()}}
             </td>
        </tr>
        @endforeach
    </table>
    </div>


@endsection