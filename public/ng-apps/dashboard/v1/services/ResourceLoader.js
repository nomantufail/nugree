/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$ResourceLoader", function ($rootScope, $http, $AuthService) {

    return {
        isLoading: function () {
            return $rootScope.resourceLoading;
        },
        hasLoaded: function () {
            return $rootScope.resources != null;
        },
        needsLoading: function () {
            return (!this.isLoading() && !this.hasLoaded());
        },
        loadAll: function () {
            var headerInfo = {
                Authorization:$AuthService.getAppToken()
            };
            $rootScope.APP_STATUS = 'fetching resources...';
            $rootScope.please_wait_class = 'please-wait';
            $rootScope.resourceLoading = true;
            return promise = $http({
                method: 'GET',
                url: apiPath+'app/dashboard/resources',
                headers: headerInfo
            }).then(function successCallback(response) {
                $rootScope.resources = response.data.data.resources;
                $rootScope.authUser = response.data.data.authUser;
                $rootScope.AUTH_TOKEN = response.data.access_token;
                $rootScope.propertiesCounts = response.data.data.resources.propertiesCounts;
                $rootScope.favouritesCount = response.data.data.resources.favouritesCount;
                $rootScope.resourceLoading = false;
                $rootScope.please_wait_class = '';
                $rootScope.loading_resources_class = '';
                return response;
            }, function errorCallback(response) {
                $rootScope.resourceLoading = false;
                $rootScope.please_wait_class = '';
                return response;
            });
        }
    }
});