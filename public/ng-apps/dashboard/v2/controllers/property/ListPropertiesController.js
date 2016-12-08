/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.filter('roundup', function () {
    return function (value) {
        if(value > 0)
            return Math.ceil(value);
        else
            return 1;
    };
});
app.controller("ListPropertiesController",["$q", "data", "$CustomHttpService", "$window", "$scope", "$rootScope","$http", "$state", "$AuthService", "$location", function ($q, data, $CustomHttpService, $window, $scope, $rootScope, $http, $state, $AuthService, $location) {
    $scope.html_title = "Property42 | Add Property";
    $scope.currentRoute = $state.current;
    $scope.propertiesPurpose = $state.current.name.split(".")[2];
    $scope.searchPropertiesParams = data.searchPropertiesParams;
    $scope.propertiesLimit = '20';
    $scope.activeStatus = 1;
    $scope.properties = data.properties;
    $scope.deletingPropertyId = 0;
    $scope.restoringPropertyId = 0;
    $scope.deletingProperties = {
        ids: []
    };
    $scope.totalProperties = data.totalProperties;
    $scope.checkAllPropertiesChkbx = false;
    $scope.activePage = 1;
    $scope.fetchingProperties = false;

    $scope.$on('searchPropertiesParamsChanged', function () {
        //$rootScope.loading_content_class = 'loading-content';
        //$scope.getProperties().then(function successCallback(data) {
        //    $scope.properties = data.properties;
        //    $scope.totalProperties = data.totalProperties;
        //    $scope.checkAllPropertiesChkbx = false;
        //    $rootScope.loading_content_class = '';
        //    $window.scrollTo(0,0);
        //}, function errorCallback(response) {
        //
        //});
    });

    $scope.setPropertyStatus = function (status) {
        //$scope.activeStatus = status;
        //$rootScope.searchPropertiesParams.status_id = status;
        //$rootScope.$broadcast('searchPropertiesParamsChanged');
    };

    $scope.$watch('checkAllPropertiesChkbx', function () {
        if($scope.checkAllPropertiesChkbx == true){
            $scope.checkAll();
        }else{
            $scope.unCheckAll();
        }
    });

    $scope.checkAll = function() {
        $scope.deletingProperties.ids = $scope.properties.map(function(item) { return item.id; });
    };
    $scope.unCheckAll = function() {
        $scope.deletingProperties.ids = [];
    };
    $scope.getProperties = function () {
        if($scope.fetchingProperties == true){
            $q(function(resolve, reject) {
                resolve($scope.properties);
            });
        }
        $scope.fetchingProperties = true;
        return $CustomHttpService.$http('GET', apiPath+'user/properties', $rootScope.searchPropertiesParams)
            .then(function successCallback(response) {
                $scope.fetchingProperties = false;
                return response.data.data;
            }, function errorCallback(response) {
                $rootScope.$broadcast('error-response-received',{status:response.status});
                return [];
            });
    };
    var getPropertiesCounts = function () {
        return $CustomHttpService.$http('GET', apiPath+'properties/count',  {
            user_id: $rootScope.authUser.id
        }).then(function successCallback(response) {
            return response.data.data.counts;
        }, function errorCallback(response) {
            $rootScope.$broadcast('error-response-received',{status:response.status});
            return response;
        });
    };

    $scope.filtersChanged = function () {
        $rootScope.$broadcast('searchPropertiesParamsChanged');
    };
    $scope.limitChanged = function () {
        page = (isNaN($state.params.page))? 1: $state.params.page;
        $params = angular.copy($state.params);
        $params.limit = $scope.propertiesLimit;
        $location.path('/home/properties/'+$scope.propertiesPurpose).search($params);
    };
    $scope.deleteProperty = function ($index) {
        if($state.params['status'] == $rootScope.resources.propertyStatusesIds.deleted
            || $state.params['status'] == $rootScope.resources.propertyStatusesIds.expired
            || $state.params['status'] == $rootScope.resources.propertyStatusesIds.rejected
            || $state.params['status'] == $rootScope.resources.propertyStatusesIds.pending
        ){
            if (confirm('Are you sure you want to delete this property permanently?')) {
                forceDelProperty($index);
            }
        }else{
            softDelProperty($index);
        }
    };
    $scope.deleteProperties = function () {
        if($scope.deletingProperties.ids.length < 1)
            return false;

        if($state.params['status'] == $rootScope.resources.propertyStatusesIds.deleted
            || $state.params['status'] == $rootScope.resources.propertyStatusesIds.expired
            || $state.params['status'] == $rootScope.resources.propertyStatusesIds.rejected
            || $state.params['status'] == $rootScope.resources.propertyStatusesIds.pending
        ){
            if (confirm('Are you sure you want to delete selected properties permanently?')) {
                forceDelProperties();
            }
        }else{
            softDelProperties();
        }
    };

    var forceDelProperties = function () {
        $rootScope.loading_content_class = 'loading-content';
        return $CustomHttpService.$http('POST', apiPath+'properties/force_delete', {
            propertyIds: $scope.deletingProperties.ids,
            searchParams: $scope.searchPropertiesParams
        }).then(function successCallback(response) {
            $scope.deletingProperties.ids = [];
            $scope.checkAllPropertiesChkbx = false;
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
            $rootScope.loading_content_class = '';
        }, function errorCallback(response) {
            $rootScope.loading_content_class = 'loading-content';
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };
    var softDelProperties = function () {
        $rootScope.loading_content_class = 'loading-content';
        return $CustomHttpService.$http('POST', apiPath+'properties/delete', {
            propertyIds: $scope.deletingProperties.ids,
            searchParams: $scope.searchPropertiesParams
        }).then(function successCallback(response) {
            $scope.deletingProperties.ids = [];
            $scope.checkAllPropertiesChkbx = false;
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
            $rootScope.loading_content_class = '';
        }, function errorCallback(response) {
            $rootScope.loading_content_class = 'loading-content';
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };
    var softDelProperty = function ($index) {
        $scope.deletingPropertyId = $scope.properties[$index].id;
        return $CustomHttpService.$http('POST', apiPath+'property/delete', {
            propertyId: $scope.properties[$index].id,
            searchParams: $scope.searchPropertiesParams
        }).then(function successCallback(response) {
            $scope.properties.splice($index, 1);
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
            $scope.deletingPropertyId = 0;
        }, function errorCallback(response) {
            $scope.deletingPropertyId = 0;
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };
    var forceDelProperty = function ($index) {
        $scope.deletingPropertyId = $scope.properties[$index].id;
        return $CustomHttpService.$http('POST', apiPath+'property/force_delete', {
            propertyId: $scope.properties[$index].id,
            searchParams: $scope.searchPropertiesParams
        }).then(function successCallback(response) {
            $scope.properties.splice($index, 1);
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            $scope.properties = response.data.data.properties;
            $scope.totalProperties = response.data.data.totalProperties;
            $scope.deletingPropertyId = 0;
        }, function errorCallback(response) {
            $scope.deletingPropertyId = 0;
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };
    $scope.restoreProperty = function ($index) {
        $scope.restoringPropertyId = $scope.properties[$index].id;
        return $CustomHttpService.$http('POST', apiPath+'property/restore', {
            propertyId: $scope.properties[$index].id,
            searchParams: $scope.searchPropertiesParams
        }).then(function successCallback(response) {
            $rootScope.restoringPropertyId = response.data.data.propertiesCounts;
            $scope.properties = response.data.data.properties;
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            $scope.totalProperties = response.data.data.totalProperties;
            $scope.restoringPropertyId = 0;
        }, function errorCallback(response) {
            $scope.restoringPropertyId = 0;
            $rootScope.$broadcast('error-response-received',{status:response.status});
        });
    };

    $scope.setPage = function (page) {
        if(parseInt(page) < 1 || parseInt(page) > Math.ceil($scope.totalProperties/$rootScope.searchPropertiesParams.limit))
            return false;

        var start = ($rootScope.searchPropertiesParams.limit * parseInt(page)) - $rootScope.searchPropertiesParams.limit;
        $rootScope.searchPropertiesParams.start = start;
        $rootScope.$broadcast('searchPropertiesParamsChanged');
        $scope.activePage = page;
    };
    $scope.getPages = function () {
        var pages = [];
        for(var i = 1; i<= $scope.totalProperties/$scope.propertiesLimit; i++){
            pages.push(i);
        }
        return pages;
    };

    $scope.getCurrentPage = function () {
        if($state.params['page'] != undefined){
            return parseInt($state.params['page']);
        }
        return 1;
    };
    $scope.updateQueryString = function (key, value) {
        var params = angular.copy($state.params);
        params[key] = value;
        var paramsStr = "";
        angular.forEach(params, function (value, key) {
            if(value != undefined)
                paramsStr+= key+"="+value+"&"
        });
        return paramsStr.slice(0, -1);
    };
    $scope.initialize = function () {
        $scope.checkAllPropertiesChkbx = false;
        $rootScope.loading_content_class = '';
        getPropertiesCounts().then(function successCallback(counts) {
            $rootScope.propertiesCounts = counts;
        }, function errorCallback(response) {

        });
        if (screen.width < 1024){
            //$('.property-status-links').slideUp();
        }
    };
}]);