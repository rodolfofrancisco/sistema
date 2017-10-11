angular.module('app.controllers')
.controller('UserRemoveController', ['$scope', '$location', '$routeParams', 'User', function($scope, $location, $routeParams, User) {
    $scope.user = User.get({id: $routeParams.id})

    $scope.remove = function() {
        $scope.user.$delete().then(function() {
            $location.path('/usuario')
        })
    }
}])
