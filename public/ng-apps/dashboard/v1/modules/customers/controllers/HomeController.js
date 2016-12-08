/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("HomeController",["$scope", "$rootScope", function ($scope, $rootScope) {
    var contentHeader = {
        title: $rootScope.html_title
    };

    $scope.contentHeader = contentHeader;
}]);