/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("ChangePasswordController",["$scope", "$rootScope", "$CustomHttpService", "$http", "$state", "$AuthService", function ($scope, $rootScope, $CustomHttpService, $http, $state, $AuthService) {
    $scope.html_title = "Property42 | Change Password";
    $scope.passwordChanged = false;
    $scope.errors = {};
    $scope.form = {
        data : {
            userId: $rootScope.authUser.id,
            existingPassword: '',
            newPassword: ''
        }
    };

    $scope.changePassword = function () {
        $scope.passwordChanged = false;
        $scope.errors = {};
        $rootScope.loading_content_class = 'loading-content';
        $CustomHttpService.$http('POST', apiPath+'user/change-password', $scope.form.data)
            .then(function (response) {
                $scope.passwordChanged = true;
                $scope.errors = {};
                $scope.form.data.existingPassword= '';
                $scope.form.data.newPassword= '';
                $rootScope.loading_content_class = '';
            }, function (response) {
                $rootScope.loading_content_class = '';
                $scope.passwordChanged = false;
                $scope.errors = response.data.error.messages;
                $rootScope.$broadcast('error-response-received',{status:response.status});
            }, function (evt) {

            });
    };

    $scope.initialize = function () { };
}]);