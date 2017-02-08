/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').factory('LieuFactory', ['$http',function ($http) {
    /*    var config = {headers: {'Authorization': 'Token token=61813703d88b45b48653a1cd3f5673d6',
     'Content-Type': 'application/json'}};*/

    return {
        getLieux:function () {
            return $http.get('http://backend.findyourway.local/lieux');
        },
        getLieuByid: function (id) {
            return $http.get('http://backend.findyourway.local/lieu/'+id);
        }
    }

}]);