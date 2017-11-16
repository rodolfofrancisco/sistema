angular.module('app.services')
.service('Aluno', ['$resource', 'appConfig', function($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/aluno/:id', {id : '@id'}, {
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