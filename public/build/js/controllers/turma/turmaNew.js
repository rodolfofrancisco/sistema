angular.module('app.controllers')
.controller('TurmaNewController', ['$scope', '$location', 'Turma', 'appConfig', function($scope, $location, Turma, appConfig) {
    $scope.turma = new Turma()
    $scope.niveis = appConfig.turma.nivel

    $scope.error = {
        message: '',
        error: false
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.turma.$save().then(function() {
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