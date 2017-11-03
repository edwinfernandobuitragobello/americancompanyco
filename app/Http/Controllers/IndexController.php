<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Productos;
use App\SubCategoria;
use Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index($id=null)
    {
    	//$categorias = Categorias::All()->where('activo',1);
    	$categorias = Categorias::with(['sub_categorias' => function ($query) {
		    $query->where('activo_sub', '=', '1');
		}])->where('activo',1)->get();
		//productos para las categorias
		$productos = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->limit(12)->get();
		//productos para la galeria de productos
		$productos_all = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->where('id_subcategoria_fk',$id)->paginate(12);
		//nombre de la categoria
		$subCategoria = SubCategoria::find($id);
    	return view('index', compact('categorias','productos','productos_all','subCategoria'));
    }
}