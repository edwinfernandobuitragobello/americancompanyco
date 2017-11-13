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
	  		    <div class="navigation">
	  		    	<a class="toggleMenu" href="#">Menú</a>
					<ul class="nav" style="text-align: center;">
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
							<a href="{{url('/contacto')}}">Contactenos</a>
						</li>
					</ul> 
	  		    </div>
   		</div>
   </div>
   <!------------End Header ------------>
  <div class="main">
      <div class="content">
	        <div class="content_top">
	        	<div class="wrap">
	          	   <h3>Últimos Productos</h3>
	          	</div>
	          	<div class="line"> </div>
	          	<div class="wrap">
	          	 <div class="ocarousel_slider">  
      				<div class="ocarousel example_photos" data-ocarousel-perscroll="3">
		                <div class="ocarousel_window">
		                	@foreach($productos as $producto)
		                   		<a href="{{url('/producto')}}/{{$producto->id_prod}}" title="{{$producto->nombre_prod}}"> <img src="{{ asset('uploads') }}/{{$producto->foto}}" width="100px" height="100px" alt="" /><p><?php echo str_limit( $producto->nombre_prod ,15); ?></p></a>
	                   		@endforeach
		                </div>
		               <span>           
		                <a href="#" data-ocarousel-link="left" style="float: left;" class="prev"> </a>
		                <a href="#" data-ocarousel-link="right" style="float: right;" class="next"> </a>
		               </span>
				   </div>
			     </div>  
			   </div>    		
	       </div>
    	  <div class="content_bottom">
    	    <div class="wrap">
    	    	<div class="content-bottom-left">
    	    		<div class="categories">
					   <ul class="nav1">
					  	   <h3>Categorías</h3>
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
					</div>		
    	    	</div>
    	    	
    	    	<div class="content-bottom-right">
    	    	<h3>Productos relacionados con <strong>"{{$palabra}}"</strong></h3>
	            <div class="section group">
	            	@foreach($productos_all as $producto_all)
						<div class="grid_1_of_4 images_1_of_4">
						 	<h4><a href="{{url('/producto')}}/{{$producto->id_prod}}"><?php echo str_limit( $producto_all->nombre_prod ,23); ?></a></h4>
						  	<a href="{{url('/producto')}}/{{$producto->id_prod}}"><img width="120px" height="120px" src="{{ asset('uploads') }}/{{$producto_all->foto}}" alt="" /></a>
						  	<div class="price-details">
						       	<div class="price-number">
									<p><span class="rupees">$ {{$producto_all->precio}}</span></p>
							    </div>
					       		<div class="add-cart">								
									<h4><a href="{{url('/producto')}}/{{$producto->id_prod}}">Ver más</a></h4>
							    </div>
								<div class="clear"></div>
							</div>					 
						</div>
					@endforeach
					<?php if (count($productos_all)==0) {
						echo '<div class="grid_1_of_4 images_1_of_4">
						 		<h4>No se encontraron productos relacionados en esta Sub-Categoría.</h4>
							  </div>';
					}?>
			    </div>
			    <div style="text-align: center">{{$productos_all->appends(Request::only(['p']))->links()}}</div> 
		      </div>
		      <div class="clear"></div>
		   </div>
         </div>
      </div>
    </div>
@include('footer')

