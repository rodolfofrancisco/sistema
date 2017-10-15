angular.module('app.controllers')
.controller('UserRemoveController', ['$scope', '$location', '$routeParams', 'User', '$modalInstance', 'removeId', function($scope, $location, $routeParams, User, $modalInstance, removeId) {
    $scope.user = User.get({id: removeId})

    $scope.remove = function() {
        $scope.user.$delete().then(function() {
            $location.path('/usuario')
            $modalInstance.close()
        })
    }

    $scope.cancel = function () {
        $modalInstance.dismiss()
    };
}])
