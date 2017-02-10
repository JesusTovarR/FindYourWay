/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').directive('indication', [
    function(){
        return{
            restrict : 'E',
            templateUrl : 'app/templates/indications.html'
        };
    }
]);