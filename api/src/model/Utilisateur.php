<?php

namespace api\model;

Class Utilisateur extends Model {
  protected  $table = "utilisateur";
  protected  $primaryKey = "id_utilisateur" ;
  public $timestamps =false;
}
