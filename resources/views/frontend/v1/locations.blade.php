@extends('frontend.v1.frontend')
@section('content')
  <div class="popular-locations-holder container text-center">
    <h2 class="popular-locations-heading">POPULAR <span>LOCATIONS</span></h2>
    <span class="location-name">{{(isset($response['data']['city'][0]))?$response['data']['city'][0]->cityName:''}} <span>
        {{(isset($response['data']['city'][0]))?$response['data']['city'][0]->totalLocations:''}}</span></span>
    <ul class="popular-locations-list">
    @if(isset($response['data']['locations']))
      @foreach($response['data']['locations'] as $location)
        @if($location->totalProperties !=0)
      <li><a href="{{URL::to('properties').'/'.$response['data']['city'][0]->citySlug.'/'.$location->slug}}">{{$location->location}}<span>{{$location->totalProperties}}</span></a></li>
        @endif
      @endforeach
    @endif
    </ul>
  </div>
@endsection