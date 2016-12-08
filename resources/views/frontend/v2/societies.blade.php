@foreach($response['data']['societies'] as $society)
<a href="{{URL::to('society/maps?societyId=').$society->id}}"><h1>{{$society->name}}</h1></a>
@endforeach