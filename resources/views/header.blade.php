<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>American Company</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="{{ asset('js/jquery-1.9.0.min.js') }}"></script> 
<script src="{{ asset('js/jquery.openCarousel.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>

</head>
<body>
	<div class="header">
  	  		<div class="wrap">
				<div class="header_top">
					<div class="logo">
						<a href="/"><img  src="{{ asset('images/logo.png') }}" alt="" /></a>
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
	  		    <div class="navigation" >
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
  		     	<!-- <div class="header_bottom">
			   		<div class="slider-text">
				   		<h2>Lorem Ipsum Placerat <br/>Elementum Quistue Tunulla Maris</h2>
				   		<p>Vivamus vitae augue at quam frigilla tristique sit amet<br/> acin ante sikumpre tisdin.</p>
				   		<a href="#">Sitamet Tortorions</a>
	  	      		</div>
		  	    <div class="slider-img">
		  	      	<img src="{{ asset('images/slider-img.png') }}" alt="" />
		  	    </div>
	  	     	<div class="clear"></div>
	        </div> -->
   		</div>
   </div>
   <!------------End Header ------------>