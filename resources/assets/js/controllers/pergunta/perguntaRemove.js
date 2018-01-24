angular.module('app.controllers')
.controller('PerguntaRemoveController', ['$scope', '$location', '$routeParams', 'Pergunta', '$modalInstance', 'removeId', 'questionarioId', '$route', function($scope, $location, $routeParams, Pergunta, $modalInstance, removeId, questionarioId, $route) {
    $scope.pergunta = Pergunta.get({id: removeId})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.remove = function() {
        $scope.pergunta.$delete().then(function() {
            $location.path('/questionario/' + questionarioId + '/edit')
            $modalInstance.close()
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

    $scope.cancel = function () {
        $modalInstance.dismiss()
    };
}])
