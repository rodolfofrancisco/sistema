angular.module('app.controllers')
.controller('TurmaViewController', ['$scope', '$location', '$routeParams', 'Turma', 'appConfig', function($scope, $location, $routeParams, Turma, appConfig) {
    $scope.turma = Turma.get({id: $routeParams.id})
    $scope.niveis = appConfig.turma.nivel
}])