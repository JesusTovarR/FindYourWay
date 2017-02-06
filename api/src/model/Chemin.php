<?php

namespace src\model\Chemin;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Capsule\Manager as DB;

Class Chemin extends Model
{
	protected  $table = "chemin";
	protected  $primaryKey = "id" ;
	public $timestamps =false;
}
