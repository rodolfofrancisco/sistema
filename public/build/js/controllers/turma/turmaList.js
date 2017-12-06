angular.module('app.controllers')
.controller('TurmaListController', ['$scope', 'Turma', '$modal', 'appConfig', function($scope, Turma, $modal, appConfig) {
    $scope.turmas = []
    $scope.totalTurmas = 0
    $scope.turmasPerPage = 15
    $scope.niveis = appConfig.turma.nivel

    $scope.pagination = {
        current: 1
    }

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    }
    
    function getResultsPage(pageNumber) {
        Turma.query({page: pageNumber}, function(data) {
            $scope.turmas = data.data
            if (data.meta !== undefined) {
                $scope.totalTurmas = data.meta.pagination.total
            } else {
                $scope.totalTurmas = data.data.length
            }
        })
    }

    $scope.remove = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/turma/remove.html',
            controller: 'TurmaRemoveController',
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