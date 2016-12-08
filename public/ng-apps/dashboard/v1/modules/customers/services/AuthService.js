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

        authenticate: function ($credentials) {
            var promise = $http({
                method: 'GET',
                url: '/auth/login'
            }).then(function successCallback(response) {
                $token = response.data.token;
                return $token;
            }, function errorCallback(response) {
                return null;
            });

            return promise;
        },

        logout: function () {
            this.setAppToken(null);
        }
    }
});