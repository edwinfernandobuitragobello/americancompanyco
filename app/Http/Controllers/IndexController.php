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
    	$categorias = Categorias::All();
    	// foreach ($projects as $key => $value) {
    	// 	$value->Galery = Galery::select('*')->where('project_id', $value->id)->get();
    	// }
    	//var_dump($categorias); return;
    	return view('index', compact('categorias'));
    }
}