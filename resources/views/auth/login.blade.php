@extends('auth.auth')
@section('content')
<div class="container">
    <div class="login-registarHolder">
        <ul class="tabset">
            <li class="active"><a href="{{url('/login')}}">login</a></li>
            <li><a href="{{url('/register')}}">become a free member</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab1">
                <?php
                if(\Session::has('validationErrors')){
                    $validationErrors = \Session::get('validationErrors');
                }
                ?>
                @if(\Session::has('errors'))
                    <span class="global-error">
                        @foreach(\Session::get('errors') as $error)
                            {{$error}}<br>
                        @endforeach
                    </span>
                @endif

                    @if(\Session::has('success')) <span class="global-successMessage">{{ \Session::get('success') }} !</span> @endif
                    <form class="login-form" action="{{route('login')}}" method="post">
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                            <label class="icon-envelope" for="email"></label>
                            <input name="email" type="email" value="{{old('email')}}" placeholder="Enter Your Email Address" id="email" required>
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                        </div>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                            <label class="icon-key" for="pass"></label>
                            <input name="password" type="password" value="{{old('password')}}" placeholder="Enter Your Password" id="pass" required>
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                            <a href={{URL::to('forget-password')}} class="forgot-pass"><span class="icon-notification"></span> Forgot Password</a>
                        </div>
                        <button type="submit">Login <span class="icon-login"></span></button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection