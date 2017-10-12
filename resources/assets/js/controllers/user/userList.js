angular.module('app.controllers')
.controller('UserListController', ['$scope', 'User', function($scope, User) {
    $scope.users = []
    $scope.totalUsers = 0
    $scope.usersPerPage = 15

    $scope.pagination = {
        current: 1
    }

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    }
    
    function getResultsPage(pageNumber) {
        User.query({page: pageNumber}, function(data) {
            $scope.users = data.data
            $scope.totalUsers = data.total
        })
    }

    getResultsPage(1)
}])