/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module(appName);
app.factory("$ErrorResponseHandler", function ($rootScope, $http, $AuthService) {
    return {
        handle: function (status) {
            switch (status)
            {
                case 401:
                    $AuthService.setAppToken(null);
                    alert('Session Expired! please login again.');
                    window.location.href = domain+'logout';
                    break;
                case 429:
                    alert('Too many requests. please wait for a minute and try again.');
                    break;
                default :
                    break;
            }
        }
    }
});