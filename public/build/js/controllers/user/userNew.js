angular.module('app.controllers')
.controller('UserNewController', ['$scope', '$location', 'User', function($scope, $location, User) {
    $scope.user = new User()

    $scope.error = {
        message: '',
        error: false
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.user.$save().then(function() {
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