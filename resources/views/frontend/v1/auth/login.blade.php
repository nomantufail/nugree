@extends('frontend.v1.frontend')
@section('content')
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/login-page.css">
    <?php
    if (\Session::has('validationErrors')) {
        $validationErrors = \Session::get('validationErrors');
    }
    ?>
    <div class="login-page container">
        @if(\Session::has('success'))<span class="global-success">{{ \Session::get('success') }}</span>@endif
        @if(\Session::has('errors'))
            <span class="global-error"> @foreach(\Session::get('errors') as $error) {{$error}}<br> @endforeach
                    </span>
        @endif
        <form class="login-form" action="{{route('login')}}" method="post">
            <h1>Log<span>in</span></h1>

            <div class="layout">
                <label for="login-email">E-mail ID</label>

                <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                    <input name="email" type="email" value="{{old('email')}}" placeholder="Enter Your Email Address"
                           id="email" required>
                    <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                </div>
            </div>
            <div class="layout">
                <label for="login-pass">Password</label>

                <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                    <input name="password" type="password" value="{{old('password')}}" placeholder="Enter Your Password"
                           id="pass" required>
                    <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                    <a href="#forgot-pass" class="forgot-pass lightbox">Forgot Password ?</a>
                </div>
            </div>
            <ul class="buttons-holder text-upparcase">
                <li>
                    <button type="submit">LOGIN<span class="icon-login"></span></button>
                </li>
                <li>
                    <a href="{{url('/register')}}">REGISTER NOW</a>
                </li>
            </ul>
            <strong class="text-or"><span>Or</span></strong>
            <div class="text-center"><a href="{{url('/')}}/redirect" class="fb-login"><span class="icon-facebook"></span>Signup with facebook</a></div>
        </form>
        <div class="popup-holder">
            <div class="popup lightbox generic-lightbox" id="forgot-pass">
                {{ Form::open(array('url' => 'get-new-password','method' => 'POST' ,'class'=>'forgot-form')) }}

                <h1>Forgot <span>Password</span></h1>

                <p>Enter your email address below and we will send you a new password.</p>

                <div class="layout">
                    <label for="forgot-email">E-mail ID</label>

                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                        <input type="email" name="email" placeholder="Enter Your Email Address" id="email">

                    </div>
                </div>
                <ul class="buttons-holder text-upparcase text-center">
                    <li>
                        <button type="submit">SEND</button>
                    </li>
                </ul>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection