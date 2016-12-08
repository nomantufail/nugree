<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:image" content="{{url('/')}}/web-apps/frontend/v2/images/logo.png">
    <meta property="og:url" content="http://nugree.com/public">
    <meta property="og:title" content="Lahore Largest Property Website">

    <title>Lahore Largest Property website | nugree.com</title>
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/frontend/v2/images/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/frontend/v2/images/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/frontend/v2/images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/frontend/v2/images/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="{{url('/')}}/web-apps/frontend/v2/images/favicon-32x32.png" sizes="32x32">
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/v2/css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,300,500,600,700,800,400italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-83646008-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body class="loading-page">
<div class="page-loader">
    <div class="page-loader-holder">
        <img src="{{url('/')}}/assets/imgs/loader.gif" alt="Property42 loading">
    </div>
</div>
<div id="wrapper" class="hidden">
    <div class="w1-holder">
        <div class="w1">
    <div class="main-bg-holder {{(Route::getCurrentRoute()->getPath() !='/')?'byDefault-fixed':''}}">
        <header id="header">
            <div class="top-bar">
                <div class="left-side">
                    <span class="phone"><a href="tel:923219555542"><span class="icon-mobile"></span>+923219555542</a></span>
                    <div class="layout">
                        <a class="navigation-toggler nav-opener"><span></span><strong class="hidden-xs">menu</strong></a>
                        {{ Form::open(array('url' => 'property','method' => 'GET','class'=>'searchByID')) }}
                            <input type="search" name="propertyId" value="{{(isset($response['data']['propertyId']))?$response['data']['propertyId']:""}}" placeholder="Search by ID">
                            <button type="submit"><span class="icon-search"></span></button>
                        {{Form::close()}}
                    </div>
                </div>
                <div class="right-sideTop text-right">
                    <a class="mail" href="mailto:&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#112;&#107;"></a>
                    <ul class="loginRegister text-upparcase text-left">
                        @if($_SESSION['authUser'] ==null)
                        <li><a href="{{ URL::to('/login') }}"><span class="icon-avatar hidden"></span><span class="hidden-xs">Login / Register</span></a></li>
                        @else

                            <li>
                            <a><span class="icon-avatar"></span><span class="hidden-xs">{{str_limit($_SESSION['authUser']->fName.' '.$_SESSION['authUser']->lName,13)}}</span></a>
                            <ul class="dropDown">
                                <li><a href="{{URL::to('dashboard#/home/profile')}}">MY PROFILE</a></li>
                                <li><a href="{{URL::to('dashboard#/home/properties/all')}}">My Listing</a></li>
                                <li><a href="{{URL::to('/logout')}}"><span class="icon-login"></span>logout</a></li>
                            </ul>
                        </li>
                        @endif
                        <li><a href="{{ URL::to('add-property') }}"><span class="hidden-xs">List your property</span><span class="icon-plus-square"></span></a></li>
                    </ul>
                    <a href="#requirement" class="lightbox">Submit your Requirement</a>
                </div>
            </div>
            <div class="logo"><a href="{{URL::to('/')}}"><img src="{{url('/')}}/web-apps/frontend/v2/images/logo.png" width="477" height="150" alt="Property42"></a></div>
        </header>
        @if(Route::getCurrentRoute()->getPath() =='/')
            <div class="main-visualSection">
                <div class="container">
                    {{--<strong class="main-heading text-upparcase"><span class="blue">Lahore's</span> <span class="black">Best</span> Property Website</strong>--}}
                    {{--<p>Are you thinking of buying your first property, downsizing, or looking to upgrade to bigger and better? Where do you want to live? Let us help you find that ideal home!</p>--}}
                    {{--<ul class="number-of-properties text-upparcase">--}}
                        {{--@foreach($response['data']['saleAndRentCount'] as $saleRent)--}}
                            {{--<li>--}}
                                {{--<strong class="numberOfProperty">{{$saleRent->totalProperties}}</strong>--}}
                                {{--<span class="tag">{{$saleRent->displayName}}</span>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                    {{ Form::open(array('url' => 'search','method' => 'GET','class'=>'mainSearch-form' )) }}

                    <ul class="typeOfBuying text-upparcase">
                        <li>
                            <label for="buy1">
                                <input type="radio" name="purpose_id" value="1" id="buy1" checked >
                                <span class="fake-label">Buy</span>
                            </label>
                        </li>
                        <li>
                            <label for="rent1">
                                <input type="radio" name="purpose_id" id="rent1" value="2">
                                <span class="fake-label">Rent</span>
                            </label>
                        </li>
                    </ul>
                    <div class="form-holder">
                        <ul class="subTypes">
                            <li>
                                <label for="all-type" class="customRadio">
                                    <input type="radio" name="property_type_id" id="all-type" value="">
                                    <span class="fake-radio"></span>
                                    <span class="fake-label">All types</span>
                                </label>
                            </li>
                            @foreach($response['data']['propertyTypes'] as $propertyType)
                                <li>
                                    <label for="{{$propertyType->name."_".$propertyType->id}}" class="customRadio">
                                        <input type="radio" id="{{$propertyType->name."_".$propertyType->id}}"
                                               name="property_type_id" class="property_type" value="{{$propertyType->id}}">
                                        <span class="fake-radio"></span>
                                        <span class="fake-label">{{$propertyType->name}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="layout">
                            <ul class="inputsHolder">
                                <li>
                                    <span class="label">Location / City</span>
                                    <div class="input-holder">
                                        <select name="city_id" id="cityId" class="js-example-basic-single">
                                            <option value="">All Cities</option>
                                            @foreach($response['data']['cities'] as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <span class="label">Location / Societies</span>
                                    <div class="input-holder">
                                        <select name="society_id" id="societies" class="js-example-basic-single">
                                            <option value="">All Societies</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <button type="submit"><span class="icon-search"></span>search</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        @endif
        <nav id="nav">
            {{ Form::open(array('url' => 'property','method' => 'GET','class'=>'searchByID hidden')) }}
            <input type="search" name="propertyId" value="{{(isset($response['data']['propertyId']))?$response['data']['propertyId']:""}}" placeholder="Search by ID">
            <button type="submit"><span class="icon-search"></span></button>
            {{Form::close()}}
            <div class="nav-holder">
                <a class="navigation-toggler close"><span class="icon-cross"></span></a>
                <ul class="main-navigation text-upparcase">
                    <li class="">
                        <a href="{{URL::to('/')}}">HOME</a>
                    </li>
                    <li>
                        <a href="{{URL::to('/')}}/search">Properties</a>
                    </li>
                    <li>
                        <a href="{{URL::to('agents')}}">AGENTS</a>
                    </li>
                    <li>
                        <a href="{{(Route::getCurrentRoute()->getPath() !='/')? url('/').'#about-us':'#about-us'}}" class="{{(Route::getCurrentRoute()->getPath() !='/')? '':'scroll'}}">ABOUT</a>
                    </li>
                    <li>
                        <a href="{{(Route::getCurrentRoute()->getPath() !='/')? url('/').'#contact-us':'#contact-us'}}" class="{{(Route::getCurrentRoute()->getPath() !='/')? '':'scroll'}}">CONTACT</a>
                    </li>
                </ul>
                <div class="mobile-content text-center">
                    <ul class="social-icons">
                        <li><a target="_blank" href="https://www.facebook.com/property42pk-1562646287317094/"><span class="icon-facebook"></span></a></li>
                        <li><a target="_blank" href="https://plus.google.com/115605703040474791286"><span class="icon-google-plus-symbol"></span></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/in/propertyfortytwo-pk-275899124"><span class="icon-linkedin"></span></a></li>
                        <li><a target="_blank" href="https://twitter.com/Property42_pk"><span class="icon-twitter"></span></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/property42/"><span class="icon-instagram"></span></a></li>
                    </ul>
                    <span class="copyright">Copyright, <a href="#">nugree.com</a></span>
                </div>
            </div>
        </nav>
    </div>
    <main id="main" role="main">
        @yield('content')
    </main>
            <div class="fb-page" data-href="https://www.facebook.com/property42/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/property42/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/property42/">Facebook</a></blockquote></div>

            <a class="twitter-timeline" href="https://twitter.com/nomantufail100 ">Tweets by TwitterDev</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
    <footer id="footer">
        <span class="copyright">Copyright,<a href="{{url('/')}}">nugree.com</a></span>
    </footer>
        </div>
    </div>
    <a href="#feedback" class="feedBack lightbox">Feedback</a>
    <div class="popup-holder">
        <div id="feedback" class="lightbox generic-lightbox">
            <span class="lighbox-heading">Feed<span>back</span></span>
            {{Form::open(array('url'=>'feedback','method'=>'POST','class'=>'inquiry-email-form'))}}
            <div class="field-holder">
                <label for="name">Name</label>

                <div class="input-holder"><input type="text" id="name" name="name"></div>
            </div>
            <div class="field-holder">
                <label for="email">Email</label>

                <div class="input-holder"><input type="email" id="email" name="email"
                                                 required></div>
            </div>
            <div class="field-holder">
                <label for="phone">phone</label>

                <div class="input-holder"><input type="tel" id="phone" name="phone"
                                                 required></div>
            </div>
            <div class="field-holder">
                <label for="subject">subject</label>

                <div class="input-holder"><input type="text" id="subject" name="subject">
                </div>
            </div>
            <div class="field-holder">
                <label for="message">message</label>

                <div class="input-holder"><textarea id="message" name="message"
                                                    required></textarea>
                    <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms of Use</a></p>
                </div>
            </div>
            <button type="submit">SEND</button>
            {{Form::close()}}
        </div>
        <div id="terms-of-user" class="lightbox generic-lightbox text-left">
            <span class="lighbox-heading">Privacy <span>Policy</span></span>
            <p>This Privacy policy is subject to the terms of the Site Policy (User agreement) of nugree.com. This policy is effective from the date and time a user registers with nugree.com by filling up the Registration form and accepting the terms and conditions laid out in the Site Policy.</p>
            <p>In order to provide a personalized browsing experience, nugree.com may collect personal information from you. Additionally our website may require you to complete a registration form or seek some information from you. When you let us have your preferences, we will be able to deliver or allow you to access the most relevant information that meets your end.</p>
            <p>To extend this personalized experience nugree.com may track the IP address of a user's computer and save certain information on your system in the form of cookies. A user has the option of accepting or declining the cookies of this website by changing the settings of your browser.</p>
            <p>The personal information provided by the users to nugree.com will not be provided to third parties without previous consent of the user concerned. Information of a general nature may however be revealed to external parties</p>
            <p>Every effort will be made to keep the information provided by users in a safe manner, the information will be displayed on the website will be done so only after obtaining consent from the users. Any user browsing the site generally is not required to disclose his identity or provide any information about him/her, it is only at the time of registration you will be required to furnish the details in the registration form</p>
            <p>A full user always has the option of not providing the information which is not mandatory. You are solely responsible for maintaining confidentiality of the User password and user identification and all activities and transmission performed by the User through his user identification and shall be solely responsible for carrying out any online or off-line transaction involving credit cards / debit cards or such other forms of instruments or documents for making such transactions.</p>
            <p>You agree that nugree.com may use personal information about you to improve its marketing and promotional efforts, to analyze site usage, improve the Site's content and product offerings, and customize the Site's content, layout, and services. These uses improve the Site and better tailor it to meet your needs, so as to provide you with a smooth, efficient, safe and customized experience while using the Site.</p>
            <p>You agree that nugree.com may use your personal information to contact you and deliver information to you that, in some cases, are targeted to your interests, such as targeted banner advertisements, administrative notices, product offerings, and communications relevant to your use of the Site. By accepting the User Agreement and Privacy Policy, you expressly agree to receive this information. If you do not wish to receive these communications, we encourage you to opt out of the receipt of certain communications in your profile. You may make changes to your profile at any time. It is the belief of nugree.com that privacy of a person can be best guaranteed by working in conjunction with the Law enforcement authorities.</p>
            <p>We may collect your personal data when you use this Site or our services. The term "use" includes:</p>
            <p>(a) Uploading your Content;</p>
            <p>(b) Making submissions/posts in user forums;</p>
            <p>(c) Undertaking transactions on or via this Site;</p>
            <p>(d) Accessing or browsing the Site;</p>
            <p>(e) Communicating with us via email or signing up for newsletters</p>
            <p>(f) Completing online forms</p>
            <p>(g) Calling us or sending us an enquiry (including via one of the online property portal websites).</p>
            <p>We may also collect your personal data from publicly available information such as information on third party websites, from our business partners who have your consent to pass it on or who are authorized by you to authenticate or identify you to us or enable you to sign in to our Site using their credentials</p>
            <p>We may also collect your personal data when we monitor and record email and telephone communications with you or between you and others who are using our systems or those of our agents acting on our behalf.</p>
            <p>We may collect all or some of the following personal data from or about you:</p>
            <p>(a) Your name and title and gender and date of birth;</p>
            <p>(b) Your company name or affiliation;</p>
            <p>(c) Your contact information including phone/mobile number/fax and email address;</p>
            <p>(d) Other demographic information including your home or other addresses and postcode;</p>
            <p>(e) Your communication and purchase preferences and interests;</p>
            <p>(f) Where you have submitted/posted your Content, your submissions and posts;</p>
            <p>(g) Where you have registered with us, your user name and password.</p>
        </div>
        <div id="requirement" class="lightbox generic-lightbox">
            <span class="lighbox-heading">Feed<span>back</span></span>
            {{Form::open(array('url'=>'user/requirement','method'=>'POST','class'=>'inquiry-email-form'))}}
            <div class="field-holder">
                <label for="name">Name</label>

                <div class="input-holder"><input type="text" id="name" name="name"></div>
            </div>
            <div class="field-holder">
                <label for="email">Email</label>

                <div class="input-holder"><input type="email" id="email" name="email" required></div>
            </div>
            <div class="field-holder">
                <label for="phone">phone</label>

                <div class="input-holder"><input type="tel" id="phone" name="phone" required></div>
            </div>
            <div class="field-holder">
                <label for="subject">subject</label>

                <div class="input-holder"><input type="text" id="subject" name="subject">
                </div>
            </div>
            <div class="field-holder">
                <label for="message">Requirement</label>

                <div class="input-holder"><textarea id="message" name="requirement" required></textarea>
                    <p>By submitting this form I agree to <a href="#terms-of-user" class="termsOfUse lightbox">Terms of Use</a></p>
                </div>
            </div>
            <button type="submit">SEND</button>
            {{Form::close()}}
        </div>
    </div>

    </div>
@if(Route::getCurrentRoute()->getPath() =='/')
    <div class="weAreWorking">
        <p>We are working on it, and we will appreciate your <a href="#feedback" class="lightbox">FEEDBACK</a></p>
        <a class="btn-close-working got-it" >Got it.</a>
        <a class="btn-close-working close"><span class="icon-cross"></span></a>
    </div>
@endif
<nav id="nav">
    <a class="navigation-toggler close"><span class="icon-cross"></span></a>
    <form class="searchByID hidden">
        <input type="search" placeholder="Search by ID">
        <button type="submit"><span class="icon-search"></span></button>
    </form>
    <ul class="main-navigation text-upparcase">
        <li class="">
            <a href="{{URL::to('/')}}">HOME</a>
        </li>
        <li>
            <a href="{{URL::to('/')}}/search">Properties</a>
        </li>
        <li>
            <a href="{{URL::to('agents')}}">AGENTS</a>
        </li>
        <li>
            <a href="{{(Route::getCurrentRoute()->getPath() !='/')? url('/').'#about-us':'#about-us'}}" class="{{(Route::getCurrentRoute()->getPath() !='/')? '':'scroll'}}">ABOUT</a>
        </li>
        <li>
            <a href="{{(Route::getCurrentRoute()->getPath() !='/')? url('/').'#contact-us':'#contact-us'}}" class="{{(Route::getCurrentRoute()->getPath() !='/')? '':'scroll'}}">CONTACT</a>
        </li>
    </ul>
    <div class="mobile-content text-center">
        <ul class="social-icons">
            <li><a target="_blank" href="https://www.facebook.com/property42pk-1562646287317094/"><span class="icon-facebook"></span></a></li>
            <li><a target="_blank" href="https://plus.google.com/115605703040474791286"><span class="icon-google-plus-symbol"></span></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/in/propertyfortytwo-pk-275899124"><span class="icon-linkedin"></span></a></li>
            <li><a target="_blank" href="https://twitter.com/Property42_pk"><span class="icon-twitter"></span></a></li>
            <li><a target="_blank" href="https://www.instagram.com/property42/"><span class="icon-instagram"></span></a></li>
        </ul>
        <span class="copyright">Copyright, <a href="#">nugree.com</a></span>
    </div>
</nav>
<div class="nav-blur-area">
    <div class="logo-holder"><img src="{{url('/')}}/web-apps/frontend/v2/images/logo.png" alt="Property42"></div>
    <ul class="bottom-links">
        <li><a href="#">www.nugree.com</a></li>
        <li><a class="mail" href="mailto:&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#112;&#107;">&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#112;&#107;</li>
    </ul>
</div>
<script type="text/javascript" src="{{url('/')}}/assets/js/helper.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/js/env.js"></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/fixed-block.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/smooth-scroll.js" type="text/javascript" defer></script>

    <script src="{{url('/')}}/web-apps/frontend/v2/js/property-filter.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/select2-min.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.carousel.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.slideshow.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/placeholder.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/lightBox.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/jquery-main.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/registration.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/star-rating.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/property_detail.js" type="text/javascript"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>
