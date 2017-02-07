<?php
/**
 * Created by PhpStorm.
 * User: Jesus Tovar
 * Date: 06/02/2017
 * Time: 05:01 PM
 */
namespace api\controller;

use api\model\Lieu;
use api\util\Util;
use api\controller\AbstractController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LieuxController extends AbstractController
{

    public function __construct($var)
    {
        $this->container = $var;
    }

    public function getLieux(Request $request, Response $response, $args)
    {

        try {
            $response = $response->withStatus(200)->withHeader('Content-type', 'application/json');
            $lieux = Lieu::all();

            $col = array();
            $lieux = json_decode($lieux->toJson());

            foreach ($lieux as $lieu) {
              array_push($col, ['lieu' => (array)$lieu,
                                'link' => ['self'=>
                                          ['href'=>$this->container['router']->pathFor('lieu',['id' => $lieu->id])]]]);
            }
            $response->getBody()->write(json_encode($col));
        } catch (ModelNotFoundException $e) {
            $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
            $errorMessage = ["error" => "ressource not found : " . $this['router']->pathFor('lieux')];
            $response->getBody()->write(json_encode($errorMessage));
        }
        return $response;
    }

    public function getDestFinale(Request $request, Response $response, $args){
      try {
          $response = $response->withStatus(200)->withHeader('Content-type', 'application/json');
          $lieux = Lieu::all();

          $col = array();
          $lieux = json_decode($lieux->toJson());

          foreach ($lieux as $lieu) {
            if($lieu->dest_finale > 0){
              echo'yo';
              array_push($col, ['lieu' => (array)$lieu,
                                'link' => ['self'=>
                                            ['href'=>$this->container['router']->pathFor('lieu',['id' => $lieu->id])]]]);
            }
          }
          $response->getBody()->write(json_encode($col));
      } catch (ModelNotFoundException $e) {
          $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
          $errorMessage = ["error" => "ressource not found : " . $this['router']->pathFor('lieux')];
          $response->getBody()->write(json_encode($errorMessage));
      }
      return $response;
    }
}
