<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    public function sub_categorias(){

    	return $this->hasMany('App\SubCategoria', 'id_categoria_fk', 'id');
    }
}
