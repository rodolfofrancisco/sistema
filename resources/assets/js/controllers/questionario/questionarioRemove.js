angular.module('app.controllers')
.controller('QuestionarioRemoveController', ['$scope', '$location', '$routeParams', 'Questionario', '$modalInstance', 'removeId', '$route', function($scope, $location, $routeParams, Questionario, $modalInstance, removeId, $route) {
    $scope.questionario = Questionario.get({id: removeId})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.remove = function() {
        $scope.questionario.$delete().then(function() {
            $location.path('/questionario')
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
    }

}])
