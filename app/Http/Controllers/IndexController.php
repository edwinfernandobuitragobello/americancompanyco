<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Productos;
use Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
    	//$categorias = Categorias::All()->where('activo',1);
    	$categorias = Categorias::with(['sub_categorias' => function ($query) {
		    $query->where('activo_sub', '=', '1');
		}])->where('activo',1)->get();
		$productos = Productos::limit(12)->get();
		//echo json_encode($productos); return;
    	return view('index', compact('categorias','productos'));
    }
}