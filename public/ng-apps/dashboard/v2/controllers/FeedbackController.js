/**
 * Created by noman_2 on 12/8/2015.
 */
var app = angular.module('dashboard');
app.controller("FeedbackController",["$scope", "$rootScope", "$CustomHttpService", function ($scope, $rootScope, $CustomHttpService) {
    $scope.errors = {};
    $scope.feedBackSent = false;
    $scope.form = {
        data:{
            userId: $rootScope.authUser.id,
            email: '',
            message: ''
        }
    };
    $scope.sendFeedback = function (){
        $scope.feedBackSent = true;
        return $CustomHttpService.$http('POST', apiPath+'user/feedback', $scope.form.data)
            .then(function successCallback(response) {
                alert("Thank YOU for your feedback!")
            }, function errorCallback(response) {
                $rootScope.$broadcast('error-response-received',{status:response.status});
            });
    }
}]);