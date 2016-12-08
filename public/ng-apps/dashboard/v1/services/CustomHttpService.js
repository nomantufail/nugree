/**
 * Created by zeenomlabs on 12/11/2015.
 */
var app = angular.module('dashboard');
app.factory("$CustomHttpService", function ($rootScope, $http, $AuthService) {
    return {
        $http: function($method, $url, $data, $headers){
            if($data == undefined)
                $data = {};
            if($headers == undefined)
                $headers = {};

            $params = {
                method: $method,
                url: $url,
                params: $data,
                headers: {
                    Authorization: $AuthService.getAppToken()
                }
            };
            if($method.toLowerCase() == 'post'){
                $params.data = $data;
                $params.params = {};
            }
            return $http($params);
        }
    }
});