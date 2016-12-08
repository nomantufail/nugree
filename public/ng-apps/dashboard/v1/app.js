/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard',[
    'ngRoute', 'ui.router','ui.select',
    'firebase', 'ngFileUpload', 'ngSanitize',
    'checklist-model'
]);


app.filter('filterByCountParam', [function () {
    return function (counts, purpose, status) {
        var totalLikes = 0;
        if(counts == undefined)
            return totalLikes;
        if(purpose == null)
            purpose = undefined;
        if(status == null)
            status = undefined;
        if(purpose != undefined || status != undefined)
        {
            if(purpose != undefined && status != undefined){
                totalLikes = parseInt(counts[purpose][status]);
            }else if(purpose != undefined && status === undefined){
                angular.forEach(counts[purpose], function (value, key) {
                    totalLikes += parseInt(value);
                });
            } else if(purpose === undefined && status != undefined){
                angular.forEach(counts, function (tempPurpose, pKey) {
                    totalLikes += parseInt(counts[pKey][status])
                });
            }
        }
        else
        {
            angular.forEach(counts, function (tempPurpose, pKey) {
                angular.forEach(tempPurpose, function (tempStatus, sKey) {
                    totalLikes += parseInt(tempStatus);
                });
            });
        }
        return totalLikes;
    };
}]);

app.filter('purposeDisplayName', [function () {
    return function (purposes, purposeId) {
        var purposeDesplayName = '';
        angular.forEach(purposes, function (purpose, key) {
            if(parseInt(purpose.id) == parseInt(purposeId)){
                purposeDesplayName = purpose.displayName;
            }
        });
        return purposeDesplayName;
    };
}]);

app.run(function($rootScope, $location, $AuthService, $state, $ErrorResponseHandler) {
    $rootScope.domain = domain;
    $rootScope.AUTH_TOKEN = '';
    $rootScope.AUTH_USER = null;
    $rootScope.APP_STATUS = 'ok';
    $rootScope.html_title = "Property42 Dashboard";
    $rootScope.propertiesCounts = {};
    $rootScope.favouritesCount = 0;
    $rootScope.authUser = null;
    $rootScope.testUser = null;
    $rootScope.resources = null;
    $rootScope.resourceLoading = false;
    $rootScope.please_wait_class = '';
    $rootScope.loading_resources_class = '';
    $rootScope.loading_content_class = '';
    $rootScope.defaultSearchPropertiesParams = {
        owner_id: null,
        purpose_id: null,
        status_id: null,
        limit: '20',
        start: '0'
    };
    $rootScope.searchPropertiesParams = $rootScope.defaultSearchPropertiesParams;
    $rootScope.activeLink = '';

    $rootScope.propertiesCounts = {};
    $rootScope.$on( "$stateChangeStart", function(event, next, current) {
        if(next.auth == true && $AuthService.getAppToken() == null){
            alert('session expired! please login again.');
            window.location.href = domain+'logout';
        }else if($rootScope.authUser != null && $AuthService.getAppToken() == null){
            alert('session expired! please login again.');
            window.location.href = domain+'logout';
        }
        $rootScope.activeLink = next.name;
        $rootScope.loading_content_class = 'loading-content';
        /*
        * Description:
        * if the next route is for authenticated users and
        * user is not authenticated yet then we should redirect
        * him to login page.
        * */
        /*if(next.auth == true && $AuthService.getAppToken() == null){
            $location.path($state.href('login').substring(1));
        }*/

        /*
        * Description:
        * if the next route is login and user is already logged in
        * then whe should take him back to his profile.
        * */
        if(next.name == "login" && $AuthService.getAppToken() != null){
            $location.path($state.href('home').substring(1));
        }
    });

    $rootScope.$on('error-response-received', function (event, args) {
        $ErrorResponseHandler.handle(args.status);
    });
});
