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
                   
                <th>Add News</th>

            </tr>
            <tr>

                {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/add/news','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
                <td>
                    <label>News Title</label>
                    <input type="text" name="title" placeholder="Add title">
                </td>
            </tr>

            <tr>
                <td>
                    <label>News Description</label>
                    <textarea name="description" placeholder="Add description"></textarea>
                </td>

            </tr>

            <tr>
                <td><br/><br/>
                    <label>select Image</label>
                    <input type="file" name="fileToUpload[]" id="fileToUpload" required multiple><br/><br/>
                    Image should be 1MB No More then this
                </td>
            </tr>

            <tr>
                <td><br/><br/>

                    <button type="submit">Add News</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>
@endsection