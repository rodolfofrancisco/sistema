angular.module('app.controllers')
.controller('UserPerfilController', ['$scope', '$location', '$routeParams', 'User', '$modalInstance', 'userId', function($scope, $location, $routeParams, User, $modalInstance, userId) {
    $scope.user = User.get({id: userId})

    $scope.remove = function() {
        $scope.user.$delete().then(function() {
            $location.path('/usuario')
            $modalInstance.close()
        })
    }

    $scope.cancel = function () {
        console.log($scope.user)
        $modalInstance.dismiss()
    };
}])
