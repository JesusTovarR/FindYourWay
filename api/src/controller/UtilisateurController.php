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
use Exception;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UtilisateurController extends AbstractController
{

    public function __construct($var)
    {
        $this->container = $var;
    }

    public function getUrilisateurs(Request $request, Response $response, $args)
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

    public function addUser(Request $request, Response $response, $args){
        try{
        $user = new Utilisateur;
        $user->nom = filter_var($request->getParsedBody()['nom'], FILTER_SANITIZE_STRING);
        $user->email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $user->password = password_hash(filter_var($request->getParsedBody()['password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
        $user->nv_droit = 100;
        $user->save();
        $response = $this->json_success($response, 201, "utilisateur créé");
      }catch(Exception $e){
        $response = $this->json_error($response, 500, $e->getCode());
        return $response;
      }
      return $response;
    }


//a finir
    public function checkUser(Request $request, Response $response, $args){
      $user = select()->where('nom', '=', filter_var($request->getParsedBody()['nom'], FILTER_SANITIZE_STRING));

      if($user){
        if(password_verify($user->password){

        }
      }
    }
}
