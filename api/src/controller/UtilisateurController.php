<?php
/**
 * Created by PhpStorm.
 * User: Jesus Tovar
 * Date: 06/02/2017
 * Time: 05:01 PM
 */
namespace api\controller;

use api\model\Utilisateur;
use api\util\Util;
use api\controller\AbstractController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UtilisateurController extends AbstractController
{

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getUrilisateur(Request $request, Response $response)
    {
        $response = $response->withHeader('Content-type', 'application/json');
        try {
            $utilisateurs = Utilisateur::all();
            $cat_json = [];
            foreach ($utilisateurs as $utilisateur) {
//                $links = Util::createLinks($this->container['router']->pathFor('utilisateur',['id'=>$utilisateur->id]));
                $tab = ['utilisateurs' => $utilisateur];
                array_push($cat_json, $tab);
            }
            $response->getBody()->write(json_encode(['utilisateur' => $cat_json]));
        } catch (ModelNotFoundException $e) {
            $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
            $errorMessage = ["error" => "ressource not found : " . $this['router']->pathFor('utilisateur')];
            $response->getBody()->write(json_encode($errorMessage));
        }
        return $response;
    }
}