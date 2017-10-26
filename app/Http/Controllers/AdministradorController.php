<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\SubCategoria;
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
        $categorias = Categorias::All();
        $subCategorias = SubCategoria::with('categorias')->paginate(10);
        return view('subCategoriasAdmin', compact('categorias','subCategorias'));
    }
    public function crear_subCategorias(Request $request)
    {
        $subCategoria = new SubCategoria();
        $subCategoria->nombre_sub = $request->subCategoria;
        $subCategoria->id_categoria_fk = $request->id_categoria_fk;
        $subCategoria->activo_sub = 0;
        $subCategoria->save();
        return redirect()->back()->with('success', 'SubCategoria creada con exito');
    }
    public function editar_subCategorias(Request $request)
    {
        $subCategoria = SubCategoria::find($request->id);
        $subCategoria->nombre_sub = $request->subCategoria;
        $subCategoria->id_categoria_fk = $request->id_categoria_fk;
        $subCategoria->save();
        return redirect()->back()->with('success', 'SubCategoria editada con exito');
    }
    public function activar_subCategorias($id)
    {
        $subCategoria = SubCategoria::find($id);
        $subCategoria->activo_sub = 1;
        $subCategoria->save();
        return redirect()->back()->with('success', 'SubCategoria activada con exito');
    }
    public function desactivar_subCategorias($id)
    {
        $subCategoria = SubCategoria::find($id);
        $subCategoria->activo_sub = 0;
        $subCategoria->save();
        return redirect()->back()->with('success', 'SubCategoria desactivada con exito');
    }
    public function eliminar_subCategorias($id)
    {
        $subCategoria = SubCategoria::find($id);
        $subCategoria->delete();
        return redirect()->back()->with('success', 'SubCategoria eliminada con exito');
    }
    ////////////////////////////////////////////
    public function productos(Request $request)
    {
        $categorias = Categorias::All();
        $subCategorias = SubCategoria::with('categorias')->paginate(10);
        /*return view('subCategoriasAdmin', compact('categorias','subCategorias'));*/
        return view('productosAdmin', compact('categorias','subCategorias'));
    }
    public function crear_producto(Request $request)
    {
        var_dump($request->content); return;
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title></title>
        </head>
        <body>
            <div">
                '.$request->content.'
            </div>
            
        </body>
        </html>'; return;
        $subCategoria = new SubCategoria();
        $subCategoria->foto = $request->subCategoria;
        $subCategoria->nombre_prod = $request->producto;
        $subCategoria->descripcion_prod = $request->content;
        $subCategoria->precio = $request->precio;
        $subCategoria->id_subcategoria_fk = $request->id_subcategoria_fk;
        $subCategoria->activo_prod = 0;
        $subCategoria->save();
        return redirect()->back()->with('success', 'SubCategoria creada con exito');
    }
}
