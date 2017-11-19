angular.module('app.controllers')
.controller('QuestionarioNewController', ['$scope', '$location', 'Questionario', 'appConfig', '$modal', function($scope, $location, Questionario, appConfig, $modal) {
    $scope.questionario = new Questionario()

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.user.$save().then(function() {
                $location.path('/questionario')
            })
        }
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

}])