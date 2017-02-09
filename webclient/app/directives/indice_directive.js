/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').directive('indice', [
    function(){
        return{
            restrict : 'E',
            templateUrl : 'app/templates/indices.html'
        };
    }
]);