/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("ParentController",["$scope",function ($scope) {
    var app = {
        title: "Inventory System",
        client: "Malik Petroleum"
    };
    $scope.app = app;
}]);