angular.module('app.controllers')
.controller('TurmaRemoveController', ['$scope', '$location', '$routeParams', 'Turma', '$modalInstance', 'removeId', '$route', function($scope, $location, $routeParams, Turma, $modalInstance, removeId, $route) {
    $scope.turma = Turma.get({id: removeId})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.remove = function() {
        $scope.turma.$delete().then(function() {
            $location.path('/turma')
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
