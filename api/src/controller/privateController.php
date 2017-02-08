<?php

namespace api\controller;

use api\model\Lieu;
use api\model\Chemin;
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

    public function addLieu(Request $request, Response $response, $args){
      $lieu = new Lieu;
      if(isset($request->getParsedBody()['coord_x']) &&
         isset($request->getParsedBody()['coord_y']) &&
         isset($request->getParsedBody()['indication']) &&
         isset($request->getParsedBody()['description'])){
           $lieu->coord_x = filter_var($req->getParsedBody()['coord_x'], FILTER_SANITIZE_NUMBER_FLOAT);
           $lieu->coord_y = filter_var($req->getParsedBody()['coord_y'], FILTER_SANITIZE_NUMBER_FLOAT);
           $lieu->indication = filter_var($req->getParsedBody()['indication'], FILTER_SANITIZE_STRING);
           $lieu->description = filter_var($req->getParsedBody()['description'], FILTER_SANITIZE_STRING);
           $lieu->save();
           $response->json_success($response, 200, $lieu->toJson());
      }
    }
