<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Productos;
use App\SubCategoria;
use Auth;
use Illuminate\Support\Facades\DB;
use Mail;

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
    public function producto($id = null){
        //$categorias = Categorias::All()->where('activo',1);
        $categorias = Categorias::with(['sub_categorias' => function ($query) {
            $query->where('activo_sub', '=', '1');
        }])->where('activo',1)->get();
        //productos para las categorias
        $productos = Productos::orderBy('vistas', 'desc')->where('activo_prod',1)->limit(3)->get();
        //productos para la galeria de productos
        $productos_all = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->where('id_subcategoria_fk',$id)->paginate(12);
        //nombre de la categoria
        $producto = DB::table('productos')
            ->join('sub_categorias', 'sub_categorias.id_sub', '=', 'productos.id_subcategoria_fk')
            ->join('categorias', 'productos.id_subcategoria_fk', '=', 'categorias.id')
            ->select('productos.*', 'sub_categorias.nombre_sub', 'categorias.nombre')
            ->get()[0];
        $producto1 = Productos::find($id);
        $producto1->vistas = $producto1->vistas+1;
        $producto1->save();
        //echo json_encode($producto); return;
        return view('preview', compact('categorias','productos','productos_all','producto'));
    }   
    public function contacto(){
        $categorias = Categorias::with(['sub_categorias' => function ($query) {
            $query->where('activo_sub', '=', '1');
        }])->where('activo',1)->get();
        return view('contact', compact('categorias'));
    }
    public function contacto_enviar(Request $request){
        //var_dump($request->userName); return;
        Mail::send('emails.contact',$request->all(),function($msj) use($request){
            $msj->subject($request->usersubject);
            $msj->to('ventas@americancompany.com.co');
        });
        return redirect()->back()->with('success', 'Email enviado con exito');
    }
    public function preguntas_frecuentes(){
        $categorias = Categorias::with(['sub_categorias' => function ($query) {
            $query->where('activo_sub', '=', '1');
        }])->where('activo',1)->get();
        return view('contact', compact('categorias'));
    }
    public function sobre_nosotros(){
        $categorias = Categorias::with(['sub_categorias' => function ($query) {
            $query->where('activo_sub', '=', '1');
        }])->where('activo',1)->get();
        //productos para las categorias
        $productos = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->limit(12)->get();
        return view('sobre_nosotros', compact('categorias','productos'));
    }
    public function productos_busqueda(Request $request){
        $palabra = $request->p;
        //$categorias = Categorias::All()->where('activo',1);
        $categorias = Categorias::with(['sub_categorias' => function ($query) {
            $query->where('activo_sub', '=', '1');
        }])->where('activo',1)->get();
        //productos para las categorias
        $productos = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->limit(12)->get();
        //productos para la galeria de productos
        $productos_all = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->where('nombre_prod','like',"%".$palabra."%")->paginate(12);
        return view('productos_busqueda', compact('categorias','productos','productos_all', 'palabra'));
    }
}