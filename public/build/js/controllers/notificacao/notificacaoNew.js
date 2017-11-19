angular.module('app.controllers')
.controller('NotificacaoNewController', ['$scope', '$location', 'Notificacao', 'appConfig', '$modal', function($scope, $location, Notificacao, appConfig, $modal) {
    $scope.notificacao = new Notificacao()

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.user.$save().then(function() {
                $location.path('/notificacao')
            })
        }
    }

    $scope.cancel = function () {
        $modal.dismiss()
    };

}])