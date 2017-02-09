<?php
use api\model\Lieu;
use Illuminate\Database\Eloquent\ModelNotFoundException;
include '../../vendor/autoload.php' ;


$loader = new Twig_Loader_Filesystem( __DIR__.'/templates');
$twig = new Twig_Environment($loader,
array('debug' => true));

$tmpl = $twig->load('lieux.twig');

$lieux = Lieu::select()->get();
$tmpl->display( array (
'title' => 'Ah, quel BEAU TITRE',
 'message' => 'Oh, le beau Message'
 )) ;
