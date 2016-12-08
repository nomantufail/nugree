@foreach($response['data']['societiesForFiles'] as $society)
<a href="{{URL::to('get/society/files?societyId=').$society->id}}"><h1>{{$society->name}}</h1></a>
@endforeach