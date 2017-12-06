angular.module('app.controllers')
.controller('AlunoEditController', ['$scope', '$location', '$routeParams', 'Aluno', 'appConfig', 'Turma', function($scope, $location, $routeParams, Aluno, appConfig, Turma) {
    $scope.aluno = Aluno.get({id: $routeParams.id})
    $scope.sexo = appConfig.aluno.sexo
    $scope.grauInstrucao = appConfig.aluno.grauInstrucao
    $scope.turmas = Turma.getAll()
    $scope.showDataNascimento = false
    $scope.estado = appConfig.aluno.estado

    $scope.error = {
        message: '',
        error: false
    }
    
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
            Aluno.update({id: $scope.aluno.id}, $scope.aluno, function() {
                $location.path('/aluno')
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