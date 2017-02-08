/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').factory('LieuFactory', ['$http',function ($http) {

    return {
        newPartie:function () {
            return $http.get('http://backend.findyourway.local/partie/new');
        },
        chemin:function (id, token) {
            console.log(id+' tambien2 '+token);
            var config = {headers: {'Authorization': 'Token token='+token,
                'Content-Type': 'application/json'}};

            return $http.get('http://backend.findyourway.local/game/'+id+'/chemin?token='+token);
        },
        getLieux:function () {
            return $http.get('http://backend.findyourway.local/lieux');
        },
        getLieuByid: function (id) {
            return $http.get('http://backend.findyourway.local/lieu/'+id);
        }
    }

}]);