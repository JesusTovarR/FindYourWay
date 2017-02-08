/**
 * Created by Jesus Tovar on 07/02/2017.
 */
angular.module('app').service('Lieu', ['$http',
    function($http){

        var Lieu = function(data){
            this.id = data.id;
            this.coord_x = data.coord_x;
            this.coord_y = data.coord_y;
            this.indication = data.indication;
            this.description = data.description;
            this.image = data.image;
            this.indice1 = data.indice1;
            this.indice2 = data.indice2;
            this.indice3 = data.indice3;
            this.indice4 = data.indice4;
            this.indice5 = data.indice5;
        };

        return Lieu;
    }
]);