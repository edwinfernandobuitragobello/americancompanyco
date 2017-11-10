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
							  	<span>Search</span>
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
 <div class="main">
 	<div class="wrap">
     <div class="preview-page">
				  <div class="contact-form">
				  	<h3>Contáctenos</h3>
					    <form action="{{ url('/contacto/enviar') }}" method="POST" role="form">
						    	<input name="userName" type="text" class="textbox textbox1" value="Nombre..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Nombre...';}" >
						    	<input name="userphone" type="text" class="textbox" value="Teléfono..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Teléfono...';}">
						    	<input name="userEmail" type="text" class="textbox" value="Correo..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Correo...';}">
						    	<input name="usersubject" type="text" class="textbox" value="Asunto..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Asunto...';}">
						    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						    	<div class="clear"></div>
						    <div>
						    	<span><textarea name="userMsg" value="Message:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Mensaje </textarea></span>
						    </div>
						   <div>
						   		<input type="submit" value="Enviar"  class="mybutton">
						   		<div class="clear"></div>
						  </div>
					    </form>
				  </div>
				  <div class="contact_info">
			    	  <div class="map">
					   	    <iframe width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8154416.20766379!2d-76.6205071530077!3d3.667249216646498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e15a43aae1594a3%3A0x9a0d9a04eff2a340!2sColombia!5e0!3m2!1ses-419!2sco!4v1510285793628" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					  </div>
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
		</script>
    	<a href="#" id="toTop"> </a>
        <script type="text/javascript" src="{{ asset('js/navigation.js') }}"></script>
	</body>
</html>
