<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 13/12/16
 * Time: 16:34
 */
use api\AppInit;
use api\controller\UtilisateurController;

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
$app = new Slim\App($c);
//$app->get('/lieux', LieuxController::class.':getLieux')->setName('lieux');
$app->get('/utilisateurs', UtilisateurController::class.':getUrilisateur')->setName('utilisateur');
$app->run();
