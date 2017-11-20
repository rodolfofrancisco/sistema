angular.module('app.controllers')
.controller('UserEditController', ['$scope', '$location', '$routeParams', 'User', function($scope, $location, $routeParams, User) {
    $scope.user = User.get({id: $routeParams.id})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            User.update({id: $scope.user.id}, $scope.user, function() {
                $location.path('/usuario')
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