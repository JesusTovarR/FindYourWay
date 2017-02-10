
angular.module('app').controller('LieuController', ['$scope', '$rootScope', '$http', 'Lieu', 'LieuFactory',
    function($scope, $rootScope, $http, Lieu, LieuFactory){

        $scope.in1=true;
        $scope.desFin=false;

        $scope.newGame = function () {

            LieuFactory.newPartie().then(function (response) {
                $scope.error = undefined;
                $rootScope.partie = response.data;
                $scope.indications();
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

                $scope.indications=response.data;
                console.log($scope.indications);
                return $scope.indications;

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
