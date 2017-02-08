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
        coordonees:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/coordonees?token='+token);
        },
        chemin:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/lieux_partie?token='+token);
        },
        getLieux:function () {
            return $http.get('http://backend.findyourway.local/lieux');
        },
        getLieuByid: function (id) {
            return $http.get('http://backend.findyourway.local/lieu/'+id);
        }
    }

}]);