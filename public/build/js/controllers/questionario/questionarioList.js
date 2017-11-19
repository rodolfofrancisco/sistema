angular.module('app.controllers')
.controller('QuestionarioListController', ['$scope', 'Questionario', '$modal', 'appConfig', function($scope, Aluno, $modal, appConfig) {
    $scope.questionarios = []
    $scope.totalQuestionarios = 0
    $scope.questionariosPerPage = 15

    $scope.pagination = {
        current: 1
    }

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    }
    
    function getResultsPage(pageNumber) {
        $scope.questionarios = []
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