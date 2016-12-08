<!DOCTYPE html>
<html>
<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property42</title>
    <!-- include the site stylesheet -->
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/admin/css/main.css">
    <!-- google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <script src="{{url('/')}}/web-apps/admin/js/jquery-1.11.2.min.js"></script>
</head>
<body>
<a href="#"><span class="lodaing-page">nugree.com</span></a>
<!-- main container of all the page elements -->
<div id="wrapper">
    <header id="header">
        <a href="{{URL::to('/')}}" class="logo"><span class="hidden-xs">Property</span>42</a>
        <a class="sideBar-opener"><span></span></a>
        <a href="{{url('admin')}}" class="logout" title="Logout"><span class="icon-logout"></span> <span class="hidden-xs">Logout</span></a>
    </header>
    <main id="main" role="main">
        <aside id="sidebar-dashboard">
            <div class="user-picture">
                <div class="layout">
                    <a href="#" class="image-thumb"><img src="{{url('/')}}/web-apps/admin/images/user-img.png" width="388" height="395" alt="user-image"></a>
                    <div class="layout">
                        <a href="#" class="user-name">{{isset(Session('admin')->name)}}</a>
                        <span class="account-type">premium</span>
                    </div>
                </div>
            </div>
            <ul class="sideBar-links">
                <li><a href="#"><span class="icon-home-button"></span>dashboard</a></li>
               <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/properties')}}"><span class="icon-list"></span>listings  </a></li>
                <li class="active"><a href="{{URL::to('get/maliksajidawan786@gmail.com/active/property')}}"><span class="icon-list"></span>Active Properties </a></li>
                <li class="active"><a href="{{URL::to('get/maliksajidawan786@gmail.com/pending/property')}}"><span class="icon-list"></span>pending Properties </a></li>
                <li class="active"><a href="{{URL::to('get/maliksajidawan786@gmail.com/rejected/property')}}"><span class="icon-list"></span>Rejected Properties </a></li>
                <li class="active"><a href="{{URL::to('get/maliksajidawan786@gmail.com/expired/property')}}"><span class="icon-list"></span>Expired Properties </a></li>
                <li class="active"><a href="{{URL::to('get/maliksajidawan786@gmail.com/deleted/property')}}"><span class="icon-list"></span>Deleted Properties </a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/agents')}}"><span class="icon-list"></span>Agents </a></li>
                {{--<li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/societies')}}"><span class="icon-list"></span>Societies </a></li>--}}
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/city')}}"><span class="icon-list"></span>City </a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/city/listing')}}"><span class="icon-list"></span>City Listing </a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/location')}}"><span class="icon-list"></span>Location </a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/location/listing')}}"><span class="icon-list"></span>Location Listing</a></li>
                {{--<li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/blocks')}}"><span class="icon-list"></span>Blocks </a></li>--}}
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/banners')}}"><span class="icon-list"></span>Banners </a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/banners/listing')}}"><span class="icon-list"></span>Banners Listing</a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/project')}}"><span class="icon-list"></span>Project</a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/project/listing')}}"><span class="icon-list"></span>Project Listing</a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/news')}}"><span class="icon-list"></span>News</a></li>
                <li class="active"><a href="{{URL::to('maliksajidawan786@gmail.com/news/listing')}}"><span class="icon-list"></span>News Listing</a></li>
            </ul>
        </aside>
        @yield('content')
</main>
    <footer id="footer">
        <div class="container">
            <div class="cols-holder">
                <div class="col">
                    <h2>Address</h2>
                    <address>4105 Garfield Road Bartonville, IL 61607, UAE</address>
                </div>
                <div class="col">
                    <h2>About</h2>
                    <ul>
                        <li><a href="#">Terms of Trade</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Copyrights</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h2>Follow us</h2>
                    <ul class="social-networks">
                        <li><a href="#" class="facebook"><span class="icon-facebook"></span></a></li>
                        <li><a href="#" class="twitter"><span class="icon-twitter"></span></a></li>
                    </ul>
                </div>
                <div class="col">
                    <h2>Contact Us</h2>
                    <form class="contact">
                        <div class="input-holder error">
                            <input type="email" placeholder="Enter you email address">
                            <span class="error-text">Please enter a valid email.</span>
                        </div>
                        <div class="input-holder error">
                            <textarea placeholder="Enter you message"></textarea>
                            <span class="error-text">Please enter a message.</span>
                        </div>
                        <input type="submit"  value="Send">
                    </form>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- include custom JavaScript -->
<script type="text/javascript" src="{{url('/')}}/web-apps/admin/js/dashboard.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/admin/js/jquery.main.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/assets/js/env.js"></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/frontend/v2/js/property_detail.js" defer></script>
</body>
</html>