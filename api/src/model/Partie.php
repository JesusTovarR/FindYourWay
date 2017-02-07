<?php

namespace api\model;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate \Database\Manager\Manager as DB;

class Partie extends Model{
      protected $table = "partie";
      protected $primaryKey = "id";
      public $timestamps = false;
}
