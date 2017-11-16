angular.module('app.controllers')
.controller('UserListController', ['$scope', 'User', '$modal', function($scope, User, $modal) {
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
            $scope.totalUsers = data.meta.pagination.total
        })
    }

    $scope.remove = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/user/remove.html',
            controller: 'UserRemoveController',
            backdrop  : 'static',
            keyboard  : false,
            resolve: {
                removeId: function () {
                    return id
                }
            }
        })
    }

    getResultsPage(1)
}])