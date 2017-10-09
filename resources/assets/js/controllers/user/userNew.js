angular.module('app.controllers')
.controller('UserNewController', ['$scope', '$location', 'User', function($scope, $location, User) {
    $scope.user = new User()

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.user.$save().then(function() {
                $location.path('/usuario')
            })
        }
    }
}])