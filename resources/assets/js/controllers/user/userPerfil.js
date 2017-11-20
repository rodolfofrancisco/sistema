angular.module('app.controllers')
.controller('UserPerfilController', ['$scope', '$location', '$routeParams', 'User', '$modalInstance', 'userId', function($scope, $location, $routeParams, User, $modalInstance, userId) {
    $scope.user = User.get({id: userId})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.remove = function() {
        $scope.user.$delete().then(function() {
            $location.path('/usuario')
            $modalInstance.close()
        })
    }

    $scope.cancel = function () {
        $modalInstance.dismiss()
    };

    $scope.save = function() {
        if ($scope.form.$valid) {
            User.update({id: $scope.user.id}, $scope.user, function() {
                $modalInstance.close()
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
