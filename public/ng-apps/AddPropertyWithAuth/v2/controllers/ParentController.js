/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module(appName);

app.controller("ParentController",["$scope",function ($scope) {
    var app = {
        title: "Property42 Dashboard",
        client: ""
    };
    $scope.app = app;
}]);