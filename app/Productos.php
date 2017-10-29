<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_prod';
    public function sub_categorias(){
    	return $this->belongsTo('App\SubCategoria', 'id_subcategoria_fk', 'id_sub');
    }
}
