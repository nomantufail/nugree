/**
 * Created by nomantufail on 09/05/2016.
 */
var app = angular.module(appName);

app.directive('myDirective', function ($compile) {
    return {
        restrict: 'EA',
        scope: {
            title: '@myText',
            htmlStructure: '@featureHtml'
        },
        controller: 'AddPropertyController', //Embed a custom controller in the directive

        link: function ($scope, element, attrs) {
            var template = attrs.htmlstructure;
            var linkFn = $compile(template);
            var content = linkFn($scope);
            element.append(content);
        }
    }
});