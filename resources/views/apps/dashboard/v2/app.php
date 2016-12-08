<!DOCTYPE html>
<html ng-app="dashboard">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/css/main.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/css/select2.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/css/addPropertyNgSelect.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/css/selectize.default.css">
    <title>nugree.com - Dashboard</title>
    <link rel="icon" type="image/png" href="images/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="images/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="images/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,300,500,600,700,800,400italic' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?= url('/') ?>/javascripts/ui-select/select.min.css">

    <!-- Angularjs Libs -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="<?= url('/') ?>/assets/js/helper.js"></script>
    <script src="<?= url('/') ?>/assets/js/env.js"></script>
    <script src="<?= url('/') ?>/javascripts/firebase.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular/angular.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular-sanitize.js"></script>
    <script src="<?= url('/') ?>/javascripts/ui-select/select.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angularfire.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/ng-file-upload/ng-file-upload-all.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular-route/angular-route.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/ui-router/angular-ui-router.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/checklist-model.js"></script>

    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/models/Model.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/app.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/filters/filters.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/directives/appDirectives.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/AuthService.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/CustomHttpService.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/ErrorResponseHandler.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/RouteHelper.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/services/ResourceLoader.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ParentController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/LoginController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/HomeController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ContentContainerController.js"></script>
    <!--        Custoemrs Controllers       -->
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/property/AddPropertyController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/property/ListPropertiesController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/property/FavouritePropertiesController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/property/EditPropertyController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/user/UserProfileController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/user/ChangePasswordController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/SidebarController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/FooterController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/FeedbackController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/ContentHeaderController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/HomeController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/controllers/HeaderController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/routes.js"></script>
</head>
<body class="sideBar-active  {{loading_resources_class}}">
<div class="page-loader">
    <div class="page-loader-holder">
        <img src="<?= \App\Libs\Helpers\AppHelper::path('dashboard', $response['version']) ?>/assets/images/loader.gif" alt="nugree.com loading">
    </div>
</div>

<div class="" ng-controller="ParentController">
    <ui-view></ui-view>
</div>


<!-- include jQuery library -->
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/jquery-1.11.2.min.js" defer></script>
<!-- include custom JavaScript -->
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/helper.js" defer></script>
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/add-propertyFrom.js" defer></script>
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/dashboard.js" defer></script>
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/jquery.main.js" defer></script>
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/lightbox.js" defer></script>
<!-- include custom JavaScript -->
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/placeholder.js" defer></script>
<script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('dashboard', $response['version']) ?>/js/jquery-main.js" defer></script>
</body>
</html>