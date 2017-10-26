<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $table = 'sub_categorias';
    protected $primaryKey = 'id_sub';
    public function categorias(){
    	return $this->belongsTo('App\Categorias', 'id_categoria_fk', 'id');
    }
}
