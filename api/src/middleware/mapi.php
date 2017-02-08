<?php

use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use api\model\Partie;

function checkToken ( Request $rq, Response $rs, callable $next ) {
 // récupérer l'identifiant de cmmde dans la route et le token
 $id = $rq->getAttribute('route')->getArgument( 'id_partie');
 $token = $rq->getQueryParam('token');
 // vérifier que le token correspond à la commande
 try {
 Partie::where('id', '=', $id)
 ->where('token', '=',$token)
 ->firstOrFail();
 } catch (ModelNotFoundException $e) {
 $rs = $rs->withStatus(403)
->withHeader('Content-Type', 'application/json');
 $rs->getBody()
 ->write(json_encode(
['error'=>'no token or invalid token']));
 return $rs;
 };
 return $next($rq, $rs);
};


function addheaders  ( Request $rq, Response $rs, callable $next ) {
	$rs = $next($rq, $rs);
            return $rs->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

}
