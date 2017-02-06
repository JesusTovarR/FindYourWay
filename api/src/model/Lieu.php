<?php

namespace src\model\Lieu;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate \Database\Manager\Manager as DB;

class Lieu extends Model{
      protected $table = "lieu";
      protected $primaryKey = "id";
      public $timestamps = false;


      