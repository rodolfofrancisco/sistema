angular.module('app.services')
.service('Questionario', ['$resource', 'appConfig', function($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/questionario/:id', {id : '@id'}, {
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