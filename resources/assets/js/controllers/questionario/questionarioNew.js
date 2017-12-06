angular.module('app.controllers')
.controller('QuestionarioNewController', ['$scope', '$location', 'Questionario', 'appConfig', '$modal', function($scope, $location, Questionario, appConfig, $modal) {
    $scope.questionario = new Questionario()

    $scope.change = function() {
        if ($scope.form.$valid) {
            $scope.questionario.$save().then(function(response) {
                if (response.data !== undefined &&
                    response.data.id !== undefined
                ) {
                    $location.path('/questionario/edit/' + response.data.id)
                }
            })
        }
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.questionario.$save().then(function() {
                $location.path('/questionario')
            })
        }
    }

}])