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
        $producto = DB::table('productos')->where('id_prod',$id)
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
    public function agregar_producto(){
        session_start();
        // session_destroy(); return;
        $array['id'] =$_POST['id'];
        $array['cant'] =$_POST['cant'];
        $array['nombre'] =$_POST['nombre'];
        $array['precio'] =$_POST['precio'];
        $array['foto'] =$_POST['foto'];
        $aux = 0;
        $fila = 0;
        if (isset($_SESSION['carrito'])) {
            for ($i=0; $i < count($_SESSION['carrito']); $i++) { 
                if ($_SESSION['carrito'][$i]['id']!=$_POST['id']) {
                    $aux++;
                }else{
                    $fila = $i;
                }
            }
            if (count($_SESSION['carrito'])==$aux) {
                $_SESSION['carrito'][] = $array;
                echo "Su pedido se agregó correctamente";
            }else{
                $cantidad_antigua = $_SESSION['carrito'][$fila]['cant'];
                $_SESSION['carrito'][$fila]['cant'] = $_POST['cant']+$_SESSION['carrito'][$fila]['cant'];
                echo "Su pedido se actualizó de ".$cantidad_antigua." unidades a ".$_SESSION['carrito'][$fila]['cant']." unidades";
            }
        }else{
            $_SESSION['carrito'][] = $array;
            echo "Su pedido se agregó correctamente";
        }
    }
    public function carrito_compras($id=null)
    {
        $categorias = Categorias::with(['sub_categorias' => function ($query) {
            $query->where('activo_sub', '=', '1');
        }])->where('activo',1)->get();
        //productos para las categorias
        $productos = Productos::orderBy('updated_at', 'desc')->where('activo_prod',1)->limit(12)->get();
        return view('carrito_compras', compact('categorias','productos'));
    }
    public function eliminar_producto()
    {
        session_start();
        // session_destroy(); return;
        $session = $_SESSION['carrito'];
        session_destroy();
        session_start();
        for ($i=0; $i < count($session) ; $i++) { 
            if ($session[$i]['id']!=$_POST['id']) {
                $_SESSION['carrito'][] = $session[$i];
                //echo "Su pedido se agregó correctamente";
            }
        }
        redirect()->back();
    }
    public function vaciar_carrito()
    {
        session_start();
        session_destroy();
    }
}