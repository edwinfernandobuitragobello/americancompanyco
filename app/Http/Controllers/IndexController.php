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
    	return view('index', compact('categorias'));
    }
}