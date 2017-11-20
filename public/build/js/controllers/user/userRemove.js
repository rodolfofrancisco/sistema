angular.module('app.controllers')
.controller('UserRemoveController', ['$scope', '$location', '$routeParams', 'User', '$modalInstance', 'removeId', '$route', function($scope, $location, $routeParams, User, $modalInstance, removeId, $route) {
    $scope.user = User.get({id: removeId})

    $scope.remove = function() {
        $scope.user.$delete().then(function() {
            $location.path('/usuario')
            $modalInstance.close()
            $route.reload()
        })
    }

    $scope.cancel = function () {
        $modalInstance.dismiss()
    };
}])
