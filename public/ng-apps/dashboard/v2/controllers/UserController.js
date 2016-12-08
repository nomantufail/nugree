/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("UserController",["$scope", "$rootScope", "$AuthService", "$location",
    function ($scope, $rootScope, $AuthService, $location) {
    $scope.user = {
        name: "Noman Tufail",
        role: "Admin, Editor"
    };

    $scope.logout = function () {
        $AuthService.logout();
        $location.path('/login');
    }
}]);