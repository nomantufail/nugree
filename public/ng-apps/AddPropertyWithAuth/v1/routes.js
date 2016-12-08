/**
 * Created by noman_2 on 12/8/2015.
 */
var views = domain+"ng-apps/addPropertyWithAuth/v1/views";

var app = angular.module('addPropertyWithAuth');
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/");

    // Now set up the states
    $stateProvider
        .state('addProperty', {
            url: "/",
            templateUrl: views+"/addPropertyForm.html",
            controller: "AddPropertyController",
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
});
