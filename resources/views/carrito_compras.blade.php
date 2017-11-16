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
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
<script type="text/javascript" src="{{ asset('js/jquery-1.9.0.min.js') }}"></script> 
<script src="{{ asset('js/jquery.openCarousel.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/easing.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/move-top.js') }}"></script>
<script src="{{ asset('js/easyResponsiveTabs.js') }}" type="text/javascript"></script>
<link href="{{ asset('css/easy-responsive-tabs.css') }}" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
							<a download="catalogo_american_company_co" href="{{url('/catalogo_american_company_co.pdf')}}">Descargar catálogo</a>
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
 		<?php $total = 0; ?>
	 	<div class="wrap">
	     	<div class="preview-page">
	     		<button style="float: right;" id="submit_activar" class="btn btn-xs btn-danger" onclick="vaciar_carrito()">
					<i class="ace-icon fa fa-check bigger-120">  VACIAR CARRITO</i>
				</button><br>
			    <h3>Carrito de compras</h3>
			    <?php session_start(); if (!isset($_SESSION['respuesta_compra'])) { ?>
				    <?php if (isset($_SESSION['carrito'])) { $producto = $_SESSION['carrito']; ?>
	    			 	<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
					    	<thead>
								<tr>
									<th width="8%"></th>
									<th>Nombre</th>
									<th>Precio unitario</th>
									<th>Cantidad</th>
									<th>Total</th>
									<th></th>
								</tr>
							</thead>
					    	<tbody
								<?php for ($i=0; $i < count($producto) ; $i++) { 
									$total = $total + ($producto[$i]['cant']*$producto[$i]['precio']);
									echo '<tr>
										<td style="vertical-align: middle;"><img class="img_ov" src="'.url('/uploads').'/'.$producto[$i]['foto'].'" width="100%" ></td>
										<td style="vertical-align: middle;">'.$producto[$i]['nombre'].'</td>
										<td style="vertical-align: middle;">'.$producto[$i]['precio'].'</td>
										<td style="vertical-align: middle;">'.$producto[$i]['cant'].'</td>
										<td style="vertical-align: middle;">'.$producto[$i]['cant']*$producto[$i]['precio'].'</td>
										<td style="text-align: center; vertical-align: middle;">
											<button id="submit_activar" class="btn btn-xs btn-warning" onclick="eliminar_carrito('.$producto[$i]['id'].')">
												<i class="ace-icon fa fa-check bigger-120">  ELIMINAR</i>
											</button>
										</td>
									</tr>';
					   				 } ?>
							</tbody>
						</table>
						<p style="font-size: 30px; float:right;">Valor total a pagar : <?php echo $total ?> </p><br><br>
						<input type="hidden" name="carro_input" value="<?php echo $total; ?>"> <br>
						<!-- Trigger the modal with a button -->
						<button style="float: right;" id="modal_esconder" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Pagar ahora</button>
		    		<?php }else{ ?>
		    				<p style="font-size: 30px;">No tienes productos en el carrito</p>

		    		<?php } ?>
		    	<?php }else{ ?>
	    				<p style="font-size: 30px;"> <?php echo $_SESSION['respuesta_compra']; session_destroy(); ?></p>
	    		<?php } ?>			    		    
			</div>		
	    </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Registrarte</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" id="nombre">
		  </div>
		  <div class="form-group">
		    <label for="email">Correo:</label>
		    <input type="email" class="form-control" id="email">
		  </div>
		  <div class="form-group">
		    <label for="telefono">Teléfono:</label>
		    <input type="text" class="form-control" id="telefono">
		  </div>
		  <!-- boton de pago -->
			<?php $referenceCode = uniqid(); ?>
			<form method="post" action="https://gateway.payulatam.com/ppp-web-gateway">
			  <input name="merchantId"    type="hidden"  value="690369"   >
			  <input name="accountId"     type="hidden"  value="693272" >
			  <input name="description"   type="hidden"  value="American Company Co"  >
			  <input name="referenceCode" type="hidden"  value="<?php echo $referenceCode; ?>" >
			  <input name="amount"        type="hidden"  value="<?php echo $total; ?>"   >
			  <input name="tax"           type="hidden"  value="0"  >
			  <input name="taxReturnBase" type="hidden"  value="0" >
			  <input name="currency"      type="hidden"  value="COP" >
			  <input name="signature"     type="hidden"  value="<?php echo md5("yMJebw04DS6moX3CI295edT01z~690369~$referenceCode~".$total."~COP") ?>"  >
			  <input name="test"          type="hidden"  value="0" >
			  <input id="buyerEmail" name="buyerEmail"    type="hidden"  value="" >
			  <input name="responseUrl"    type="hidden"  value="{{url('')}}/respuesta_carrito" >
			  <input name="confirmationUrl"    type="hidden"  value="{{url('')}}/confirmacion_carrito" >
			  
      </div>
      <div class="modal-footer">
      		<input onclick="guardar_datos()" id="submit_carro" class="btn btn-default" name="Submit" type="submit" value="Pagar ahora">
		</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        	$("#nombre").bind('keyup', function(event){
				if (($("#nombre").val()!="") && ($("#email").val()!="") && ($("#telefono").val()!="")) {
					$('#submit_carro').removeAttr('disabled');
				}else{
					$('#submit_carro').attr('disabled','true');	
				}
			});
			$("#email").bind('keyup', function(event){
				if (($("#nombre").val()!="") && ($("#email").val()!="") && ($("#telefono").val()!="")) {
					$('#submit_carro').removeAttr('disabled');
				}else{
					$('#submit_carro').attr('disabled','true');	
				}
			});
			$("#telefono").bind('keyup', function(event){
				if (($("#nombre").val()!="") && ($("#email").val()!="") && ($("#telefono").val()!="")) {
					$('#submit_carro').removeAttr('disabled');
				}else{
					$('#submit_carro').attr('disabled','true');	
				}
			}); 
			$(document).ready(function() {		
				$('#submit_carro').attr('disabled','true');	
				$().UItoTop({ easingType: 'easeOutQuart' });
			});
			function datos_comprador(){
				alert($("#nombre").val());
				location.reload();
			}
			function guardar_datos(){
		        var host = "http://americancompany.com.co/public/";
		        var nombre = $("#nombre").val();
		        var email = $("#email").val();
		        var telefono = $("#telefono").val();
		        $.ajax({
		            type: "POST",
		            url: host + '/guardar_datos',
		            data: {"_token": "{{ csrf_token() }}",nombre: nombre, email: email, telefono:telefono},
		            success: function( msg ) {
		                $("#buyerEmail").val(email);
		            }
		        });
		    };
			function vaciar_carrito(){
		        var host = "http://americancompany.com.co/public/";
		        $.ajax({
		            type: "POST",
		            url: host + '/vaciar_carrito',
		            data: {"_token": "{{ csrf_token() }}"},
		            success: function( msg ) {
		                location.reload();
		            }
		        });
		    };
		    function eliminar_carrito(id){
		        var host = "http://americancompany.com.co/public/";
		        $.ajax({
		            type: "POST",
		            url: host + '/eliminar_producto',
		            data: {"_token": "{{ csrf_token() }}",id: id},
		            success: function( msg ) {
		                location.reload();
		            }
		        });
		    };
		</script>
    	<a href="#" id="toTop"> </a>
        <script type="text/javascript" src="{{ asset('js/navigation.js') }}"></script>
	</body>
</html>
