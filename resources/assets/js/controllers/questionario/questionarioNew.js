angular.module('app.controllers')
.controller('QuestionarioNewController', ['$scope', '$location', 'Questionario', 'appConfig', '$modalInstance', function($scope, $location, Questionario, appConfig, $modalInstance) {
    $scope.questionario = new Questionario()

    $scope.cancel = function () {
        $modalInstance.dismiss()
    }

    $scope.save = function() {
        if ($scope.form.$valid) {
            $scope.questionario.$save().then(function(response) {
                $scope.cancel()
                $location.path('/questionario/' + response.data.id + '/edit')
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