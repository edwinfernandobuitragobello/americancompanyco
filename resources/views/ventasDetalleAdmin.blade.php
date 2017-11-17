<?php 
	
	$compras[0]->pedido = json_decode($compras[0]->pedido);
?>
@include('headerAdmin')
<!-- INICIO DE CREAR LA CATEGORIA -->
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{url('')}}/admin/productos">Inicio</a>
							</li>
							<li class="active">Ventas</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="widget-box ">
							<div class="widget-header">
								<h4 class="widget-title">{{$compras[0]->nombre}} :: {{$compras[0]->email}} :: {{$compras[0]->telefono}}</h4>
							</div>
							<div class="widget-body" >
								<div class="row">
									<div class="col-xs-12">
										<!-- LISTA DE CATEGORIAS -->
										
										<div class="modal-body no-padding">
											<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
										    	<thead>
													<tr>
														<th width="8%"></th>
														<th>Nombre</th>
														<th>Precio unitario</th>
														<th>Cantidad</th>
														<th>Total</th>
													</tr>
												</thead>
										    	<tbody>
													<?php $total = 0; for ($i=0; $i < count($compras[0]->pedido) ; $i++) { 
														$total = $total + ($compras[0]->pedido[$i]->cant*str_replace(".", "", $compras[0]->pedido[$i]->precio));
														echo '<tr>
															<td style="vertical-align: middle;"><img class="img_ov" src="'.url('/uploads').'/'.$compras[0]->pedido[$i]->foto.'" width="100%" ></td>
															<td style="vertical-align: middle;">'.$compras[0]->pedido[$i]->nombre.'</td>
															<td style="vertical-align: middle;">'.$compras[0]->pedido[$i]->precio.'</td>
															<td style="vertical-align: middle;">'.$compras[0]->pedido[$i]->cant.'</td>
															<td style="vertical-align: middle;">'.$compras[0]->pedido[$i]->cant*$compras[0]->pedido[$i]->precio.'</td>
														</tr>';
										   				 } ?>
												</tbody>
											</table>
											<p style="font-size: 30px; float:right;">Valor total pagado : <?php echo $total ?> </p>
										</div>
									</div>
								</div>
							</div>
						</div><!-- PAGE CONTENT ENDS -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
<!-- TERMINAR DE CREAR LA CATEGORIA -->

<!-- MODAL -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="tituloModal">Editar categoria</h4>
        </div>
        <div class="alert alert-danger" id="alert_error_edit" style="display: none">
	    	<p>Corrige el siguiente error:</p>
	        <ul>
	            <li>Escribe el nombre de la categoria</li>
	        </ul>
	    </div>
        <form class="form-horizontal" action="{{ url('/admin/editar_categoria/') }}" method="POST" role="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" id="id" name="id" value="">
			<div class="form-group">
				<br>
				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Nombre </label>

				<div class="col-sm-7">
					<input type="text" id="form-field-1_edit" name="categoria" placeholder="Categoria" class="col-xs-10 col-sm-9" value="" />
				</div>
			</div>
		
	        <div class="modal-footer">
	        	<button class="btn btn-info" id="editar_categoria" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Editar
				</button>
	          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
	        </div>
        </form>
      </div>
      
    </div>
  </div>
  
</div>

@include('footerAdmin')
			<script type="text/javascript">
	$(document).ready(function(){
		//función click submit
        $("#submit_categoria").click(function(){
            var nombre = $("#form-field-1").val();
            if(nombre == ""){
                $('#alert_error').css('display','block');
                return false;
            }
        });
        $("#editar_categoria").click(function(){
            var nombre = $("#form-field-1_edit").val();
            if(nombre == ""){
                $('#alert_error_edit').css('display','block');
                return false;
            }
        });
	});
	var url = "http://americancompany.com.co/public";
	function por_atender(id){
    	window.location.href = url+"/admin/por_atender/"+id;
    }
    function atendido(id){
    	window.location.href = url+"/admin/atendido/"+id;
    }
    function venta_detalle(id){
    	window.location.href = url+"/admin/venta_detalle/"+id;
    }
    function modalOpen(id,texto){
    	$('#id').val(id);
    	$('#form-field-1_edit').val(texto);
    }	
</script>
