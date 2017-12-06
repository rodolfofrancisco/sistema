angular.module('app.controllers')
.controller('TurmaEditController', ['$scope', '$location', '$routeParams', 'Turma', 'appConfig', function($scope, $location, $routeParams, Turma, appConfig) {
    $scope.turma = Turma.get({id: $routeParams.id})
    $scope.niveis = appConfig.turma.nivel

    $scope.error = {
        message: '',
        error: false
    }

    $scope.save = function() {
        if ($scope.form.$valid) {            
            Turma.update({id: $scope.turma.id}, $scope.turma, function() {
                $location.path('/turma')
            }, function(data) {
                $scope.error.error = true
                if (data.data !== undefined && data.data.message !== undefined) {
                    $scope.error.message = data.data.message
                } else {
                    $scope.error.message = data.data
                }
            })
        }
    }
}])