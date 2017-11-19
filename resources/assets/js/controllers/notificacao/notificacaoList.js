angular.module('app.controllers')
.controller('NotificacaoListController', ['$scope', 'Notificacao', '$modal', 'appConfig', function($scope, Notificacao, $modal, appConfig) {
    $scope.notificacaoes = []
    $scope.totalNotificacaoes = 0
    $scope.notificacaoesPerPage = 15

    $scope.pagination = {
        current: 1
    }

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    }
    
    function getResultsPage(pageNumber) {
        $scope.notificacaoes = []
        /*Turma.query({page: pageNumber}, function(data) {
            $scope.turmas = data.data
            $scope.totalTurmas = data.meta.pagination.total
        })*/
    }

    $scope.remove = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/questionario/remove.html',
            controller: 'QuestionarioRemoveController',
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