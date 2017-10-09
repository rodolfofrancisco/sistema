angular.module('app.controllers')
.controller('UserEditController', ['$scope', '$location', '$routeParams', 'User', function($scope, $location, $routeParams, User) {
    $scope.user = User.get({id: $routeParams.id})

    $scope.save = function() {
        if ($scope.form.$valid) {
            User.update({id: $scope.user.id}, $scope.user, function() {
                $location.path('/usuario')
            })
        }
    }
}])