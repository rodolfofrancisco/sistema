var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters', 'ui.bootstrap', 'http-auth-interceptor', 'app.directives'])

angular.module('app.controllers', ['ngMessages', 'angular-oauth2'])
angular.module('app.filters', [])
angular.module('app.directives', [])
angular.module('app.services', ['ngResource'])

app.provider('appConfig', ['$httpParamSerializerProvider', function($httpParamSerializerProvider) {
    var config = {
        baseUrl: 'http://localhost:8000',
        utils: {
            transformRequest: function(data) {
                if (angular.isObject(data)) {
                    return $httpParamSerializerProvider.$get()(data)
                }

                return data
            },
            transformResponse: function(data, headers) {
                var headersGetter = headers()

                if (headersGetter['content-type'] == 'application/json' ||
                    headersGetter['content-type'] == 'text/json'
                ) {
                    var dataJson = JSON.parse(data)
                    if (dataJson.hasOwnProperty('data')) {
                        dataJson = dataJson.data
                    }

                    return dataJson
                }

                return data
            }
        }
    }

    return {
        config: config,
        $get: function() {
            return config
        }
    }
}])

app.config(['$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider', function($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8'
    $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8'
    $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest
    $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse
    $httpProvider.interceptors.splice(0, 1)
    $httpProvider.interceptors.splice(0, 1)

    $httpProvider.interceptors.push('oauthFixInterceptor')

    $routeProvider
        .when('/login', {
            templateUrl: 'build/views/login.html',
            controller: 'LoginController'
        })
        .when('/logout', {
            resolve: {
                'logout': ['$location', 'OAuthToken', function($location, OAuthToken) {
                    OAuthToken.removeToken()
                    $location.path('/login')
                }]
            }
        })
        .when('/home', {
            templateUrl: 'build/views/home.html',
            controller: 'HomeController'
        })
        .when('/usuario', {
            templateUrl: 'build/views/user/list.html',
            controller: 'UserListController'
        })
        .when('/usuario/new', {
            templateUrl: 'build/views/user/new.html',
            controller: 'UserNewController'
        })
        .when('/usuario/:id/edit', {
            templateUrl: 'build/views/user/edit.html',
            controller: 'UserEditController'
        })
        .when('/usuario/:id/remove', {
            templateUrl: 'build/views/user/remove.html',
            controller: 'UserRemoveController'
        })
    
    OAuthProvider.configure({
        baseUrl: appConfigProvider.config.baseUrl,
        clientId: 'app',
        clientSecret: 'secret',
        grantPath: 'oauth/access_token'
    })

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }
    })
}])

app .run(['$rootScope', '$location', '$http', '$modal', 'httpBuffer', 'OAuth', function($rootScope, $location, $http, $modal, httpBuffer, OAuth) {

    $rootScope.$on('$routeChangeStart', function(event, next, current) {
        if (next.$$route.originalPath != '/login') {
            if (!OAuth.isAuthenticated()) {
                $location.path('login')
            }
        }
    })

    $rootScope.$on('oauth:error', function(event, data) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`
        if ('invalid_grant' === data.rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('access_denied' === data.rejection.data.error) {
            httpBuffer.append(data.rejection.config, data.deferred)
            if (!$rootScope.loginModalOpened) {
                var modalInstance = $modal.open({
                    templateUrl: 'build/views/templates/loginModal.html',
                    controller: 'LoginModalController'
               })
               $rootScope.loginModalOpened = true               
            }
            return;
        }

        // Redirect to `/login` with the `error_reason`.
        return $location.path('login');
    })
}])