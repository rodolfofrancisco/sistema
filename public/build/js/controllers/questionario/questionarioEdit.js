angular.module('app.controllers')
.controller('QuestionarioEditController', ['$scope', '$location', '$routeParams', 'Questionario', 'appConfig', '$modal', function($scope, $location, $routeParams, Questionario, appConfig, $modal) {
    $scope.questionario = Questionario.get({id: $routeParams.id})

    $scope.error = {
        message: '',
        error: false
    }

    $scope.novaPergunta = function(id) {
        var modalInstance = $modal.open({
            templateUrl: 'build/views/pergunta/new.html',
            controller: 'PerguntaNewController',
            backdrop  : 'static',
            keyboard  : false,
            resolve: {
                questionarioId: function () {
                    return id
                }
            }
        })
    }

    $scope.cancel = function () {
        $modal.dismiss()
    };

    $scope.save = function() {
        if ($scope.form.$valid) {
            Questionario.update({id: $scope.questionario.id}, $scope.questionario, function() {
                $location.path('/questionario')
            }, function(data) {
                $scope.error.error = true
                if (data.data !== undefined && data.data.message !== undefined) {
                    $scope.error.message = data.data.message
                } else {
                    $scope.error.message = data.data
                }
            })
        }
    }

}])