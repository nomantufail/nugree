<h1>Society Name : {{$response['data']['society']->name }} </h1>

 <a href="{{ URL::to('society/image/download?societyId='.$response['data']['society']->id) }} ">
   <img src="{{url('/').'/'.$response['data']['societyFiles']->image}}" width="100" height="100">
     <br />  Image Download
 </a>
<a href="{{ URL::to('society/doc/download?societyId='.$response['data']['society']->id) }} ">
    <br /> Doc Download
</a>
<a href="{{ URL::to('society/pdf/download?societyId='.$response['data']['society']->id) }} ">
    <br />PDF Download
</a>