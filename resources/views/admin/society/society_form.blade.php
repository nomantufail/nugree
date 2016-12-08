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
                <th>Enter Society</th>
           </tr>
        <tr>
            {{Form::open(array('url'=>'add/society','method'=>'POST','class'=>'rejectApprove-form'))}}
            <input type="hidden" name="city_id" value=1>
            <td><input type="text" name="society_name" placeholder="please Enter society"><br /><br />
                <input type="text" name="priority" placeholder="Enter the Priority Number">
            <button type="submit">Add Property</button></td>
            {{Form::close()}}
        </tr>

    </table>
    </div>


@endsection