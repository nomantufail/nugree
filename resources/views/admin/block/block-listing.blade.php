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
                    <th>Enter Block</th>
            </tr>
            <tr>
            </tr>
            <tr>
              {{Form::open(array('url'=> 'get/blocks','method'=>'GET','class'=>'rejectApprove-form'))}}
                <td>
                    <select name="society_id">
                        <option value="">Please Select Society </option>
                        @foreach($response['data']['societies'] as $society)
                            <option value="{{$society->id }}" @if(isset($response['data']['societyId']) && $response['data']['societyId'] == $society->id ) selected @endif >{{$society->name}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>
            <tr><td><button type="submit">Get Blocks</button></td></tr>
            {{Form::close()}}
        </table>
    </div>

    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
        <table>
        <br /><br /><br />
            <tr>
        {{Form::open(array('url'=> 'add/blocks','method'=>'POST','class'=>'rejectApprove-form'))}}

        <td><br />
            <input type="hidden" name="society_id" value="{{(isset($response['data']['societyId']))?$response['data']['societyId']:''}}">
            <input type="text" name="block_name" value="" placeholder="please Enter society"><br /><br />
        </td>
                <td><button type="submit">Add Block</button></td>
            </tr>



        {{Form::close()}}
        </table>
        <table style="width:50%">

              <tr>
                <th>Block ID</th>
                <th>Block Name</th>
                <th>Action</th>
                  </tr>
                @if(isset($response['data']['blocks']))
                    @foreach($response['data']['blocks'] as $block)
                <tr>
                    <td>{{$block->id}}</td>
                    <td>{{$block->name}}</td>
                    <td>
                        {{Form::open(array('url'=>'delete/blocks','method'=>'POST'))}}
                        <input type="hidden" name="society_id" value="{{(isset($response['data']['societyId']))?$response['data']['societyId']:''}}">
                        <input hidden name="block_id" value="{{$block->id}}">
                        <button><span type="submit" ></span>Delete</button>
                        {{Form::close()}}
                        {{Form::open(array('url'=>'get/update/block/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input type="hidden" name="society_id" value="{{(isset($response['data']['societyId']))?$response['data']['societyId']:''}}">
                        <input hidden name="block_id" value="{{$block->id}}">
                        <button><span type="submit" ></span>Update</button>
                        {{Form::close()}}
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>


@endsection