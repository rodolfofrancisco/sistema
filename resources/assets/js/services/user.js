angular.module('app.services')
.service('User', ['$resource', 'appConfig', function($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/user/:id', {id : '@id'}, {
        update: {
            method: 'PUT'
        },
        get: {
            method: 'GET'
        },
        query: {
            isArray: false
        },
        authenticated: {
            url: appConfig.baseUrl + '/user/authenticated',
            method: 'GET'
        }
    })
}])