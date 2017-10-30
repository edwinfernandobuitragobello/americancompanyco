<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
    	//$categorias = Categorias::All()->where('activo',1);
    	$categorias = Categorias::with(['sub_categorias' => function ($query) {
		    $query->where('activo_sub', '=', '1');
		}])->get();
		//echo json_encode($categorias[0]->sub_categorias); return;
    	return view('index', compact('categorias'));
    }
}