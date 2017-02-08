/**
 * Created by Jesus Tovar on 08/02/2017.
 */
angular.module('app').service('PartieService', ['$http',
    function($http){

        var Partie = function(data){
            this.id = data.id;
            this.token = data.token;
            this.distanceDF = data.distanceDF;
            this.id_chemin = data.id_chemin;
        };

        return Partie;
    }
]);