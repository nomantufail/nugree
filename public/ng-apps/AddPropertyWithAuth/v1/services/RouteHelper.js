/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module(appName);
app.factory("$RouteHelper", function ($rootScope, $http, $state) {
    return {
        getStatePath: function ($st) {
            return $state.href($st).substring(1);
        },
        getAuthenticatedLandingUri: function () {
           return this.getStatePath('home.customers.all');
        },
        getLoginUri: function () {
            return this.getStatePath('login');
        }
    }
});