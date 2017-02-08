angular.module('app').controller('LieuController', ['$scope', '$http', 'Lieu', 'LieuFactory',
    function($scope, $http, Lieu, LieuFactory){
        $scope.cont = 0;

        $scope.newGame = function () {
            LieuFactory.newPartie().then(function (response) {
              /*  console.log('Bien');*/
                $scope.error = undefined;
                $scope.partie = response.data;
                console.log(response.data);
                // response.data.forEach(function (e) {
                //     $scope.lieux.push(new Lieu(e));
                // });
            }, function (error) {
                console.log('error');
            });
        };


        $scope.newGame();



    }
]);
