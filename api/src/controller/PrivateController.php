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
      $lieu = Lieu::select('indice1', 'indice2', 'indice3', 'indice4', 'indice5')->where('id', '=', $args['id'])->firstOrFail();
      $tabIndice = json_decode(json_encode($lieu), true);
      foreach($tabIndice as $indice){
        if (!isset($indice)){
          $indice = filter_var($request->getParsedBody()['indice'], FILTER_SANITIZE_STRING);
        }
      }
    }

    //suppression d'un indice
    public function deleteIndice(Request $request, Response $response, $args){
      
    }
}
