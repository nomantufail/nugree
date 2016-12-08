<!DOCTYPE html>
<html>
<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property42</title>
    <!-- include the site stylesheet -->
    <link media="all" rel="stylesheet" href="{{url('/web-apps/registration/assets/')}}/css/auth-main.css">
    <!-- google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <script src="{{url('/web-apps/registration/assets/')}}/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<!-- main container of all the page elements -->
<div id="wrapper">
    <header id="header" class="home-header">
        <div class="layout">
            <div class="logo"><a href="{{ URL::to('/') }}"><img
                            src="{{url('/')}}/web-apps/frontend/assets/images/logo.png" width="695"
                            height="301" alt="Property42"></a></div>
            <nav id="nav">
                <ul class="main-navigation">
                    <li>
                        <a href="#">Buy</a>
                        <ul class="dropDown">
                            @foreach($globals['propertyTypes'] as $propertyType)
                                <li><a href={{URL::to('search?purpose_id=1'.'&property_type_id='.$propertyType->id)}}>{{$propertyType->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="#">Rent</a>
                        <ul class="dropDown">
                            @foreach($globals['propertyTypes'] as $propertyType)
                                <li><a href={{URL::to('search?purpose_id=2'.'&property_type_id='.$propertyType->id)}}>{{$propertyType->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="agent-link"><a href="{{URL::to('agents')}}">agents</a></li>
                    <li class="hidden-desktop"><a href="{{URL::to('add-property') }}">Add a property</a></li>
                </ul>
            </nav>
            <a class="nav-opener"><span></span></a>
            <a href="{{ URL::to('add-property') }}" class="btn-header hidden-xs"><span
                        class="icon-plus"></span>Add a property</a>
            @if($_SESSION['authUser'] ==null)
                <a href="{{ URL::to('/login') }}" class="btn-header loginRegister">login / register</a>
            @endif
        </div>
    </header>
    <main id="main" role="main">
        @yield('content');
    </main>

    <footer id="footer">
        <div class="container">
            <div class="cols-holder">
                <div class="col">
                    <strong class="heading">Address</strong>
                    <address>4105 Garfield Road Bartonville, IL 61607, UAE</address>
                </div>
                <div class="col">
                    <strong class="heading">Social media</strong>
                    <ul class="social-networks">
                        <li><a href="#" class="facebook"><span class="icon-facebook"></span></a></li>
                        <li><a href="#" class="twitter"><span class="icon-twitter"></span></a></li>
                    </ul>
                </div>
                <div class="col">
                    <strong class="heading">Organization</strong>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">privcy policy</a></li>
                        <li><a href="#">terms of use</a></li>
                     </ul>
                </div>
                <div class="col">
                    <strong class="heading">Contact us</strong>
                    <form class="contact">
                        <div class="input-holder"><input type="email" placeholder="Enter Your Email Address" required></div>
                        <div class="input-holder"><textarea placeholder="Enter Your Message" required></textarea></div>
                        <input type="submit" value="Send">
                    </form>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- include jQuery library -->
<!-- include custom JavaScript -->
<script type="text/javascript" src="{{url('/web-apps/registration/assets/')}}/js/helper.js" defer></script>
<script type="text/javascript" src="{{url('/web-apps/registration/assets/')}}/js/placeholder.js" defer></script>
<script type="text/javascript" src="{{url('/web-apps/registration/assets/')}}/js/jquery.main.js" defer></script>
</body>
</html>