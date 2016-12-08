@extends('admin.admin2')
@section('content')
    <?php
    if (\Session::has('validationErrors')) {
        $validationErrors = \Session::get('validationErrors');
        //dd($validationErrors);
    }
    ?>
    <style>
        table, th, td {
            border: 1px solid black;

        }
    </style>
    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
        <table>
            <tr>
                   
                <th>Update Location</th>

            </tr>

            {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/update/location','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
            <tr>
                <input type="hidden" name="location_id" value="{{$response['data']['location']->id}}">
                <td>
                    <label>Select City</label>
                    <select name="city_id">
                        <option value="">Please Select</option>
                        @foreach($response['data']['cities'] as $city)
                            <option value="{{$city->id}}" @if($response['data']['location']->cityId == $city->id) selected @endif>{{$city->name}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                  <td>
                    <label>Location Name</label>
                    <input type="text" name="location" placeholder="Add Location" value="{{$response['data']['location']->location}}">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Lat</label>
                    <input type="text" name="lat" placeholder="Add lat" value="{{$response['data']['location']->lat}}">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Long</label>
                    <input type="text" name="long" placeholder="Add long" value="{{$response['data']['location']->long}}">
                </td>
            </tr>
            <tr>


            </tr>


            <tr>
                <td><br/><br/>

                    <button type="submit">Update Location</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>
@endsection