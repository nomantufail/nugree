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
                   
                <th>Update News</th>

            </tr>
            <tr>

                {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/update/news','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
                <input type="hidden" name="news_id" value="{{$response['data']['news']->id}}">
                <td>
                    <label>Project Title</label>
                    <input type="text" name="title" value="{{$response['data']['news']->title}}">
                </td>
            </tr>

            <tr>
                <td>
                    <label>Project Description</label>
                    <textarea name="description" placeholder="Add description">{{$response['data']['news']->description}}</textarea>
                </td>

            </tr>

            <tr>


                <td><br/><br/>
                    <label>select Image</label>
                    <input type="file" name="fileToUpload[]" id="fileToUpload"  multiple><br/><br/>
                    Banner should be 1MB No More then this
                </td>
            </tr>

            <tr>
                <td><br/><br/>
                    <button type="submit">Update News</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>
@endsection