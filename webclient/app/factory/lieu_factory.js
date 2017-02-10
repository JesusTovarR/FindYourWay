/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').factory('LieuFactory', [ '$http', function ($http) {

    return {
        newPartie:function () {
            return $http.get('http://backend.findyourway.local/partie/new');
        },
        indications:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/indications?token='+token);
        },
        indices:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/indices?token='+token);
        },
        chemin:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/chemin?token='+token);
        },
        destinationFinal:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/destination?token='+token);
        },
        lieux:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/lieux_partie?token='+token);
        }/*,
        coordonees:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/coordonees?token='+token);
<<<<<<< HEAD
        }*/

=======
        }
>>>>>>> fe9f14ab68e1fc04f5abf94070497f910da113ed
    }

}]);