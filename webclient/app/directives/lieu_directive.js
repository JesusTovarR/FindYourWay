/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').directive('lieu', [
    function(){
        return{
            restrict : 'E',
            templateUrl : 'app/templates/map.html'
        };
    }
]);