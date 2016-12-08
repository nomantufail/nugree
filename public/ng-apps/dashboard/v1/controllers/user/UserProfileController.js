/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');

app.controller("UserProfileController",["user", "$scope", "$rootScope", "$CustomHttpService", "$http", "$state", "$AuthService", "Upload", "$window", function (user, $scope, $rootScope, $CustomHttpService, $http, $state, $AuthService, Upload, $window) {
    $scope.idForAgentBroker = 3;
    $scope.html_title = "Property42 | My Profile";
    $scope.user = user;
    $scope.companyLogo = '';
    $scope.userIsAgent = false;
    $scope.userWasAgent = false;
    $scope.profileUpdated = false;
    $scope.searchSocieties = '';

    var getUserRolesIds = function () {
        var ids = [];
        angular.forEach($scope.user.roles, function (role, key) {
            ids.push(role.id);
        });
        return ids;
    };
    var getSocietyIds = function () {
        console.log($scope.user.agencies[0].societies);
        var ids = [];
        angular.forEach($scope.user.agencies[0].societies, function (society, key) {
            ids.push(society.id);
        });
        console.log(ids.length);
        return ids;
    };

    $scope.form = {
        data : {
            userId: $scope.user.id,
            userRoles: []
        }
    };

    $scope.cancelLogo = function () {
        $scope.form.data.companyLogo = null;
        $scope.form.data.companyLogoDeleted = true;
    };

    $scope.updateUser = function () {
        $scope.profileUpdated = false;
        $scope.errors = {};
        $rootScope.loading_content_class = 'loading-content';
        var upload = Upload.upload({
            url: apiPath+'user/update',
            data: $scope.form.data,
            headers:{
                Authorization: $AuthService.getAppToken()
            }
        });

        upload.then(function (response) {
            $scope.errors = {};
            $rootScope.loading_content_class = '';
            $window.scrollTo(0, 0);
            $scope.profileUpdated = true;
            $scope.formSubmitStatus = '';
            $scope.user = response.data.data.user;
            $scope.form.data = mapUsrOnScope($scope.user);
            $rootScope.authUser = angular.copy(response.data.data.user);
        }, function (response) {
            $scope.profileUpdated = false;
            $rootScope.loading_content_class = '';
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
            var index = $scope.form.data.userRoles.indexOf($scope.idForAgentBroker);
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
        var data = {
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
            data.agencyId = agency.id;
            data.agencyName = agency.name;
            if(agency.logo != '')
                data.companyLogo = domain+'temp/'+agency.logo;
            else
                data.companyLogo = '';
            data.agencyDescription = agency.description;
            data.societies = getSocietyIds();
            data.companyPhone = agency.phone;
            data.companyMobile = agency.mobile;
            data.companyAddress = agency.address;
            data.companyEmail = agency.email;
        }

        return data;

    };

    var setCompanyLogo = function () {
        $scope.companyLogo = $rootScope.domain+'temp/'+user.agencies[0].logo
    };
    $scope.initialize = function () {
        $scope.form.data = mapUsrOnScope($scope.user);
        $scope.userWasAgent = computeUserWasAgent();
        $scope.userIsAgent = $scope.userWasAgent;
        if($scope.userIsAgent){
            setCompanyLogo();
        }
        $('.registration-form').find('.role-listing').hide();
    };
}]);