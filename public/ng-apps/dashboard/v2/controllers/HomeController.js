/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("HomeController",["resources", "$scope", "$rootScope", function (resources, $scope, $rootScope) {
    var contentHeader = {
        title: $rootScope.html_title
    };
    $rootScope.resources = resources.data.data.resources;
    $rootScope.authUser = resources.data.data.authUser;
    $scope.contentHeader = contentHeader;
}]);