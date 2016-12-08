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
                   
                <th>Add Location</th>

            </tr>
            {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/add/location','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
            <tr>
                <td>
                    <label>Select City</label>
                    <select name="city_id">
                        <option value="">Please Select</option>
                        @foreach($response['data']['cities'] as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                  <td>
                    <label>Location Name</label>
                    <input type="text" name="location" placeholder="Add Location">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Lat</label>
                    <input type="text" name="lat" placeholder="Add lat">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Long</label>
                    <input type="text" name="long" placeholder="Add long">
                </td>
            </tr>
            <tr>


            </tr>


            <tr>
                <td><br/><br/>

                    <button type="submit">Add Location</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>
@endsection