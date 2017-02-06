<?php
namespace api\util;

class Util
{
    static function createLinks($baseUrl, $associateModels, $putSelf){
        if($putSelf)    $links = ['self'=>['href'=>$baseUrl]];
        if(!is_null($associateModels)){
            foreach ($associateModels as $associateModel){
                $links[$associateModel]=['href'=>$baseUrl."/$associateModel"];
            }
        }
        return $links;
    }

}