<?php

namespace src\model\Partie;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate \Database\Manager\Manager as DB;

class Lieu extends Model{
      protected $table = "partie";
      protected $primaryKey = "id";
      public $timestamps = false;


