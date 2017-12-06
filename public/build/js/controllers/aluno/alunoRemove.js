angular.module('app.controllers')
.controller('AlunoRemoveController', ['$scope', '$location', '$routeParams', 'Aluno', '$modalInstance', 'removeId', '$route', function($scope, $location, $routeParams, Aluno, $modalInstance, removeId, $route) {
    $scope.aluno = Aluno.get({id: removeId})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.remove = function() {
        $scope.aluno.$delete().then(function() {
            $location.path('/aluno')
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
