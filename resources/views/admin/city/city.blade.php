@extends('admin.admin2')
@section('content')
    <?php
    if(\Session::has('validationErrors')){
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
                   
                <th>Add Project</th>

            </tr>
            <tr>

                {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/add/city','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
                <td>
                    <label>City Name</label>
                    <input type="text" name="city_name" placeholder="Add City">
                </td>
            </tr>

            <tr>
                <td>
                    <label>Select Country</label>
                    <select name="country_id" id="country_id">
                        <option value="">Please Select</option>
                      @foreach($response['data']['countries'] as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                      @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                <td>
                    <label>City Priority</label>
                    <input type="text" name="priority" placeholder="Add Priority">
                </td>

            </tr>
            <tr>
                <td><br/><br/>
                    <label>select City Image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" required multiple><br/><br/>
                    City image should be 1MB No More then this
                </td>
            </tr>

            <tr>
                <td><br/><br/>

                    <button type="submit">Add City</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>
@endsection