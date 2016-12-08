@extends('auth.auth')
@section('content')
<main id="main" role="main">
    <div class="container">
        <div class="forgot-passwordHolder">

                <?php
                if(\Session::has('validationErrors')){
                    $validationErrors = \Session::get('validationErrors');
                }
                ?>
             <div class="forgot-password">
                 @if(\Session::has('message'))
                     <span class="global-successMessage">{{\Session::get('message')}}</span>
                 @endif
               {{ Form::open(array('url' => 'get-new-password','method' => 'POST' ,'class'=>'forgot-form')) }}
                    <strong class="forgot-heading">Let's get you into your account.</strong>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                        <input type="email" name="email" placeholder="Enter Your Email Address" id="email">
                        <span class="border"></span>
                        <label for="email" class="icon-envelope"></label>
                    </div>
                    <button type="submit">Send Password</button>
                    <a href="{{url('/login')}}" class="btn-log">Click for Login</a>
               {{Form::close()}}
            </div>
        </div>
    </div>
</main>
@endsection