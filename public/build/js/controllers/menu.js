angular.module('app.controllers')
.controller('MenuController', ['$scope', '$cookies', '$modal', function($scope, $cookies, $modal) {
    $scope.user = $cookies.getObject('user')

    $scope.perfil = function(id) {
        var modalInstance = $modal.open({
            templateUrl : 'build/views/user/perfil.html',
            controller  : 'UserPerfilController',
            backdrop    : 'static',
            keyboard    : false,
            resolve     : {
                userId: function () {
                    return id
                }
            }
        })
    }

}])