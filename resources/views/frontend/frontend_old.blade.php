<!DOCTYPE html>
<html>
<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property42</title>
    <!-- include the site stylesheet -->
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/assets/css/main.css">
    <!-- google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
                    <li class="hidden-desktop"><a href="{{ URL::to('add-property') }}">Add a property</a></li>
                </ul>
                {{ Form::open(array('url' => 'property','method' => 'GET','class'=>'searchByID')) }}
                <input type="number" name="propertyId" value="{{(isset($response['data']['propertyId']))?$response['data']['propertyId']:""}}" placeholder="Search by ID">
                <button type="submit"><span class="icon-search"></span></button>
                {{Form::close()}}
            </nav>
            <a class="nav-opener"><span></span></a>
            <a href="{{ URL::to('add-property') }}" class="btn-header hidden-xs"><span class="icon-plus"></span>Add a property</a>
            @if($_SESSION['authUser'] ==null)
                <a href="{{ URL::to('/login') }}" class="btn-header loginRegister">login / register</a>
            @else

            <div class="btn-header loggedIn">
                <p><span class="icon-user"></span>{{$_SESSION['authUser']->fName.' '.$_SESSION['authUser']->lName}}</p>
                <ul class="LoggedIn-links">
                    <li><a href="{{URL::to('dashboard#/home/profile')}}"><span class="icon-user2"></span>My profile</a></li>
                    <li><a href="{{URL::to('dashboard#/home/properties/all')}}"><span class="icon-pencil"></span>My Listing</a></li>
                    <li><a href="{{URL::to('/logout')}}"><span class="icon-logout"></span>Logout</a></li>
                </ul>
            </div>
            @endif
        </div>
    </header>
    <main id="main" role="main">
        @yield('content')
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
                        <li><a href="https://www.facebook.com/property42pk-1562646287317094/" class="facebook"><span
                                        class="icon-facebook"></span></a></li>
                        <li><a href="https://twitter.com/Property42_pk" class="twitter"><span
                                        class="icon-twitter"></span></a></li>
                    </ul>
                </div>
                <div class="col">
                    <strong class="heading">Organization</strong>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">terms of use</a></li>
                      </ul>
                </div>
                <div class="col">
                    <strong class="heading">Contact us</strong>
                    {{ Form::open(array('url' => 'contact_us','method' => 'POST','class'=>'contact')) }}
                    <div class="input-holder"><input type="email" name="email" placeholder="Enter Your Email Address" required ></div>
                    <div class="input-holder"><textarea name="message" placeholder="Enter Your Message" required></textarea></div>
                    <input type="submit" value="Send">
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- include jQuery library -->
<!-- include custom JavaScript -->
<script type="text/javascript" src="{{url('/')}}/assets/js/helper.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/js/env.js"></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/tabset-plugin.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/add-propertyFrom.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/helper.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/lightBox.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/smooth-scroll-plugin.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/carousal.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/placeholder.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/jquery.main.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/select2-min.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/assets/js/search-property.js" defer></script>
</body>
</html>
