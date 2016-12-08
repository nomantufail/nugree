/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$AuthService", function ($rootScope, $http) {
    return {
        getAppToken: function () {
            return $rootScope.AUTH_TOKEN;
        },
        setAppToken: function ($token) {
            $rootScope.AUTH_TOKEN = $token;
        },

        setAuthUser: function ($user) {
            $rootScope.AUTH_USER = $user;
        },
        getAuthUser: function () {
            return $rootScope.AUTH_USER;
        },

        authenticate: function ($credentials) {
            var promise = $http({
                method: 'POST',
                url: apiPath+'login',
                data:$credentials
            }).then(function successCallback(response) {
                return response.data;
            }, function errorCallback(response) {
                return response.data;
            });

            return promise;
        },

        logout: function () {
            this.setAppToken(null);
        }
    }
});