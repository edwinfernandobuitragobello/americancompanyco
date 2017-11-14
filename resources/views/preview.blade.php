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
<script src="{{ asset('js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
<link href="{{ asset('css/easy-responsive-tabs.css') }}" rel="stylesheet" type="text/css" media="all"/>
 <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
<link rel="stylesheet" href="{{ asset('css/etalage.css') }}">
<script src="{{ asset('js/jquery.etalage.min.js') }}"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 300,
					thumb_image_height: 400,
					source_image_width: 900,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
		</script>
	  <script src="{{ asset('js/star-rating.js') }}" type="text/javascript"></script>
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
				     		<form>
				     			<input type="text" value=""><input type="submit" value="">
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
       <!------------End Header ------------>
   <div class="main">
   	   <div class="wrap">
   	 		<div class="preview-page">
   	 	        <div class="section group">
					<div class="cont-desc span_1_of_2">
						<ul class="back-links">
							<li><a href="{{url('/')}}">Inicio</a> ::</li>
							<li><a href="{{url('sub-categoria')}}/{{$producto->id_subcategoria_fk}}">{{$producto->nombre_sub}}</a> ::</li>
							<li>{{$producto->nombre_prod}}</li>
							<div class="clear"> </div>
						</ul>
					    <div class="product-details">	
							<div class="grid images_3_of_2">
								<ul id="etalage">
									<li>
										<a href="optionallink.html">
											<img class="etalage_thumb_image" src="{{ asset('uploads')}}/{{$producto->foto}}" />
											<img class="etalage_source_image" src="{{ asset('uploads')}}/{{$producto->foto}}" title="" />
										</a>
									</li>
									<!-- <li>
										<img class="etalage_thumb_image" src="{{ asset('images/preview-small-img2.png') }}"  />
										<img class="etalage_source_image" src="{{ asset('images/preview-large-img2.jpg') }}" title="" />
									</li> -->
								</ul>
						    </div>
					    	<div class="desc span_3_of_2">
								<h2>{{$producto->nombre_prod}}</h2>
								<p>{!!$producto->descripcion_prod!!}</p>					
								<div class="price">
									<p>Precio: <span>$ {{$producto->precio}}</span></p>
								</div>
								<div class="available">
									<ul>
									  <li><span>Categoría:</span> &nbsp;{{$producto->nombre}}</li>
									  <li><span>Sub-Categoría:</span>&nbsp; {{$producto->nombre_sub}}</li>
								    </ul>
								</div>
								<div class="share-desc">
									<div class="share">
										<p>Número de unidades :</p><input id="cant" type="number" class="text_box" type="text" value="1" min="1" />				
									</div>
									<div class="button"><span><a id="submit_car" onclick="agregar_producto({{$producto->id_prod}},'{{$producto->nombre_prod}}','{{$producto->precio}}','{{$producto->foto}}')">Agregar al carrito</a></span></div>					
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
			  			</div>
	      			</div>
				    <div class="rightsidebar span_3_of_1 sidebar">
						<h3>Productos más visitados</h3>
						<ul class="popular-products">
							@foreach($productos as $producto1)
								<li>
									<h4><a href="preview.html"><?php echo str_limit( $producto1->nombre_prod ,15); ?></a></h4>
								    <a href="{{url('/producto')}}/{{$producto1->id_prod}}"><img src="{{ asset('uploads') }}/{{($producto1->foto)}}" alt="" /></a>
								    <div class="price-details">
								        <div class="price-number">
											<p><span class="rupees line-through">$ {{($producto1->precio*1.1)}}</span> &nbsp; <span class="rupees">$ {{$producto1->precio}}</span></p>
									    </div>
								       		<div class="add-cart">								
												<h4><a href="{{url('/producto')}}/{{$producto1->id_prod}}">Ver más</a></h4>
										    	</div>
										    <div class="clear"></div>
									</div>					 
								</li>
							@endforeach
					    </ul>
					</div>
	 		    </div>
 		 		</div>
   	 		</div>
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
			function agregar_producto(id,nombre,precio,foto){
		        var cant = $('#cant').val();
		        var host = "http://americancompany.com.co/public/";
		        $.ajax({
		            type: "POST",
		            url: host + '/agregar_producto',
		            data: {"_token": "{{ csrf_token() }}",id: id,cant: cant, nombre: nombre, precio: precio, foto: foto},
		            success: function( msg ) {
		            	var cant = $('#cant').val('1');
		                alert(msg);
		            }
		        });
		    };
		</script>
    	<a href="#" id="toTop"> </a>
        <script type="text/javascript" src="{{ asset('js/navigation.js') }}"></script>
	</body>
</html>

