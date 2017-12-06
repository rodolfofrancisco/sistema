angular.module('app.services')
.service('Pergunta', ['$resource', 'appConfig', function($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/pergunta/:id', {id : '@id'}, {
        update: {
            method: 'PUT'
        },
        get: {
            method: 'GET'
        },
        query: {
            isArray: false
        },
        save: {
            method: 'POST',
            transformRequest: function (data, headersGetter) {
                console.log(data)
                //modify data and return it 
                return angular.toJson(data);
            }
        },
        authenticated: {
            url: appConfig.baseUrl + '/user/authenticated',
            method: 'GET'
        }
    })
}])