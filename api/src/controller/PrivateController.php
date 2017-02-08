<?php

namespace api\controller;

use api\model\Lieu;
use api\model\Chemin;
use api\util\Util;
use api\controller\AbstractController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PrivateController extends AbstractController
{

    public function __construct($var)
    {
        $this->container = $var;
    }

    public function addLieu(Request $request, Response $response, $args){
      $lieu = new Lieu;
      if(isset($request->getParsedBody()['coord_x']) &&
         isset($request->getParsedBody()['coord_y']) &&
         isset($request->getParsedBody()['indication']) &&
         isset($request->getParsedBody()['description'])){
           $lieu->coord_x = filter_var($request->getParsedBody()['coord_x'], FILTER_SANITIZE_NUMBER_FLOAT);
           $lieu->coord_y = filter_var($request->getParsedBody()['coord_y'], FILTER_SANITIZE_NUMBER_FLOAT);
           $lieu->indication = filter_var($request->getParsedBody()['indication'], FILTER_SANITIZE_STRING);
           $lieu->description = filter_var($request->getParsedBody()['description'], FILTER_SANITIZE_STRING);
           $lieu->save();
           $response = $this->json_success($response, 201, $lieu->toJson());
      }else{
         $response = $this->json_error($response, 500, "erreur lors de la creation de la ressource");
      }
      return $response;
    }


    public function addIndice(Request $request, Response $response, $args){
      $lieu = Lieu::select()->where('id', '=', $args['id'])->firstOrFail();
      $indice = filter_var($request->getParsedBody()['indice'], FILTER_SANITIZE_STRING);
      if($lieu->indice1 == ''){
        $lieu->indice1 = $indice;
      }elseif($lieu->indice2 == ''){
        $lieu->indice2 = $indice;
      }elseif($lieu->indice3 == ''){
        $lieu->indice3 = $indice;
      }elseif($lieu->indice4 == ''){
        $lieu->indice4 = $indice;
      }elseif($lieu->indice5 == ''){
        $lieu->indice5 = $indice;
        $lieu->dest_finale = 1;
      }else{
        $lieu->dest_finale = 1;
        $lieu->save();
        $response = $this->json_error($response, 500, "supprimer un indice pour en ajouter un nouveau");
        return $response;
      }
      $lieu->save();
      $response = $this->json_success($response, 201, $lieu->toJson());
      return $response;
    }
}
