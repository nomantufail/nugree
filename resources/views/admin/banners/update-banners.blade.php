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
                   
                <th>Update Banners</th>

            </tr>
            <tr>

                {{Form::open(array('url'=> 'maliksajidawan786@gmail.com/update/banner','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}

                <td>
                    <label>select society</label>
                    <select name="society_id[]" multiple>
                        <option value="" <?= (sizeof($response['data']['bannerSocieties'])) ==0 ? 'selected':'' ?> >All Society</option>
                        @foreach($response['data']['societies'] as $society)
                            <option value="{{$society->id }}" <?= (in_array($society->id,$response['data']['bannerSocieties']))? 'selected':'' ?>  >{{$society->name}}</option>
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
                            <option value="{{$pages->id }}" <?= (in_array($pages->id,$response['data']['bannerPages']))? 'selected':'' ?>>{{$pages->page}}</option>
                        @endforeach
                    </select><br/><br/>
                    Hold Ctrl button and Select Multiple
                </td>

            </tr>
            <tr>
                <td>
                    <label>select Land area</label>
                    <select name="area[]" multiple>
                        <option value="" <?= (sizeof($response['data']['bannersSize']['area'])) ==0 ? 'selected':'' ?> >All Land Area</option>
                        @for($i =1; $i <=100; $i++)
                        <option value="{{$i}}" <?= (in_array($i,$response['data']['bannersSize']['area']))? 'selected':'' ?>>{{$i}}</option>
                        @endfor
                      </select><br/><br/>
                    Hold Ctrl button and Select Multiple
                </td>
                <td>
                <label>select Land Unit</label>
                <select name="unit" >
                    <option value="">Please Select Unit</option>
                    <option value="marla" <?= ((!emptyArray($response['data']['bannersSize']['unit']) && $response['data']['bannersSize']['unit'][0]) == 'marla')?'selected':''?>>Marla</option>
                    <option value="kanal" <?= ((!emptyArray($response['data']['bannersSize']['unit']) && $response['data']['bannersSize']['unit'][0]) == 'kanal')?'selected':''?>>Kanal</option>
                 </select><br/><br/>
                </td>
            </tr>
            <tr>
                <td><br/><br/>
                    <img src="{{url('/').'/'.$response['data']['banner']->image}}" width="100px" height="100px">
                    <br />
                    <label>select Image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" ><br/><br/>
                    Banner should be 1MB No More then this
                </td>
            </tr>
            <tr>
                <td><br/>
                    <label>Banner Position</label>
                    <select name="position" required>
                        <option value="" selected >Please Select Position</option>
                        <option value="slider" <?= (($response['data']['banner']->position) == 'slider')?'selected':''?> >Slider</option>
                        <option value="top" <?= (($response['data']['banner']->position) == 'top')?'selected':''?> >Top</option>
                        <option value="left" <?= (($response['data']['banner']->position) == 'left')?'selected':''?>>Left</option>
                        <option value="right" <?= (($response['data']['banner']->position) == 'left')?'selected':''?>>Right</option>
                        <option value="between" <?= (($response['data']['banner']->position) == 'between')?'selected':''?>>Between</option>
                    </select>
                </td>
            </tr><br/><br/>

            <tr>
                <td><br/>
                    <label>Banner Type</label>
                    <select name="type" required>
                        <option value="">Please Select Type</option>
                        <option value="fix" <?= (($response['data']['banner']->bannerType) == 'fix')?'selected':''?>>Fix</option>
                        <option value="relevant" <?= (($response['data']['banner']->bannerType) == 'relevant')?'selected':''?> >Relevant</option>
                    </select>
                </td>
            </tr><br/><br/>
            <tr>
                <td><br/><br/>
                    <label>select Priority</label>
                    <input type="text" name="priority" value="{{$response['data']['banner']->bannerPriority}}" placeholder="please Enter priority" required><br/><br/>

                </td>

            </tr>
            <input type="hidden" name="banner_id" value="{{$response['data']['banner']->id}}">
            <tr>
                <td><br/><br/>
                    <label>Post Banner Link</label>
                    <input type="text" name="banner_link" value="{{$response['data']['banner']->bannerLink}}" placeholder="please Enter Banner Link"><br/><br/>
                    <button type="submit">Update Banner</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>




@endsection