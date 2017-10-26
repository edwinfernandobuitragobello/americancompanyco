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
    	$categorias = Categorias::paginate(10);
    	return view('categoriasAdmin', compact('categorias'));
    }
    public function crear_categoria(Request $request)
    {
    	$categoria = new Categorias();
        $categoria->nombre = $request->categoria;
        $categoria->activo = 0;
        $categoria->save();
        return redirect()->back()->with('success', 'Categoria creada con exito');
    }
    public function editar_categoria(Request $request)
    {
        $categoria = Categorias::find($request->id);
        $categoria->nombre = $request->categoria;
        $categoria->save();
        return redirect()->back()->with('success', 'Categoria editada con exito');
    }
    public function activar_categoria($id)
    {
        $categoria = Categorias::find($id);
		$categoria->activo = 1;
		$categoria->save();
		return redirect()->back()->with('success', 'Categoria activada con exito');
    }
    public function desactivar_categoria($id)
    {
        $categoria = Categorias::find($id);
		$categoria->activo = 0;
		$categoria->save();
		return redirect()->back()->with('success', 'Categoria desactivada con exito');
    }
    public function eliminar_categoria($id)
    {
        $categoria = Categorias::find($id);
		$categoria->delete();
		return redirect()->back()->with('success', 'Categoria eliminada con exito');
    }
    //////////////////////////////////////////////
    public function subCategorias(Request $request)
    {
        $categorias = Categorias::paginate(10);
        return view('subCategoriasAdmin', compact('categorias'));
    }
    public function editar_subCategorias(Request $request)
    {
        $categoria = Categorias::find($request->id);
        $categoria->nombre = $request->categoria;
        $categoria->save();
        return redirect()->back()->with('success', 'Categoria editada con exito');
    }
    public function activar_subCategorias($id)
    {
        $categoria = Categorias::find($id);
        $categoria->activo = 1;
        $categoria->save();
        return redirect()->back()->with('success', 'Categoria activada con exito');
    }
    public function desactivar_subCategorias($id)
    {
        $categoria = Categorias::find($id);
        $categoria->activo = 0;
        $categoria->save();
        return redirect()->back()->with('success', 'Categoria desactivada con exito');
    }
    public function eliminar_subCategorias($id)
    {
        $categoria = Categorias::find($id);
        $categoria->delete();
        return redirect()->back()->with('success', 'Categoria eliminada con exito');
    }
    
}
