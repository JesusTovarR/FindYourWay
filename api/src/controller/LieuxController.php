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

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function getLieux(Request $request, Response $response, $args)
    {
        $response = $response->withHeader('Content-type', 'application/json');
        try {
            $lieux = Lieu::all();
            $cat_json = [];
            foreach ($lieux as $lieu) {
                $links = Util::createLinks($this->container['router']->pathFor('lieu',['id'=>$lieu->id]), Lieu::$associatedModels, true);
                $tab = ['lieu' => $lieu, 'links' => $links];
                array_push($cat_json, $tab);
            }
            $response->getBody()->write(json_encode(['lieux' => $cat_json]));
        } catch (ModelNotFoundException $e) {
            $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
            $errorMessage = ["error" => "ressource not found : " . $this['router']->pathFor('lieux')];
            $response->getBody()->write(json_encode($errorMessage));
        }
        return $response;
    }
}