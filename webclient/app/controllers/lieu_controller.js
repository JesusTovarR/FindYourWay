angular.module('app').controller('LieuController', ['$scope', '$http', 'Lieu', 'LieuFactory',
    function($scope, $http, Lieu, LieuFactory){
        $scope.cont = 0;

        $scope.newGame = function () {
            LieuFactory.newPartie().then(function (response) {
              /*  console.log('Bien');*/
                $scope.error = undefined;
                $scope.partie = response.data;
                $scope.chemin($scope.partie.id, $scope.partie.token);
            }, function (error) {
                console.log('error');
            });
        };

        $scope.chemin = function (id, token){
            $scope.id=id;
            $scope.token=token;
            LieuFactory.chemin($scope.id, $scope.token).then(function (response){

                console.log(response.data);

            },function (error) {
                console.log('erroryo');
            });
        };


        $scope.newGame();



    }
]);
