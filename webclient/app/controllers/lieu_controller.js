angular.module('app').controller('LieuController', ['$scope', '$http', 'Lieu', 'LieuFactory',
    function($scope, $http, Lieu, LieuFactory){
        $scope.newGame = function () {
            LieuFactory.newPartie().then(function (response) {
                $scope.error = undefined;
                $scope.partie = response.data;
                $scope.indications();
                $scope.coordonees();
                $scope.chemin();
                $scope.indices();
                $scope.destinationFinal();
                $scope.lieux();
            }, function (error) {
                console.log('error');
            });
        };

        $scope.indications = function (){
            LieuFactory.indications($scope.partie.id, $scope.partie.token).then(function (response){

               console.log($scope.indications=response.data);
                 return $scope.indications=response.data;

            },function (error) {
                console.log('error');
            });
        };

        $scope.coordonees = function (){
            LieuFactory.coordonees($scope.partie.id, $scope.partie.token).then(function (response){

                // console.log($scope.coordonees=response.data);
                return $scope.coordonees=response.data;

            },function (error) {
                console.log('error');
            });
        };

        $scope.chemin = function (){
            LieuFactory.chemin($scope.partie.id, $scope.partie.token).then(function (response){

                // console.log( $scope.chemin=response.data);
                return $scope.chemin=response.data;

            },function (error) {
                console.log('error');
            });
        };

        $scope.indices = function (){
            LieuFactory.indices($scope.partie.id, $scope.partie.token).then(function (response){

                 console.log( $scope.indices=response.data);
                return $scope.indices=response.data;

            },function (error) {
                console.log('error');
            });
        };

        $scope.destinationFinal = function (){
            LieuFactory.destinationFinal($scope.partie.id, $scope.partie.token).then(function (response){

                 console.log( $scope.destinationFinal=response.data);
                return $scope.destinationFinal=response.data;

            },function (error) {
                console.log('error');
            });
        };

        $scope.lieux = function (){
            LieuFactory.lieux($scope.partie.id, $scope.partie.token).then(function (response){

                 console.log( $scope.lieux=response.data);
               // return $scope.lieux=response.data;

            },function (error) {
                console.log('error');
            });
        };
    }
]);
