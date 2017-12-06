angular.module('app.controllers')
.controller('AlunoListController', ['$scope', 'Aluno', '$modal', 'appConfig', 'Turma', function($scope, Aluno, $modal, appConfig, Turma) {
    $scope.alunos = []
    $scope.totalAlunos = 0
    $scope.alunosPerPage = 15
    $scope.turmas = Turma.getAll()

    $scope.pagination = {
        current: 1
    }

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    }
    
    function getResultsPage(pageNumber) {
        $scope.alunos = []
        Aluno.query({page: pageNumber}, function(data) {
            $scope.alunos = data.data
            if (data.meta !== undefined) {
                $scope.totalAlunos = data.meta.pagination.total
            } else {
                $scope.totalAlunos = data.data.length
            }
        })
    }

    $scope.remove = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/aluno/remove.html',
            controller: 'AlunoRemoveController',
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