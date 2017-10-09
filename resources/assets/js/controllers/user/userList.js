angular.module('app.controllers')
.controller('UserListController', ['$scope', 'User', function($scope, User) {
    $scope.users = User.query()
}])