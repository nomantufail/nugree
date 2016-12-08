@extends('admin.admin2')
@section('content')

    <style>
        table, th, td {
            border: 1px solid black;

        }
    </style>
    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
    <table style="width:50%">

          <tr>
                <th>Update Society</th>
           </tr>
        <tr>

            {{Form::open(array('url'=>'update/society','method'=>'POST','class'=>'rejectApprove-form'))}}
            <input type="hidden" name="city_id" value=1>
            <input type="hidden" name="society_id" value="{{$response['data']['society']->id}}">
            <td><input type="text" name="society_name" value="{{$response['data']['society']->name}}" placeholder="please Enter society"><br /><br />
                <input type="text" name="priority" value="{{$response['data']['society']->priority}}" placeholder="Enter the Priority Number">
            <button type="submit">Add Property</button></td>
            {{Form::close()}}
        </tr>

    </table>
    </div>


@endsection