angular.module('app.controllers')
.controller('UserViewController', ['$scope', '$location', '$routeParams', 'User', function($scope, $location, $routeParams, User) {
    $scope.user = User.get({id: $routeParams.id})
}])