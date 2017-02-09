<?php
use api\model\Lieu;
include '../vendor/autoload.php' ;


$loader = new Twig_Loader_Filesystem( 'templates');
$twig = new Twig_Environment($loader,
array('debug' => true));

$tmpl = $twig->loadTemplate('template/lieux.html.twig');

$lieux = Lieu::select()->get();
$tabLieux = json_decode(json_encode($lieux));
var_dump($tabLieux);
$tmpl->display( array (
'title' => 'Ah, quel BEAU TITRE',
 'message' => 'Oh, le beau Message'
 )) ;
