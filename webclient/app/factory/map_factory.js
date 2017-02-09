/**
 * Created by dano on 09/02/17.
 */
angular.module('app').factory('MapFactory',['$http',function ($http) {

    return{
        coordonees:function (id, token) {
            return $http.get('http://backend.findyourway.local/game/'+id+'/coordonees?token='+token);
        }
    }
}]);