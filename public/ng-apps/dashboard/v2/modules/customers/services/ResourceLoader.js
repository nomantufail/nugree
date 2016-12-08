/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$ResourceLoader", function ($rootScope, $http) {
    return {
        loadAll: function () {
            console.log('fetching users...');
            var promise = $http({
                method: 'GET',
                url: '/users'
            }).then(function successCallback(response) {
                $rootScope.USERS = response.data.users;

                console.log('fetching customers...');
                return $http({
                    method: 'GET',
                    url: '/customers'
                });
            }, function errorCallback(response) {
                return false;
            }).then(function (response) {
                $rootScope.CUSTOMERS = response.data.customers;
                console.log('Routing back to home...');
                return true;
            }, function(){});

            return promise;
        }
    }
});