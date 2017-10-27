<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    public function sub_categorias(){
    	return $this->belongsTo('App\SubCategoria', 'id_categoria_fk', 'id_prod');
    }
}
