<h1>Society Name : {{$response['data']['societiesMaps'][0]->society}}</h1>
@foreach($response['data']['societiesMaps'] as $society)
<img src="{{url('/').$society->path}}" width="100" height="100">
@endforeach