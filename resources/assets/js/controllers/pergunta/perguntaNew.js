angular.module('app.controllers')
.controller('PerguntaNewController', ['$scope', '$location', '$routeParams', 'User', '$modalInstance', function($scope, $location, $routeParams, User, $modalInstance) {
    
    $scope.remove = function() {

    }

    $scope.cancel = function () {
        $modalInstance.dismiss()
    };
}])
