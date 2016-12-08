/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.filter('propsFilter', function() {
    return function(items, props) {
        var out = [];

        if (angular.isArray(items)) {
            var keys = Object.keys(props);

            items.forEach(function(item) {
                var itemMatches = false;

                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    };
});

app.filter('filterBySubType', [function () {
    return function (features, subTypeId) {
        var filtered = [];
        angular.forEach(features, function (feature, key) {
            if(parseInt(feature.assignedSubTypeId) == parseInt(subTypeId)){
                filtered.push(feature);
            }
        });
        return filtered;
    };
}]);

app.controller("AddPropertyController",["$scope", "$rootScope", "$CustomHttpService", "$window","$http", "Upload","$sce", "$AuthService", function ($scope, $rootScope, $CustomHttpService, $window, $http, Upload, $sce, $AuthService) {
    $scope.html_title = "Property42 | Add Property";
    $scope.formSubmitStatus = '';
    $scope.propertySaved = false;
    $scope.types = $rootScope.resources.propertyTypes;
    $scope.subTypes = $rootScope.resources.propertySubTypes;
    $scope.cityId = "";
    $scope.locations = [];
    $scope.subTypeAssignedFeatures = [];
    $scope.highPriorityFeatures = [];
    $scope.features = [];
    $scope.featureSections = [];
    $scope.errors = [];
    $scope.temp = {
        location: {id:0},
        block: {id:0}
    };
    $scope.searchLocations = function ($select) {
        $scope.locations = [];
        if($select.search.length < 2){
            $scope.locations = [];
            return;
        }
        return $http.get(apiPath+'locations/search', {
            params: {
                keyword: $select.search,
                cityId: $scope.cityId
            }
        }).then(function(response){
            $scope.locations = response.data.data.locations;
        });
    };
    $scope.locationChanged = function () {
        $scope.form.data.location = $scope.temp.location.id;
    };

    $scope.form = {
        data : {}
    };
    var mapFormData = function () {
      return {
          propertyPurpose: 0,
          propertyType :0,
          wanted:false,
          propertySubType : 0,
          location: "",
          price: undefined,
          landArea: undefined,
          landUnit: 0,
          propertyTitle: '',
          propertyDescription: '',
          features:{},
          files : {
              mainFile:{title: '', file: null},
              twoFile:{title: '', file: null},
              threeFile:{title: '', file: null},
              fourFile:{title: '', file: null},
              fiveFile:{title: '', file: null},
              sixFile:{title: '', file: null}
          },
          owner: $rootScope.authUser.id+"",
          contactPerson: $rootScope.authUser.fName+" "+$rootScope.authUser.lName,
          phone: $rootScope.authUser.phone,
          cell : $rootScope.authUser.mobile,
          fax: $rootScope.authUser.fax,
          email: $rootScope.authUser.email
      }
    };
    $scope.propertySubTypeChanged = function () {
        var subTypeId = $scope.form.data.propertySubType;
        var highPriorityFeatures = [];
        var subTypeAssignedFeatures = [];
        angular.forEach($rootScope.resources.subTypeAssignedFeatures, function (subTypeFeatures, key) {
            if(subTypeFeatures.subTypeId == subTypeId){
                subTypeAssignedFeatures = subTypeFeatures.features;
                subTypeAssignedFeatures = subTypeAssignedFeatures.sort(function(a,b){
                    return b.features.length - a.features.length;
                });

                angular.forEach(subTypeAssignedFeatures, function (section, key) {
                    angular.forEach(section.features, function (feature, key) {
                        if(feature.priority == 1){
                            highPriorityFeatures.push(feature);
                        }
                    })
                })
            }
        });
        $scope.subTypeAssignedFeatures = subTypeAssignedFeatures;
        $scope.highPriorityFeatures = highPriorityFeatures;
    };
    var nullFile = {title: '', file: null};
    $scope.cancelFile = function (fileNumber) {
        switch (fileNumber)
        {
            case 0:
                $scope.form.data.files.mainFile = nullFile;
                break;
            case 1:
                $scope.form.files.data.files.twoFile = nullFile;
                break;
            case 2:
                $scope.form.files.data.files.threeFile = nullFile;
                break;
            case 3:
                $scope.form.data.files.fourFile = nullFile;
                break;
            case 4:
                $scope.form.files.data.files.fiveFile = nullFile;
                break;
            case 5:
                $scope.form.files.data.files.sixFile = nullFile;
                break;
        }
    };

    var postProcessFormData = function () {
        var features = {};
        angular.forEach($scope.form.data.features, function(value, key) {
            if(value != false){ features[key] = value; }
        });
        $scope.form.data.features = features;
    };
    $scope.submitProperty = function() {
        postProcessFormData();
        $scope.propertySaved = false;
        $scope.errors = {};
        $rootScope.please_wait_class = 'please-wait';
        var upload = Upload.upload({
            url: apiPath+'property',
            data: $scope.form.data,
            headers:{
                Authorization: $AuthService.getAppToken()
            }
        });

        upload.then(function (response) {
            $rootScope.please_wait_class = '';
            $window.scrollTo(0, 0);
            $scope.propertySaved = true;
            $rootScope.propertiesCounts = response.data.data.propertiesCounts;
            resetForm();
            console.log($scope.form.data);
        }, function (response) {
            $rootScope.$broadcast('error-response-received',{status:response.status});
            $rootScope.please_wait_class = '';
            $scope.errors = response.data.error.messages;
            $window.scrollTo(0, 0);
        }, function (evt) {
            $window.scrollTo(0, 0);
        });
    };

    var resetForm = function () {
        $scope.form.data = mapFormData();
        $scope.temp.location = "";
        $('.image-loaded').removeClass('image-loaded');
        $('file-uploader').find('img').attr('src', '#');
    };

    $scope.showFreshForm = function () {
        $scope.propertySaved = false;
    };
    $scope.initialize = function () {
        $(document).scroll(function() {
            //onScroll();
        });
        $rootScope.loading_content_class = '';
        $scope.form.data = mapFormData();

        $(function() {
            $('.list-extraFeatures').slideUp();
            $('.feature-block').find('.form-heading').hide();
        });

    };
}]);