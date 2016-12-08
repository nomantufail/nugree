/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("UserProfileController",["user", "$scope", "$rootScope", "$CustomHttpService", "$http", "$state", "$AuthService", "Upload", "$window", function (user, $scope, $rootScope, $CustomHttpService, $http, $state, $AuthService, Upload, $window) {

    $scope.idForAgentBroker = 3;
    $scope.html_title = "Nugree | My Profile";
    $scope.user = user;
    $scope.companyLogo = '';
    $scope.userIsAgent = false;
    $scope.userWasAgent = false;
    $scope.profileUpdated = false;
    $scope.userUpdating = false;
    $scope.selectedLocations = [];
    console.log($scope.user);
    $scope.cityId = ($scope.user.agencies[0] === undefined)?"":$scope.user.agencies[0].locations[0].city.id+"";
    $scope.locations = {
        selectedLocations: [],
        searchedLocations: []
    };
    $scope.searchLocations = function ($select) {
        $scope.locations.searchedLocations = [];
        var client = algoliasearch(ALGOLIA_APPLICATION_ID, ALGOLIA_API_KEY);
        var index = client.initIndex(ALGOLIA_INDEX);
        index.search($select.search, {
            filters:'city_id='+$scope.cityId
        }).then(function (content) {
            $scope.locations.searchedLocations = content.hits;
        });

        //if($select.search.length < 2){
        //    $scope.locations.searchedLocations = [];
        //    return;
        //}
        //return $http.get(apiPath+'locations/search', {
        //    params: {
        //        keyword: $select.search,
        //        cityId: $scope.cityId
        //    }
        //}).then(function(response){
        //    $scope.locations.searchedLocations = response.data.data.locations;
        //});
    };

    var getSelectedLocations = function () {
        var locations = [];
        angular.forEach($scope.user.agencies[0].locations, function (location, key) {
            locations.push(location.location);
        });
        return locations;
    };

    $scope.deleteSelectedLocation = function (locationId) {
        delLocationIndex = $scope.form.data.locations.indexOf(LocationId);
        if (delLocationIndex > -1) {
            $scope.form.data.locations.splice(delLocationIndex, 1);
        }
    };
    var getUserRolesIds = function () {
        var ids = [];
        angular.forEach($scope.user.roles, function (role, key) {
            ids.push(role.id);
        });
        return ids;
    };
    var getSelectedLocationIds = function () {
        var ids = [];
        angular.forEach($scope.locations.selectedLocations, function (location, key) {
            ids.push(location.id);
        });
        return ids;
    };

    $scope.form = {
        data : {
            userId: $scope.user.id,
            userRoles: [],
            locations: []
        }
    };

    $scope.cancelLogo = function () {
        $scope.form.data.companyLogo = null;
        $scope.form.data.companyLogoDeleted = true;
    };

    $scope.updateUser = function () {
        $scope.profileUpdated = false;
        $scope.errors = {};
        $scope.userUpdating = true;
        $scope.form.data.locations = getSelectedLocationIds();
        console.log($scope.form.data);
        var upload = Upload.upload({
            url: apiPath+'user/update',
            data: $scope.form.data,
            headers:{
                Authorization: $AuthService.getAppToken()
            }
        });
        upload.then(function (response) {
            $scope.errors = {};
            $scope.userUpdating = false;
            $window.scrollTo(0, 0);
            $scope.profileUpdated = true;
            $scope.formSubmitStatus = '';
            $scope.user = response.data.data.user;
            $scope.form.data = mapUsrOnScope($scope.user);
            $rootScope.authUser = angular.copy(response.data.data.user);
        }, function (response) {
            $scope.profileUpdated = false;
            $scope.userUpdating = false;
            $scope.errors = response.data.error.messages;
            $rootScope.$broadcast('error-response-received',{status:response.status});
            $window.scrollTo(0, 0);
        }, function (evt) {
            $scope.profileUpdated = false;
            $window.scrollTo(0, 0);
        });
    };
    $scope.$watch('form.data.userRoles.length', function (totalRoles) {
        var isAgent = false;
        angular.forEach($scope.form.data.userRoles, function (role, key) {
            if(role == $scope.idForAgentBroker){
                isAgent = true;
            }
        });
        if(!$scope.userWasAgent)
            $scope.userIsAgent = isAgent;
    });
    $scope.$watch('userIsAgent', function (userIsAgent) {
        if(userIsAgent){
            var index = $scope.form.data.userRoles.indexOf($scope.idForAgentBroker+"");
            if (index <= -1) {
                $scope.form.data.userRoles.push($scope.idForAgentBroker);
            }
        }else{
            var index = $scope.form.data.userRoles.indexOf($scope.idForAgentBroker);
            if (index > -1) {
                $scope.form.data.userRoles.splice(index, 1);
            }
        }
    });
    var computeUserWasAgent = function () {
        var wasAgent = false;
        angular.forEach($scope.form.data.userRoles, function (role, key) {
            if(role == $scope.idForAgentBroker){
                wasAgent = true;
            }
        });
        return wasAgent;
    };

    var mapUsrOnScope = function (user) {
        var data1 = {
            userId: user.id,
            fName : user.fName,
            lName : user.lName,
            email : user.email,
            password : "",
            address : user.address,
            phone : user.phone,
            cell : user.mobile,
            fax : user.fax,
            zipCode : user.zipCode,
            userRoles : getUserRolesIds(),
            companyLogoDeleted: false
        };
        if(user.agencies.length > 0){
            var agency = user.agencies[0];
            data1.agencyId = agency.id;
            data1.agencyName = agency.name;
            if(agency.logo != '')
                data1.companyLogo = domain+'temp/'+agency.logo;
            else
                data1.companyLogo = '';
            data1.agencyDescription = agency.description;
            data1.locations = getSelectedLocationIds();
            data1.companyPhone = agency.phone;
            data1.companyMobile = agency.mobile;
            data1.companyAddress = agency.address;
            data1.companyEmail = agency.email;
        }

        return data1;

    };

    var setCompanyLogo = function () {
        $scope.companyLogo = $rootScope.domain+'temp/'+user.agencies[0].logo
    };
    $scope.initialize = function () {
        $scope.form.data = mapUsrOnScope($scope.user);
        $scope.userWasAgent = computeUserWasAgent();
        $scope.userIsAgent = $scope.userWasAgent;
        $scope.locations.selectedLocations = getSelectedLocations();
        if($scope.userIsAgent){
            setCompanyLogo();
        }
        $('.registration-form').find('.role-listing').hide();
    };
}]);