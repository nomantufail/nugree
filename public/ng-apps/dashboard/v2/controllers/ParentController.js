/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("ParentController",["$scope", "$AuthService", "$rootScope", function ($scope, $AuthService, $rootScope) {
    var app = {
        title: "Property42 Dashboard",
        client: ""
    };
    $scope.app = app;

    $scope.logout = function () {
        $AuthService.setAppToken(null);
        window.location.href = $rootScope.domain+'logout';
    }
}]);