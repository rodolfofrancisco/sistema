var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters', 'ui.bootstrap', 'http-auth-interceptor', 'app.directives', 'angularUtils.directives.dirPagination', 'mgcrea.ngStrap.navbar'])

angular.module('app.controllers', ['ngMessages', 'angular-oauth2'])
angular.module('app.filters', [])
angular.module('app.directives', [])
angular.module('app.services', ['ngResource'])

app.provider('appConfig', ['$httpParamSerializerProvider', function($httpParamSerializerProvider) {
    var config = {
        baseUrl: 'http://localhost:8000',
        pergunta: {
            tipo: [
                {value: 1, label: 'Resposta Única'},
                {value: 2, label: 'Resposta Múltipla'}                
            ]
        },
        turma: {
            nivel: [
                {value: 1, label: 'Básico'},
                {value: 2, label: 'Intermediário'},
                {value: 3, label: 'Avançado'},
                {value: 4, label: 'Fluente'},
            ]
        },
        aluno: {
            sexo: [
                {value: 1, label: 'Feminino'},
                {value: 2, label: 'Masculino'}
            ],
            grauInstrucao: [
                {value: 1, label: 'Sem escolaridade'},
                {value: 2, label: 'Ensino Fundamental 1 - 1ª a 5ª (incompleto)'},
                {value: 3, label: 'Ensino Fundamental 1 - 1ª a 5ª (completo)'},
                {value: 4, label: 'Ensino Fundamental 2 - 6ª a 9ª (incompleto)'},
                {value: 5, label: 'Ensino Fundamental 2 - 6ª a 9ª (completo)'},
                {value: 6, label: 'Ensino Médio - 1ª a 3ª ano do 2º grau (incompleto)'},
                {value: 7, label: 'Ensino Médio - 1ª a 3ª ano do 2º grau (completo)'},
                {value: 8, label: 'Nível técnico/Tecnológo (incompleto)'},
                {value: 9, label: 'Nível técnico/Tecnólogo (completo)'},
                {value: 10, label: 'Superior (incompleto)'},
                {value: 11, label: 'Superior (completo)'},
                {value: 12, label: 'Pós-graduação (Mestrado/Doutorado/Especialização) (incompleto)'},
                {value: 13, label: 'Pós-graduação (Mestrado/Doutorado/Especialização) (completo)'},
            ], estado: [                
                {value: 'AC', label: 'Acre'},
                {value: 'AL', label: 'Alagoas'},
                {value: 'AP', label: 'Amapá'},
                {value: 'AM', label: 'Amazonas'},
                {value: 'BA', label: 'Bahia'},
                {value: 'CE', label: 'Ceará'},
                {value: 'DF', label: 'Distrito Federal'},
                {value: 'ES', label: 'Espírito Santo'},
                {value: 'GO', label: 'Goiás'},
                {value: 'MA', label: 'Maranhão'},
                {value: 'MT', label: 'Mato Grosso'},
                {value: 'MS', label: 'Mato Grosso do Sul'},
                {value: 'MG', label: 'Minas Gerais'},
                {value: 'PA', label: 'Pará'},
                {value: 'PB', label: 'Paraíba'},
                {value: 'PR', label: 'Paraná'},
                {value: 'PE', label: 'Pernambuco'},
                {value: 'PI', label: 'Piauí'},
                {value: 'RJ', label: 'Rio de Janeiro'},
                {value: 'RN', label: 'Rio Grande do Norte'},
                {value: 'RS', label: 'Rio Grande do Sul'},
                {value: 'RO', label: 'Rondônia'},
                {value: 'RR', label: 'Roraima'},
                {value: 'SC', label: 'Santa Catarina'},
                {value: 'SP', label: 'São Paulo'},
                {value: 'SE', label: 'Sergipe'},
                {value: 'TO', label: 'Tocantins'},
            ]
        },
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
                    /*if (dataJson.hasOwnProperty('data')) {
                        dataJson = dataJson.data
                    }*/

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
            controller: 'UserListController',
            title: 'Usuários'
        })
        .when('/usuario/new', {
            templateUrl: 'build/views/user/new.html',
            controller: 'UserNewController'
        })
        .when('/usuario/:id/edit', {
            templateUrl: 'build/views/user/edit.html',
            controller: 'UserEditController'
        })
        .when('/usuario/:id/view', {
            templateUrl: 'build/views/user/view.html',
            controller: 'UserViewController'
        })
        .when('/usuario/:id/remove', {
            templateUrl: 'build/views/user/remove.html',
            controller: 'UserRemoveController'
        })
        .when('/turma', {
            templateUrl: 'build/views/turma/list.html',
            controller: 'TurmaListController',
            title: 'Turmas'
        })
        .when('/turma/new', {
            templateUrl: 'build/views/turma/new.html',
            controller: 'TurmaNewController'
        })
        .when('/turma/:id/edit', {
            templateUrl: 'build/views/turma/edit.html',
            controller: 'TurmaEditController'
        })
        .when('/turma/:id/view', {
            templateUrl: 'build/views/turma/view.html',
            controller: 'TurmaViewController'
        })
        .when('/turma/:id/remove', {
            templateUrl: 'build/views/turma/remove.html',
            controller: 'TurmaRemoveController'
        })
        .when('/aluno', {
            templateUrl: 'build/views/aluno/list.html',
            controller: 'AlunoListController',
            title: 'Alunos'
        })
        .when('/aluno/new', {
            templateUrl: 'build/views/aluno/new.html',
            controller: 'AlunoNewController'
        })
        .when('/aluno/:id/edit', {
            templateUrl: 'build/views/aluno/edit.html',
            controller: 'AlunoEditController'
        })
        .when('/aluno/:id/view', {
            templateUrl: 'build/views/aluno/view.html',
            controller: 'AlunoViewController'
        })
        .when('/aluno/:id/remove', {
            templateUrl: 'build/views/aluno/remove.html',
            controller: 'AlunoRemoveController'
        })
        .when('/questionario', {
            templateUrl: 'build/views/questionario/list.html',
            controller: 'QuestionarioListController',
            title: 'Questionários'
        })
        .when('/questionario/new', {
            templateUrl: 'build/views/questionario/new.html',
            controller: 'QuestionarioNewController'
        })
        .when('/questionario/:id/edit', {
            templateUrl: 'build/views/questionario/edit.html',
            controller: 'QuestionarioEditController'
        })
        .when('/notificacao', {
            templateUrl: 'build/views/notificacao/list.html',
            controller: 'NotificacaoListController',
            title: 'Notificações'
        })
        .when('/notificacao/new', {
            templateUrl: 'build/views/notificacao/new.html',
            controller: 'NotificacaoNewController'
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

    $rootScope.$on('$routeChangeSuccess', function(event, current, previous) {
        $rootScope.pageTitle = current.$$route.title
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