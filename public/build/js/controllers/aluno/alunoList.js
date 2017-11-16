angular.module('app.controllers')
.controller('AlunoListController', ['$scope', 'Aluno', '$modal', 'appConfig', function($scope, Aluno, $modal, appConfig) {
    $scope.alunos = []
    $scope.totalAlunos = 0
    $scope.alunosPerPage = 15

    $scope.pagination = {
        current: 1
    }

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    }
    
    function getResultsPage(pageNumber) {
        $scope.alunos = []
        /*Turma.query({page: pageNumber}, function(data) {
            $scope.turmas = data.data
            $scope.totalTurmas = data.meta.pagination.total
        })*/
    }

    $scope.remove = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/tumra/remove.html',
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