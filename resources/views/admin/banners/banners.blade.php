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
                   
                <th>Add Banners</th>

            </tr>
            <tr>

                {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/add/banner','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
                <td>
                    <label>select society</label>
                    <select name="society_id[]" multiple>
                        <option value="" selected>All Societies</option>
                        @foreach($response['data']['societies'] as $society)

                            <option value="{{$society->id }}">{{$society->name}}</option>
                        @endforeach
                    </select><br/><br/>
                    Hold Ctrl button and Select Multiple
                </td>
            </tr>

            <tr>
                <td>
                    <label>select Pages</label>
                    <select name="pages[]" multiple required>
                        <option value="">Please Select Page</option>
                        @foreach($response['data']['pages'] as $pages)
                            <option value="{{$pages->id }}">{{$pages->page}}</option>
                        @endforeach
                    </select><br/><br/>
                    Hold Ctrl button and Select Multiple
                </td>

            </tr>
            <tr>
                <td>
                    <label>select Land area</label>
                    <select name="area[]" multiple>
                        <option value="" selected>All Sizes</option>
                        @for($i =1; $i <=100; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select><br/><br/>
                    Hold Ctrl button and Select Multiple
                </td>
                <td>
                    <label>select Land Unit</label>
                    <select name="unit" >
                        <option value="">Please Select Unit</option>
                        <option value="marla">Marla</option>
                        <option value="kanal">Kanal</option>
                    </select><br/><br/>
                </td>
            </tr>
            <tr>
                <td><br/><br/>
                    <label>select Image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" required><br/><br/>
                    Banner should be 1MB No More then this
                </td>
            </tr>
            <tr>
                <td><br/>
                    <label>Banner Position</label>
                    <select name="position" required>
                        <option value="" selected >Please Select Position</option>
                        <option value="slider">Slider</option>
                        <option value="top">Top</option>
                        <option value="left">Left</option>
                        <option value="right">Right</option>
                        <option value="between">Between</option>
                    </select>
                </td>
            </tr><br/><br/>

            <tr>
                <td><br/>
                    <label>Banner Type</label>
                    <select name="type" required>
                        <option value="">Please Select Type</option>
                        <option value="fix">Fix</option>
                        <option value="relevant">Relevant</option>

                    </select>
                </td>
            </tr><br/><br/>
            <tr>
                <td><br/><br/>
                    <label>select Priority</label>
                    <input type="text" name="priority" value="" placeholder="please Enter priority" required><br/><br/>

                </td>

            </tr>
            <tr>
                <td><br/><br/>
                    <label>Post Banner Link</label>
                    <input type="text" name="banner_link" value="" placeholder="please Enter Banner Link"><br/><br/>
                    <button type="submit">Add Banner</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>




@endsection