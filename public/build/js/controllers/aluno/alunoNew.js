angular.module('app.controllers')
.controller('AlunoNewController', ['$scope', '$location', 'Aluno', 'Turma', 'appConfig', '$http', function($scope, $location, Aluno, Turma, appConfig, $http) {
    $scope.aluno = new Aluno()
    $scope.sexo = appConfig.aluno.sexo
    $scope.grauInstrucao = appConfig.aluno.grauInstrucao
    $scope.turmas = Turma.query()
    $scope.showDataNascimento = false
    $scope.estado = appConfig.aluno.estado
    
    $scope.open = function() { 
        $scope.showDataNascimento = true
    }

    $scope.getCep = function() {
        $http.get(appConfig.baseUrl + '/aluno/cep/' + $scope.aluno.cep) .success(function(response) {
            if (response[0] !== undefined) {
                var data = response[0]

                $scope.aluno.logradouro = data.logradouro
                $scope.aluno.bairro = data.bairro
                $scope.aluno.cidade = data.cidade
                $scope.aluno.estado = data.uf
            }
       });
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.user.$save().then(function() {
                $location.path('/aluno')
            })
        }
    }
}])