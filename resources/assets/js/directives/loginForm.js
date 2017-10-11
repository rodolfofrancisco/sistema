angular.module('app.directives')
.directive('loginForm', [
    'appConfig', function(appConfig) {
        console.log(appConfig.baseUrl + '/build/views/templates/form-login.html')
        return {
            restrict: 'E',
            templateUrl: appConfig.baseUrl + '/build/views/templates/form-login.html',
            scope: false
        }
    }
])