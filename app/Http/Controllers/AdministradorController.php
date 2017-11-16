<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\SubCategoria;
use App\Productos;
use App\Compras;
use Auth;
use Illuminate\Support\Facades\DB;
use File;

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
        //desactivar productos
        $productos = Productos::where('id_categoria_fk',$id)->get();
        foreach ($productos as $producto) {
            $producto = Productos::find($producto->id_prod);
            $producto->activo_prod = 0;
            $producto->save();
        }
        //desactivar subcategorias
        $subCategorias = SubCategoria::where('id_categoria_fk',$id)->get();
        foreach ($subCategorias as $subCategoria) {
            $subCategoria = SubCategoria::find($subCategoria->id_sub);
            $subCategoria->activo_sub = 0;
            $subCategoria->save();
        }

        $categoria = Categorias::find($id);
		$categoria->activo = 0;
		$categoria->save();
		return redirect()->back()->with('success', 'Categoria desactivada con exito');
    }
    public function eliminar_categoria($id)
    {   
        //eliminar productos
        $productos = Productos::where('id_categoria_fk',$id)->get();
        foreach ($productos as $producto) {
            File::delete('uploads/'.$producto->foto);
        }
        $productos = Productos::where('id_categoria_fk',$id);
        $productos->delete();
        //eliminar subcategoria
        $subCategoria = SubCategoria::where('id_categoria_fk',$id);
        $subCategoria->delete();
        //eliminar categoria
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
        //desactivar productos
        $productos = Productos::where('id_subcategoria_fk',$id)->get();
        foreach ($productos as $producto) {
            $producto = Productos::find($producto->id_prod);
            $producto->activo_prod = 0;
            $producto->save();
        }
        $subCategoria = SubCategoria::find($id);
        $subCategoria->activo_sub = 0;
        $subCategoria->save();
        return redirect()->back()->with('success', 'SubCategoria desactivada con exito');
    }
    public function eliminar_subCategorias($id)
    {
        //eliminar productos
        $productos = Productos::where('id_categoria_fk',$id)->get();
        foreach ($productos as $producto) {
            File::delete('uploads/'.$producto->foto);
        }
        $productos = Productos::where('id_categoria_fk',$id);
        $productos->delete();
        //eliminar subcategoria
        $subCategoria = SubCategoria::find($id);
        $subCategoria->delete();
        return redirect()->back()->with('success', 'SubCategoria eliminada con exito');
    }
    ////////////////////////////////////////////
    public function productos(Request $request)
    {
        $productos = Productos::with('sub_categorias')->join('categorias', 'productos.id_categoria_fk', '=', 'categorias.id')->paginate(10); // Notice the shares.* here
        $categorias = Categorias::All();
        return view('productosAdmin', compact('categorias','productos'));
    }
    public function crear_producto(Request $request)
    {
        $producto = new Productos();
        if($request->hasFile('foto')){
            $filename = 'foto'.str_random(40).".".$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('uploads/', $filename);
            $producto->foto = $filename;
        }else{
            $producto->foto = "null";
        }
        $producto->nombre_prod = $request->producto;
        $producto->descripcion_prod = $request->content;
        $producto->precio = $request->precio;
        $producto->id_categoria_fk = $request->id_categoria_fk;
        $producto->id_subcategoria_fk = $request->id_subcategoria_fk;
        $producto->activo_prod = 0;
        $producto->vistas = 0;
        $producto->save();
        return redirect()->back()->with('success', 'Producto creado con exito');
    }
    public function editar_producto(Request $request)
    {
        $producto = Productos::find($request->id);
        if($request->hasFile('foto')){
            $filename = 'foto'.str_random(40).".".$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('uploads/', $filename);
            File::delete('uploads/'.$producto->foto);
            $producto->foto = $filename;
        }
        $producto->nombre_prod = $request->producto;
        $producto->descripcion_prod = $request->content;
        $producto->precio = $request->precio;
        $producto->id_categoria_fk = $request->id_categoria_fk;
        $producto->id_subcategoria_fk = $request->id_subcategoria_fk;
        $producto->activo_prod = 0;
        $producto->save();
        return redirect()->back()->with('success', 'Producto creado con exito');
    }
    public function obtenerSubCategorias($id)
    {
        $subCategorias = SubCategoria::where('id_categoria_fk',$id)->get();
        return $subCategorias;
    }
    public function activar_producto($id)
    {
        $producto = Productos::find($id);
        $producto->activo_prod = 1;
        $producto->save();
        return redirect()->back()->with('success', 'Producto activado con exito');
    }
    public function desactivar_producto($id)
    {
        $producto = Productos::find($id);
        $producto->activo_prod = 0;
        $producto->save();
        return redirect()->back()->with('success', 'Producto desactivado con exito');
    }
    public function eliminar_producto($id)
    {
        $producto = Productos::find($id);
        File::delete('uploads/'.$producto->foto);
        $producto->delete();
        return redirect()->back()->with('success', 'Producto eliminado con exito');
    }
    public function ventas(Request $request)
    {
        $compras = Compras::orderBy('created_at', 'desc')->paginate(10);
        return view('ventasAdmin', compact('compras'));
    }
    public function por_atender($id)
    {
        $compra = Compras::find($id);
        $compra->estado = 1;
        $compra->save();
        return redirect()->back()->with('success', 'Compra atendida con exito');
    }
    public function atendido($id)
    {
        $compra = Compras::find($id);
        $compra->estado = 0;
        $compra->save();
        return redirect()->back()->with('success', 'Compra por atender con exito');
    }
    public function ventas(Request $request)
    {
        $compras = Compras::orderBy('created_at', 'desc')->paginate(10);
        return view('ventasAdmin', compact('compras'));
    }
}
