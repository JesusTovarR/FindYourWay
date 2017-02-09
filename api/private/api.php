<?php

use api\AppInit;

use api\controller\UtilisateurController;

use api\controller\PrivateController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Middleware\TokenAuthentication;
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
$c['view'] = function($c){
  $view = new \Slim\Views\Twig(__DIR__.'/backoffice/templates', ['cache'=> __DIR__.'/backoffice/templates']);

   return $view;
};

$app = new Slim\App($c) ;

$app->post('/lieu',
function (Request $req, Response $resp, $args){
  return (new privateController($this))->addLieu($req, $resp, $args);
})->setName('addLieu');

$app->post('/lieu/{id}/nouvelIndice',
function (Request $req, Response $resp, $args){
  return (new PrivateController($this))->addIndice($req, $resp, $args);
})->setName('addIndice');

//modification d'un indice
$app->put('/lieu/{id}/modifiedIndice',
function (Request $req, Response $resp, $args){
  return (new privateController($this))->modifyIndice($req, $resp, $args);
})->setName('modifiedIndice');

//suppression d'un lieu lieu/{id}/deletelieu
$app->delete('/lieu/{id}/deleteLieu',
function (Request $req, Response $resp, $args){
  return (new privateController($this))->deleteLieu($req, $resp, $args);
})->setName('deleteLieu');

$app->get('/admin/formLieu',
  function (Request $req, Response $resp, $args){
    return (new privateController($this))->formLieu($req, $resp, $args);
  })->setName('formLieu');


$app->run();
