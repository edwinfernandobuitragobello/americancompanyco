<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use Auth;
use Illuminate\Support\Facades\DB;

class AdministradorController extends Controller
{
	public function categorias(Request $request)
    {
    	$categorias = Categorias::All();
    	return view('categoriasAdmin', compact('categorias'));
    }
    public function crear_categoria(Request $request)
    {
    	$categoria = new Categorias();
        $categoria->nombre = $request->name;
        $categoria->save();
        return redirect()->back()->with('success', 'Categoria creada con exito');
    }
    
}
