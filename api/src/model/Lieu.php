<?php

namespace api\model;

use Illuminate\Database\Eloquent\Model as Model;

class Lieu extends Model{
      protected $table = "lieu";
      protected $primaryKey = "id";
      public $timestamps = false;
}
