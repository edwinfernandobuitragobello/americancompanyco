@include('header')
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
    	    	<h3>Sub-Categoría  <?php if(isset($subCategoria->nombre_sub)) echo " -> ".$subCategoria->nombre_sub; ?></h3>
	            <div class="section group">
	            	@foreach($productos_all as $producto_all)
						<div class="grid_1_of_4 images_1_of_4">
						 	<h4><a href="{{url('/producto')}}/{{$producto_all->id_prod}}"><?php echo str_limit( $producto_all->nombre_prod ,20); ?></a></h4>
						  	<a href="{{url('/producto')}}/{{$producto_all->id_prod}}"><img width="120px" height="120px" src="{{ asset('uploads') }}/{{$producto_all->foto}}" alt="" /></a>
						  	<div class="price-details">
						       	<div class="price-number">
									<p><span class="rupees">$ {{$producto_all->precio}}</span></p>
							    </div>
					       		<div class="add-cart">								
									<h4><a href="{{url('/producto')}}/{{$producto_all->id_prod}}">Ver más</a></h4>
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
			    <div style="text-align: center">{{$productos_all->links()}}</div> 
		      </div>
		      <div class="clear"></div>
		   </div>
         </div>
      </div>
    </div>
@include('footer')

