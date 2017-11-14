<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>American company</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link href="{{ asset('css/mystyle.css') }}" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="{{ asset('js/jquery-1.9.0.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
</head>
<body>
	<div class="header">
  	  		<div class="wrap">
				<div class="header_top">
					<div class="logo">
						<a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="" /></a>
					</div>
						<div class="header_top_right">
							  <div class="search_box">
							  	<span>Buscar</span>
					     		<form action="{{ url('/productos') }}" method="GET" role="form">
					     			<input name="p" type="text" value=""><input type="submit" value="">
					     		</form>
					     		<div class="clear"></div>
					     	</div>
					</div>
			     <div class="clear"></div>
  		    </div>     
  		    <div class="navigation">
  		    	<a class="toggleMenu" href="#">Menú</a>
					<ul class="nav">
						<li>
							<a href="{{url('/')}}">Inicio</a>
						</li>
						<li  class="test">
							<a href="#">Categorías</a>
							<ul>
								@foreach($categorias as $categoria)
									<li>
										<a >{{ $categoria->nombre }}</a>
										<ul>
											@foreach($categoria->sub_categorias as $sub_categoria)
												<li><a href="{{url('sub-categoria')}}/{{$sub_categoria->id_sub}}">{{$sub_categoria->nombre_sub}}</a></li>
											@endforeach
										</ul>
									</li>
								@endforeach
							</ul>
						</li>
						<li>
							<a href="{{url('/sobre_nosotros')}}">Sobre nosotros</a>
						</li>
						<li>
							<a href="{{url('/preguntas_frecuentes')}}">Preguntas frecuentes</a>
						</li>
						<li>
							<a href="{{url('/descargar_catalogo')}}">Descargar catálogo</a>
						</li>
						<li>
							<a href="{{url('/carrito_compras')}}">Carrito de compras</a>
						</li>
						<li>
							<a href="{{url('/contacto')}}">Contáctenos</a>
						</li>
					</ul>
   		    </div>
        </div>
	</div>
 	<div class="main">
	 	<div class="wrap">
	     	<div class="preview-page">
			    <h3>Carrito de compras</h3>
			    <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
			    	<thead>
						<tr>
							<th width="8%"></th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
			    	<tbody>
			    		<?php 
			    			session_start();
			    			if (isset($_SESSION['carrito'])) {
			    			 	$producto = $_SESSION['carrito'];
			    			}else{
			    				$producto = array();
			    			} 
			    		?>
						<?php for ($i=0; $i < count($producto) ; $i++) { 
							echo '<tr>
								<td style="vertical-align: middle;"><img class="img_ov" src="'.url('/uploads').'/'.$producto[$i]['foto'].'" width="100%" ></td>
								<td style="vertical-align: middle;">'.$producto[$i]['nombre'].'</td>
								<td style="vertical-align: middle;">'.$producto[$i]['precio'].'</td>
								<td style="vertical-align: middle;">'.$producto[$i]['cant'].'</td>
								<td style="text-align: center; vertical-align: middle;">
										@if($producto->activo_prod==0)
											<button id="submit_activar" class="btn btn-xs btn-success" onclick="submit_activar({{$producto->id_prod}})">
											<i class="ace-icon fa fa-check bigger-120">  ACTIVAR</i>
										@else
											<button id="submit_desactivar" class="btn btn-xs btn-warning" onclick="submit_desactivar({{$producto->id_prod}})">
											<i class="ace-icon fa fa-close bigger-120">  DESACTIVAR</i>
										@endif
									</button>
								</td>
								<td style="text-align: center; vertical-align: middle;">
									<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" onclick="modalOpen({{$producto->id_prod}} , {{$producto->nombre_prod}} , {{$producto->id_categoria_fk}} , {{$producto->id_subcategoria_fk}} , {{$producto->precio}}, {{$producto->descripcion_prod}})">
										<i class="ace-icon fa fa-pencil bigger-120">  EDITAR</i>
									</button>
								</td>
								<td style="text-align: center; vertical-align: middle;">
									<button class="btn btn-xs btn-danger" onclick="submit_eliminar({{$producto->id_prod}})">
										<i class="ace-icon fa fa-trash-o bigger-120">  ELIMINAR</i>
									</button>
								</td>
							</tr>';
			   				 } ?>
					</tbody>
				</table>		    
			</div>		
	    </div> 
    </div>
 </div>
   <div class="footer">
	   	  	<div class="wrap">	
				<div class="copy_right">
					<p>Copy rights (c). All rights Reseverd | American Company</p>
			   	</div>	
			    <div class="footer-nav">
				   	<ul>
				   		<li><a href="">Teléfono 1</a> : 3192889444</li>
				   		<li><a href="">Teléfono 2</a> : 3015744677</li>
				   	</ul>
			    </div>		
	        </div>
    	</div>
        <script type="text/javascript">
			$(document).ready(function() {			
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
    	<a href="#" id="toTop"> </a>
        <script type="text/javascript" src="{{ asset('js/navigation.js') }}"></script>
	</body>
</html>
