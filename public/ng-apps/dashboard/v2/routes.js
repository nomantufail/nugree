/**
 * Created by noman_2 on 12/8/2015.
 */
var appVersion = "v2";
var appPath = domain+"ng-apps/dashboard/"+appVersion;
var views = appPath+"/views";
var app = angular.module('dashboard');
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/home/properties/all");

    // Now set up the states
    $stateProvider
        .state('home', {
            url: "/home",
            templateUrl: views+"/home.html",
            controller: "HomeController",
            auth: true,

            resolve: {
                resources : function ($ResourceLoader, $rootScope) {
                    if($ResourceLoader.needsLoading())
                    {
                        return $ResourceLoader.loadAll();
                    }
                }
            }
        })
        .state('home.profile', {
            url: "/profile",
            templateUrl: views+"/profile.html",
            controller: "UserProfileController",
            auth: true,
            resolve: {
                user : function (resources, $rootScope, $AuthService, $http, $location, $state) {
                    $rootScope.loading_content_class = '';
                    return $rootScope.authUser;
                }
            }
        })
        .state('home.change-password', {
            url: "/change-password",
            templateUrl: views+"/change-password.html",
            controller: "ChangePasswordController",
            auth: true,
            resolve: {
                user : function (resources, $rootScope, $AuthService, $http, $location, $state) {
                    $rootScope.loading_content_class = '';
                    return $rootScope.authUser;
                }
            }
        })
        .state('home.properties', {
            url: "/properties",
            templateUrl: views+"/properties/home.html",
            auth: true
        })
        .state('home.properties.favourites', {
            url: "/favourites?page&limit",
            templateUrl: views+"/properties/favourites.html",
            controller: 'FavouritePropertiesController',
            auth: true,
            resolve: {
                properties : function (resources, $stateParams, $ResourceLoader, $rootScope, $AuthService, $http, $CustomHttpService, $location, $state) {
                    page = (isNaN($stateParams.page))?1:$stateParams.page;
                    limit = (isNaN($stateParams.limit))?20:$stateParams.limit;
                    limit = (limit > 500)?500:limit;
                    var start = (limit * parseInt(page)) - limit;
                    return $CustomHttpService.$http('GET', apiPath+'properties/favs', {
                        userId: $rootScope.authUser.id,
                        start: start, limit: limit
                    }).then(function successCallback(response) {
                        console.log(response);
                        return response.data.data;
                    }, function errorCallback(response) {
                        $rootScope.$broadcast('error-response-received',{status:response.status});
                        return undefined;
                    });
                }
            }
        })

        .state('home.properties.add', {
            url: "/add",
            templateUrl: views+"/properties/addPropertyForm.html",
            controller: "AddPropertyController",
            auth: true
        })

        .state('home.properties.edit', {
            url: "/edit/{propertyId}",
            templateUrl: views+"/properties/editPropertyForm.html",
            controller: 'EditPropertyController',
            auth: true,
            resolve: {
                property : function (resources,$stateParams, $ResourceLoader, $rootScope, $AuthService, $http, $location, $state) {
                    return $http({
                        method: 'GET',
                        url: apiPath+'user/properties',
                        params: {property_id: $stateParams.propertyId},
                        headers: {
                            Authorization:$AuthService.getAppToken()
                        }
                    }).then(function successCallback(response) {
                        return response.data.data.properties[0];
                    }, function errorCallback(response) {
                        $rootScope.$broadcast('error-response-received',{status:response.status});
                        return undefined;
                    });
                }
            }
        })
        .state('home.properties.all', {
            url: "/all?status&page&limit",
            templateUrl: views+"/properties/list.html",
            controller: "ListPropertiesController",
            auth: true,
            resolve: {
                data : function (resources, $stateParams, $ResourceLoader, $rootScope, $AuthService, $http, $CustomHttpService, $location, $state) {
                        page = (isNaN($stateParams.page))?1:$stateParams.page;
                        limit = (isNaN($stateParams.limit))?20:$stateParams.limit;
                        limit = (limit > 500)?500:limit;
                    status = (isNaN($stateParams.status))?5:$stateParams.status;
                    var start = (limit * parseInt(page)) - limit;
                    params = {
                        owner_id: $rootScope.authUser.id,
                        purpose_id: null,
                        start: start, limit: limit, status_id: status
                    };
                    return $CustomHttpService.$http('GET', apiPath+'user/properties', params)
                        .then(function successCallback(response) {
                            var data = angular.copy(response.data.data);
                            data.searchPropertiesParams = params;
                            return data;
                    }, function errorCallback(response) {
                        $rootScope.$broadcast('error-response-received',{status:response.status});
                        return undefined;
                    });
                }
            }
        })
        .state('home.properties.for-sale', {
            url: "/for-sale?status&page&limit",
            templateUrl: views+"/properties/list.html",
            controller: "ListPropertiesController",
            auth: true,
            resolve: {
                data : function (resources, $stateParams, $ResourceLoader, $rootScope, $AuthService, $http, $CustomHttpService, $location, $state) {
                    page = (isNaN($stateParams.page))?1:$stateParams.page;
                    limit = (isNaN($stateParams.limit))?20:$stateParams.limit;
                    limit = (limit > 500)?500:limit;
                    status = (isNaN($stateParams.status))?5:$stateParams.status;
                    var start = (limit * parseInt(page)) - limit;
                    params = {
                        owner_id: $rootScope.authUser.id,
                        purpose_id: 1,
                        start: start, limit: limit, status_id: status
                    };
                    return $CustomHttpService.$http('GET', apiPath+'user/properties', params)
                    .then(function successCallback(response) {
                            var data = angular.copy(response.data.data);
                            data.searchPropertiesParams = params;
                            return data;
                    }, function errorCallback(response) {
                        $rootScope.$broadcast('error-response-received',{status:response.status});
                        return undefined;
                    });
                }
            }
        })
        .state('home.properties.for-rent', {
            url: "/for-rent?status&page&limit",
            templateUrl: views+"/properties/list.html",
            controller: "ListPropertiesController",
            auth: true,
            resolve: {
                data : function (resources, $stateParams, $ResourceLoader, $rootScope, $AuthService, $http, $CustomHttpService, $location, $state) {
                    page = (isNaN($stateParams.page))?1:$stateParams.page;
                    limit = (isNaN($stateParams.limit))?20:$stateParams.limit;
                    limit = (limit > 500)?500:limit;
                    status = (isNaN($stateParams.status))?5:$stateParams.status;
                    var start = (limit * parseInt(page)) - limit;
                    params = {
                        owner_id: $rootScope.authUser.id,
                        purpose_id: 2,
                        start: start, limit: limit, status_id: status
                    };
                    return $CustomHttpService.$http('GET', apiPath+'user/properties', params)
                        .then(function successCallback(response) {
                            var data = angular.copy(response.data.data);
                            data.searchPropertiesParams = params;
                            return data;
                    }, function errorCallback(response) {
                        $rootScope.$broadcast('error-response-received',{status:response.status});
                        return undefined;
                    });
                }
            }
        })
});


