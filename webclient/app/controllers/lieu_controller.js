angular.module('app').controller('LieuController', ['$scope', '$http', 'Lieu', 'LieuFactory',
    function($scope, $http, Lieu, LieuFactory){
        $scope.cont = 2;

        $scope.newGame = function () {
            LieuFactory.newPartie().then(function (response) {
                $scope.error = undefined;
                $scope.partie = response.data;
                $scope.indications();
                $scope.coordonees();
                $scope.chemin();
                $scope.destinationFinal();
            }, function (error) {
                console.log('error');
            });
        };

        $scope.indications = function (){
            LieuFactory.indications($scope.partie.id, $scope.partie.token).then(function (response){

               console.log($scope.indications=response.data);

            },function (error) {
                console.log('error');
            });
        };

        $scope.coordonees = function (){
            LieuFactory.coordonees($scope.partie.id, $scope.partie.token).then(function (response){

                console.log($scope.coordonees=response.data);

            },function (error) {
                console.log('error');
            });
        };

        $scope.indices = function (){
            LieuFactory.indices($scope.partie.id, $scope.partie.token).then(function (response){

                console.log( $scope.indices=response.data);

            },function (error) {
                console.log('error');
            });
        };

        $scope.chemin = function (){
            LieuFactory.chemin($scope.partie.id, $scope.partie.token).then(function (response){

                console.log( $scope.chemin=response.data);

            },function (error) {
                console.log('error');
            });
        };

        $scope.destinationFinal = function (){
            LieuFactory.destinationFinal($scope.partie.id, $scope.partie.token).then(function (response){

                console.log( $scope.destinationFinal=response.data);

            },function (error) {
                console.log('error');
            });
        };

        $scope.newGame();

    }
]);
