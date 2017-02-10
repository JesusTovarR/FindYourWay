<?php

namespace api\model;

use Illuminate\Database\Eloquent\Model as Model;

Class Chemin extends Model
{
	protected  $table = "chemin";
	protected  $primaryKey = "id" ;
	public $timestamps =false;
}
