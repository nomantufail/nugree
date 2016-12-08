/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("ShowCustomersController",["$scope", "$rootScope", "$http", "$firebaseArray",
    function ($scope, $rootScope, $http, $firebaseArray) {

    $scope.contentHeader.title = "All Customers";
    $scope.customers = $rootScope.CUSTOMERS;

}]);