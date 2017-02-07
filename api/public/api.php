<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 13/12/16
 * Time: 16:34
 */
use api\AppInit;

use api\controller\UtilisateurController;

use api\controller\LieuxController;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as DB;
require_once '../vendor/autoload.php';


AppInit::bootEloquent('../conf/conf.ini');

$configuration = [
    'settings'=>[
        'displayErrorDetails'=>true,
        'production'=>false],
];
$configuration['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $c['response']
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode(["Message"=>'Method must be one of: ' . implode(', ', $methods)]));
    };
};

$configuration['notFoundHandler'] = function ($c) {
    return function ($request, $response){
        return $response->withStatus(404)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode(["Message"=>'URI not found']));
    };
};

$c = new \Slim\Container($configuration);
$app = new Slim\App($c) ;

$app->get('/lieu/{id}',
function (Request $req, Response $resp, $args){
  return (new LieuxController($this))->getLieuById($req, $resp, $args);
})->setName('lieu');

$app->get('/lieux',
  function (Request $req, Response $resp, $args){
    return (new LieuxController($this))->getLieux($req, $resp, $args);
  })->setName('getAllLieux');

  $app->get('/destFinales',
  function (Request $req, Response $resp, $args){
    return (new LieuxController($this))->getDestFinale($req, $resp, $args);
  })->setName('getDestFinale');

  //Obtenir les indications de chaque lieu pour un chemin
  $app->get('/indications/{id}',
  function (Request $req, Response $resp, $args){
    return (new LieuxController($this))->getIndications($req, $resp, $args);
  })->setName('indications');

  // Obtenir tous les indices pour une destination finale
  $app->get('/indices/{id}',
  function (Request $req, Response $resp, $args){
    return (new LieuxController($this))->getIndices($req, $resp, $args);
  })->setName('indices');

  $app->get('/chemin/{id}',
  function  (Request $req, Response $resp, $args){
    return (new LieuxController($this))->getChemin($req, $resp, $args);
  })->setName('chemin');

  $app->get('/destination/chemin/{id}',
  function  (Request $req, Response $resp, $args){
    return (new LieuxController($this))->getDestByChemin($req, $resp, $args);
  })->setName('destinationByChemin');



$app->run();
