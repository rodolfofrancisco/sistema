angular.module('app.services')
.service('Notificacao', ['$resource', 'appConfig', function($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/notificacao/:id', {id : '@id'}, {
        update: {
            method: 'PUT'
        },
        get: {
            method: 'GET'
        },
        query: {
            isArray: false
        }
    })
}])