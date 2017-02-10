<?php

namespace api\model;
use Illuminate\Database\Eloquent\Model;
class Utilisateur extends Model {
  protected  $table = "utilisateur";
  protected  $primaryKey = "id_utilisateur" ;
  public $timestamps =false;
}
