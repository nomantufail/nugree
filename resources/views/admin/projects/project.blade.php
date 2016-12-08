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

                {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/add/project','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
                <td>
                    <label>Project Title</label>
                    <input type="text" name="title" placeholder="Add title">
                </td>
            </tr>

            <tr>
                <td>
                    <label>Project Description</label>
                    <textarea name="description" placeholder="Add description"></textarea>
                </td>

            </tr>
            <tr>
                <td>
                    <label>Project City</label>
                    <select name="city_id" id="cityId">
                        <option value="">Please Select</option>
                      @foreach($response['data']['cities'] as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                      @endforeach
                    </select>
                </td>

            </tr>
            <tr>
                <td>
                    <label>Project Society</label>
                    <select name="society_id" id="societies">
                        <option value="">Select Societies</option>
                    </select>
                </td>

            </tr>
            <tr>
                <td><br/><br/>
                    <label>select Image</label>
                    <input type="file" name="fileToUpload[]" id="fileToUpload" required multiple><br/><br/>
                    Banner should be 1MB No More then this
                </td>
            </tr>

            <tr>
                <td><br/><br/>

                    <button type="submit">Add Project</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>
@endsection