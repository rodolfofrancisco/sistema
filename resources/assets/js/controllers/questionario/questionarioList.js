angular.module('app.controllers')
.controller('QuestionarioListController', ['$scope', 'Questionario', '$modal', 'appConfig', function($scope, Questionario, $modal, appConfig) {
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
        Questionario.query({page: pageNumber}, function(data) {
            $scope.questionarios = data.data
            if (data.meta !== undefined) {
                $scope.totalQuestionarios = data.meta.pagination.total
            } else {
                $scope.totalQuestionarios = data.data.length
            }
        })
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

    $scope.new = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/questionario/new.html',
            controller: 'QuestionarioNewController',
            backdrop  : 'static',
            keyboard  : false
        })
    }

    getResultsPage(1)

}])