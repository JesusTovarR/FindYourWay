<?php
/**
 * Created by PhpStorm.
 * User: Jesus Tovar
 * Date: 06/02/2017
 * Time: 05:01 PM
 */
namespace api\controller;

use api\model\Utilisateur;
use api\controller\AbstractController;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UtilisateurController extends AbstractController
{

    public function __construct($var)
    {
        $this->container = $var;
    }

    public function getUrilisateurs(Request $request, Response $response)
    {
        try {
            $response = $response->withStatus(200)->withHeader('Content-type', 'application/json');
            $utilisateurs = Utilisateur::all();

            $col = array();
            $utilisateurs = json_decode($utilisateurs->toJson());

            foreach ($utilisateurs as $utilisateur) {
                array_push($col, ['utilisateur' => (array)$utilisateur,
                                  'link'=> ['self'=>
                                           ['href'=>$this->container['router']->pathFor('getUtilisateurById',['id'=>$utilisateur->id_utilisateur])]]]);
                }
                $response->getBody()->write(json_encode($col));
            } catch (ModelNotFoundException $e) {
                $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
                $errorMessage = ["error" => "ressource not found : " . $this['router']->pathFor('getUtilisateurById')];
                $response->getBody()->write(json_encode($errorMessage));
            }
            return $response;
    }

    public function getUrilisateurById(Request $request, Response $response, $args)
    {
        try {
            $utilisateur = Utilisateur::select()->where('id_utilisateur', '=', $args['id'])->firstOrFail();
            $response = $this->json_success($response, 200, $utilisateur->toJson());
        } catch(ModelNotFoundException $e) {
            $response = $response->withStatus(404)->withHeader('Content-type', 'application/json');
            $errorMessage = ["error" => "ressource not found : "];
            $response->getBody()->write(json_encode($errorMessage));
        }
        return $response;
    }
}