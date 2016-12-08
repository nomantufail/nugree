/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("LoginController",["$RouteHelper", "$rootScope", "$scope",
    "$AuthService", "$location", "$state", "$http", "$firebaseArray", "$ResourceLoader",
    function ($RouteHelper, $rootScope, $scope, $AuthService, $location, $state, $http, $firebaseArray, $ResourceLoader) {

        //var ref = new Firebase("https://blistering-torch-713.firebaseio.com/test1/lies");

        $scope.login = function () {
            $AuthService.authenticate({
                'email':'xyz@gmail.com',
                'password': '123'
            }).then(function (response) {
                if(response.status == 1){

                    $AuthService.setAppToken(response.access_token);
                    $AuthService.setAuthUser(response.data.authUser);

                    $ResourceLoader.loadAll().then(function (response) {
                        if(response == true)
                            $location.path($RouteHelper.getAuthenticatedLandingUri());
                        else
                            console.log('can not redirect. server fucked up!!');
                    });
                }else{
                    console.log(response.error.messages);
                }
            }, function (data) {
                alert('some thing went wrong');
            });
        }
}]);