<?php
/**
 * Created by PhpStorm.
 * User: Jesus Tovar
 * Date: 06/02/2017
 * Time: 05:01 PM
 */
namespace api\controller;

use api\model\Lieu;
use api\model\Chemin;

use api\model\Partie;
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

    public function newGame(Request $request, Response $response, $args){
      $game = new Partie;

      $factory = new \RandomLib\Factory;
      $generator = $factory->getMediumStrengthGenerator();

      $game->token = $generator->generateString(32, 'abcdefghijklmnopqrstuvwxyz123456789');
      $game->distanceDF = 100;
      $score = 0;
      $chemin = new Chemin;

      $destFinales = Lieu::select()->where('dest_finale', '=', 1)->get();
      $nbDestFinales = Lieu::select()->where('dest_finale', '=', 1)->count();
      $lieux = Lieu::select()->get();
      $nbLieux = Lieu::select()->count();

      $tabDest = json_decode(json_encode($destFinales), true);
      $destinationFinale = $tabDest[rand(0, $nbDestFinales-1)];

      $tabLieux = json_decode(json_encode($lieux), true);
      $chemin->id_dest_finale = (int)$destinationFinale;

      $tmp = rand(0, count($tabLieux)-1);
      $chemin->id_lieu1 = (int)$tabLieux[$tmp]['id'];
      unset($tabLieux[$tmp]);
      $tabLieux = array_values($tabLieux);

      $tmp = rand(0, count($tabLieux)-1);
      $chemin->id_lieu2 = (int)$tabLieux[$tmp]['id'];
      unset($tabLieux[$tmp]);
      $tabLieux = array_values($tabLieux);

      $tmp = rand(0, count($tabLieux)-1);
      $chemin->id_lieu3 = (int)$tabLieux[$tmp]['id'];
      unset($tabLieux[$tmp]);
      $tabLieux = array_values($tabLieux);

      $tmp = rand(0, count($tabLieux)-1);
      $chemin->id_lieu4 = (int)$tabLieux[$tmp]['id'];
      unset($tabLieux[$tmp]);
      $tabLieux = array_values($tabLieux);

      $tmp = rand(0, count($tabLieux)-1);
      $chemin->id_lieu5 = (int)$tabLieux[$tmp]['id'];
      unset($tabLieux[$tmp]);
      $tabLieux = array_values($tabLieux);

      $chemin->save();
      $game->id_chemin = $chemin->id;
      $game->save();
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

    public function getLieuById(Request $request, Response $response, $args){
      try{
        $lieu = Lieu::select()->where('id', '=', $args['id'])->firstOrFail();
        $response = $this->json_success($response, 200, $lieu->toJson());
      } catch(ModelNotFoundException $e) {
            $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
            $errorMessage = ["error" => "ressource not found : " . $this['router']->pathFor('lieux')];
            $response->getBody()->write(json_encode($errorMessage));
      }
    }

    public function getChemin(Request $request, Response $response, $args){
      try{
        $chemin = Chemin::select()->where('id', '=', $args['id'])->firstOrFail();
        $response = $this->json_success($response, 200, $chemin->toJson());
      } catch(ModelNotFoundException $e){
        $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
        $errorMessage = ["error" => "ressource not found" ];
        $response->getBody()->write(json_encode($errorMessage));
      }
    }

    public function getDestByChemin(Request $request, Response $response, $args){
      try{
        $chemin = Chemin::select()->where('id', '=', $args['id'])->firstOrFail();
        $dest = Lieu::select()->where('id', '=', $chemin->id_dest_finale)->firstOrFail();
        $response = $this->json_success($response, 200, $dest->toJson());
      } catch (ModelNotFoundException $e){
        $response = $this->json_error($response, 500);
      }
    }


}
