<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="google-site-verification" content="uZU-sY5fbKrq9ABTZxjUntC-Zsc5sSd_xD9U5DkLnXs" />
    <?php
    $pageName = (Request::segment(1) == null)?'/':Request::segment(1);
    $meta = (new \App\Providers\AppServiceProvider())->getMeta($pageName);
    ?>
    <?php
    if(isset($meta) && $meta !=null && $meta !="")
    {
        ?>
        <title><?php echo $meta->title?> | Nugree</title>
        <meta name="description" content="<?php echo $meta->description ?>">
        <meta name="keywords" content="<?php echo $meta->keyword ?>" />
    <?php }?>
    <?php
    if($pageName == 'city' || $pageName == 'location'){
    if(isset($response['data']['extraMeta']) && $response['data']['extraMeta'] !='null' && $response['data']['extraMeta'] !="")
        {
            ?>
            <title><?php echo $response['data']['extraMeta']->title?> | Nugree</title>
            <meta name="description" content="<?php echo $response['data']['extraMeta']->description ?>">
            <meta name="keywords" content="<?php echo $response['data']['extraMeta']->keyword ?>" />
    <?php }}?>
    <?php  if($pageName == 'agent') {
            if(isset($response['data']['agent']) && $response['data']['agent'] !='null' && $response['data']['agent'] !="")
            { ?>

        <title><?php if(isset($response['data']['agent'])){ echo $response['data']['agent']->agencies[0]->name;} ?> | Nugree</title>
        <meta name="description" content="<?php if(isset($response['data']['agent']->agencies[0]->description)){ echo $response['data']['agent']->agencies[0]->description;}  ?>">
    <?php }}?>
    <?php  if($pageName == 'property') {
        if(isset($response['data']['extraMeta']) && $response['data']['extraMeta'] !='null' && $response['data']['extraMeta'] !="")
        { ?>

            <title><?php if(isset($response['data']['extraMeta'])){ echo $response['data']['extraMeta']->slug;} ?> | Nugree</title>
            <meta name="description" content="<?php if(isset($response['data']['extraMeta'])){ echo $response['data']['extraMeta']->description;}  ?>">
        <?php }}?>
    <meta name="google-site-verification" content="uZU-sY5fbKrq9ABTZxjUntC-Zsc5sSd_xD9U5DkLnXs" />
    <link media="all" rel="stylesheet" href="<?=url('/')?>/web-apps/frontend/assets/css/main.css">
    <link rel="icon" type="image/png" href="<?=url('/')?>/web-apps/frontend/assets/images/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?=url('/')?>/web-apps/frontend/assets/images/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="<?=url('/')?>/web-apps/frontend/assets/images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?=url('/')?>/web-apps/frontend/assets/images/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?=url('/')?>/web-apps/frontend/assets/images/favicon-16x16.png" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,600,700" rel="stylesheet">
    <script type="text/javascript" src="<?=url('/')?>/assets/js/env.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">window.jQuery || document.write('<script src="<?=url('/')?>/web-apps/frontend/assets/js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="<?=url('/')?>/assets/js/select2.full.js" type="text/javascript"></script>
    <script src="https://use.fontawesome.com/fbabf169f3.js"></script>
<!--    ----------------------------------  Social Media------------------------>
    <link rel="opengraph" href="facebookexternalhit/1.1"/>
   <?php
   if(isset($response['data']['news'])){  ?>
    <meta property="og:url"           content="<?= (isset($response['data']['news']))?"$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]":"" ?>" />
    <meta property="og:type"          content="nugree.com" />
    <meta property="og:title"         content="<?= (isset($response['data']['news']->title))?$response['data']['news']->title:"" ?>" />
    <meta property="og:description"   content="<?= (isset($response['data']['news']->description))?$response['data']['news']->description:"" ?>" />
    <meta property="og:image"         content="<?= (isset($response['data']['news']->images[0]->image))?url('/').'/'.$response['data']['news']->images[0]->image:"" ?>" />
    <?php  }?>
</head>
<body class="fixed-ui-mob-full">
<div id="wrapper">
    <header id="header">
        <a class="nav-opener navigation-toggler"><span></span></a>
        <div class="logo"><a href="<?=url('/')?>"><img src="<?=url('/')?>/web-apps/frontend/assets/images/logo.png" alt="nugree.com"></a></div>
        <div class="right-area">
            <a class="searchOpener"><span class="icon-search"></span></a>
            <?= Form::open(array('url' => 'property','method' => 'GET','class'=>'searchById')) ?>
            <input type="number" placeholder="Search by ID" name="propertyId" value="<?=(isset($response['data']['propertyId']))?$response['data']['propertyId']:""?>">
            <button type="submit"><span class="icon-search"></span></button>
            <?=Form::close()?>

            <ul class="customLinks">
                <?php if(!isset($_SESSION['authUser'])){ ?>
                <li class="login-reg">
                    <a href="<?= URL::to('/login') ?>"> Login / Register</a>
                 </li>

                <?php }else{ ?>
                <li class="login-reg">
                    <a href="#"><?=str_limit($_SESSION['authUser']->fName.' '.$_SESSION['authUser']->lName,13)?></a>
                    <ul class="dropDown">
                        <li><a href="<?=URL::to('dashboard#/home/profile')?>">my profile</a></li>
                        <li><a href="<?=URL::to('dashboard#/home/properties/all')?>">my listing</a></li>
                        <li><a href="<?=URL::to('/logout')?>">logout</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="wanted-list"><a href="<?= URL::to('wanted-properties') ?>">Wanted Property <img src="<?= url('/') . "/assets/imgs/ico03.png" ?>"></a></li>
                <li><a href="<?= URL::to('add-property') ?>" class="fixed-ui-mob"><span class="icon-plus-square"></span> List property</a></li>
            </ul>
        </div>
    </header>
    <main id="main" role="main">
        <div class="page-holder">