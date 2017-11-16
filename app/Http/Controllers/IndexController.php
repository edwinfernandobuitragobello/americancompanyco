<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Productos;
use App\SubCategoria;
use App\Compras;
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
        $session = $_SESSION['carrito'];
        session_destroy();
        session_start();
        for ($i=0; $i < count($session) ; $i++) { 
            if ($session[$i]['id']!=$_POST['id']) {
                $_SESSION['carrito'][] = $session[$i];
            }
        }
        redirect()->back();
    }
    public function vaciar_carrito()
    {
        session_start();
        session_destroy();
    }
    public function guardar_datos(){
        session_start();
        $_SESSION['nombre'] = $_POST['nombre'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['telefono'] = $_POST['telefono'];
    }
    public function respuesta_carrito(){
        session_start();
        if ($_REQUEST['transactionState'] == 4 ) {
            $compras_consulta = Compras::where('referenceCode',$_REQUEST['referenceCode'])->get();
            if (count($compras_consulta)>0) {
                $estadoTx = "La compra ya había sido guardada. Gracias por contar con nosotros para su compra. ¡Pronto estaremos en contacto!";
                $_SESSION['respuesta_compra'] = $estadoTx;
            }else{
                $ApiKey = "yMJebw04DS6moX3CI295edT01z";
                $TX_VALUE = $_REQUEST['TX_VALUE'];
                $merchant_id = $_REQUEST['merchantId'];
                $referenceCode = $_REQUEST['referenceCode'];
                $New_value = number_format($TX_VALUE, 1, '.', '');
                $currency = $_REQUEST['currency'];
                $transactionState = $_REQUEST['transactionState'];
                $estadoTx = "Transacción aprobada";
                $compra = new Compras();
                $compra->nombre = $_SESSION['nombre']; 
                $compra->email = $_SESSION['email']; 
                $compra->telefono = $_SESSION['telefono']; 
                $compra->pedido = json_encode($_SESSION['carrito']);
                $compra->merchant_id = $_REQUEST['merchantId'];
                $compra->referenceCode = $_REQUEST['referenceCode'];
                $compra->TX_VALUE = $_REQUEST['TX_VALUE'];
                $compra->New_value = number_format($TX_VALUE, 1, '.', '');
                $compra->currency = $_REQUEST['currency'];
                $compra->transactionState = $_REQUEST['transactionState'];
                $compra->firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
                $compra->firmacreada = md5("$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState");
                $compra->firma = $_REQUEST['signature'];
                $compra->reference_pol = $_REQUEST['reference_pol'];
                $compra->cus = $_REQUEST['cus'];
                $compra->extra1 = $_REQUEST['description'];
                $compra->pseBank = $_REQUEST['pseBank'];
                $compra->lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
                $compra->transactionId = $_REQUEST['transactionId'];
                $compra->save();
                session_destroy();
                session_start();
                $_SESSION['respuesta_compra'] = $estadoTx;
            } 
        }
        else if ($_REQUEST['transactionState'] == 6 ) {
            $estadoTx = "Transacción rechazada, Por favor inténtalo de nuevo o ponte en contacto con nosotros.";
            $_SESSION['respuesta_compra'] = $estadoTx;
        }

        else if ($_REQUEST['transactionState'] == 104 ) {
            $estadoTx = "Ha ocurrido un error en el pago, por favor inténtalo de nuevo o ponte en contacto con nosotros";
            $_SESSION['respuesta_compra'] = $estadoTx;
        }

        else if ($_REQUEST['transactionState'] == 7 ) {
            $estadoTx = "Transacción pendiente, por favor inténtalo de nuevo o ponte en contacto con nosotros";
            $_SESSION['respuesta_compra'] = $estadoTx;
        }
        else {
            $estadoTx=$_REQUEST['mensaje'];
            $_SESSION['respuesta_compra'] = $estadoTx;
        }
        return redirect('/carrito_compras');
    }
}