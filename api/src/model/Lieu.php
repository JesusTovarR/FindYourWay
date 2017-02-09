<?php

namespace api\model;

use Illuminate\Database\Eloquent\Model as Model;

class Lieu extends Model{
  protected $table = "lieu";
  protected $primaryKey = "id";
  public $timestamps = false;

  public function isDestFinale(){
    $lieu = Lieu::select('indice1', 'indice2', 'indice3', 'indice4', 'indice5')->where('id', '=', $this->id)->firstOrfail();
    if($lieu->indice1 == '' ||
    $lieu->indice2 == '' ||
    $lieu->indice3 == '' ||
    $lieu->indice4 == '' ||
    $lieu->indice5 == ''){
      return 0;
    }else{
      return 1;
    }
  }
}
