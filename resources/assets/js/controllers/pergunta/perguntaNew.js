angular.module('app.controllers')
.controller('PerguntaNewController', ['$scope', '$location', '$routeParams', 'Pergunta', '$modalInstance', 'questionarioId', 'appConfig', '$route', function($scope, $location, $routeParams, Pergunta, $modalInstance, questionarioId, appConfig, $route) {
    $scope.pergunta = new Pergunta()
    $scope.pergunta.questionario_id = questionarioId
    $scope.pergunta.respostas = [ {  descricao : '' } ]
    $scope.tipos = appConfig.pergunta.tipo    

    $scope.remove = function(index) {
        if (index !== undefined && 
            $scope.pergunta !== undefined &&
            $scope.pergunta.respostas !== undefined
        ) {
            $scope.pergunta.respostas.splice(index, 1)
        }
    }

    $scope.novaResposta = function() {
        if ($scope.pergunta !== undefined &&
            $scope.pergunta.respostas !== undefined
        ) {
            $scope.pergunta.respostas.push({ 'descricao': '' })
        }
    }

    $scope.cancel = function () {
        $modalInstance.dismiss()
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.pergunta.$save().then(function() {
                $scope.cancel()
                $location.path('/questionario/' + questionarioId + '/edit')
                $route.reload()
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
