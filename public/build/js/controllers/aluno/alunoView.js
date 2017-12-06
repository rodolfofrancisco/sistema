angular.module('app.controllers')
.controller('AlunoViewController', ['$scope', '$location', '$routeParams', 'Aluno', 'appConfig', 'Turma', function($scope, $location, $routeParams, Aluno, appConfig, Turma) {
    $scope.aluno = Aluno.get({id: $routeParams.id})
    $scope.sexo = appConfig.aluno.sexo
    $scope.grauInstrucao = appConfig.aluno.grauInstrucao
    $scope.turmas = Turma.getAll()
    $scope.showDataNascimento = false
    $scope.estado = appConfig.aluno.estado
}])