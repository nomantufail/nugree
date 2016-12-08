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
</head>
<body class="admin-login">
<span class="lodaing-page">nugree.com</span>
<!-- main container of all the page elements -->
<div id="wrapper">
    <div class="login-Admin">
        {{Form::open(array('url'=>'admin','method'=>'POST','class'=>'admin'))}}
          <strong class="heading-profile">Admin login</strong>
            <div class="input-holder error full-width">
                <label class="icon-envelope" for="email"></label>
                <input type="email" placeholder="Enter Your Email" id="email" name="email" required>
                <span class="border"></span>
                <span class="error-text">This is error</span>
            </div>
            <div class="input-holder error full-width">
                <label class="icon-key" for="pass"></label>
                <input type="password" placeholder="Enter Your Password" id="pass" name="password" required>
                <span class="border"></span>
                <span class="error-text">This is error</span>
            </div>
            <div class="input-holder full-width">
                <button type="submit">Login</button>
            </div>
       {{Form::close()}}
    </div>
</div>
<!-- include jQuery library -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- include custom JavaScript -->
<script type="text/javascript" src="{{url('/')}}/web-apps/admin/js/placeholder.js" defer></script>
<script type="text/javascript" src="{{url('/')}}/web-apps/admin/js/jquery.main.js" defer></script>
</body>
</html>