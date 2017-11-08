@include('headerAdmin')
<!-- INICIO DE CREAR LA CATEGORIA -->
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>
							<li class="active">Sub-Categorías</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="widget-box collapsed">
							<div class="widget-header">
								<h4 class="widget-title">Crear Sub-Categorías</h4>

								<div class="widget-toolbar">
									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-down"></i>
									</a>
								</div>
							</div>
							<div class="widget-body" style="padding-left: 5%">
								<div class="row">
									<div class="col-xs-11">
										<!-- PAGE CONTENT BEGINS -->
										<br>
										<div class="alert alert-danger" id="alert_error" style="display: none">
									    	<p>Corrige el siguiente error:</p>
									        <ul id="errores">
									            
									        </ul>
									    </div>
										<form class="form-horizontal" action="{{ url('/admin/crear_subCategorias') }}" method="POST" role="form">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="form-group">
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Nombre </label>

												<div class="col-sm-7">
													<input type="text" id="form-field-1" name="subCategoria" placeholder="Sub-Categoria" class="col-xs-10 col-sm-6" />
												</div>
												<br>

												<label class="col-sm-5 control-label no-padding-right" for="form-field-select-3">Sub-Categoría</label>
												<br>
												<div class="col-sm-7">
													<select class=" chosen-select col-sm-6" data-placeholder="Selecionar categoría..." name="id_categoria_fk" id="id_categoria_fk">
														<option value="">Selecione una categoría</option>
														@foreach($categorias as $categoria)
															<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="clearfix form-actions">
												<div class="col-md-offset-5 col-md-7">
													<button class="btn btn-info" id="submit_subCategoria" type="submit">
														<i class="ace-icon fa fa-check bigger-110"></i>
														Crear
													</button>
												</div>
											</div>
											<div class="hr hr-24"></div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="widget-box">
							<div class="widget-header">
								<h4 class="widget-title">Lista de Sub-Categorías</h4>

								<div class="widget-toolbar">
									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>
								</div>
							</div>
							<div class="widget-body">
							<!-- LISTA DE CATEGORIAS -->
								<div class="modal-body no-padding">
									<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Categoría</th>
												<th>
													<i class="ace-icon fa fa-clock-o bigger-110"></i>
													Actualizado
												</th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</thead>

										<tbody>
											
											@foreach($subCategorias as $subCategoria)
												<tr>
													<td>{{ $subCategoria->nombre_sub }}</td>
													
													<td>{{ $subCategoria->categorias->nombre }}</td>
													<td>{{ $subCategoria->updated_at }}</td>
													<td style="text-align: center;">
															@if($subCategoria->activo_sub==0)
																<button id="submit_activar" class="btn btn-xs btn-success" onclick="submit_activar({{$subCategoria->id_sub}})">
																<i class="ace-icon fa fa-check bigger-120">  ACTIVAR</i>
															@else
																<button id="submit_desactivar" class="btn btn-xs btn-warning" onclick="submit_desactivar({{$subCategoria->id_sub}})">
																<i class="ace-icon fa fa-close bigger-120">  DESACTIVAR</i>
															@endif
														</button>
													</td>
													<td style="text-align: center;">
														<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" onclick="modalOpen('{{$subCategoria->id_sub}}' , '{{$subCategoria->nombre_sub}}' , '{{$subCategoria->id_categoria_fk}}')">
															<i class="ace-icon fa fa-pencil bigger-120">  EDITAR</i>
														</button>
													</td>
													<td style="text-align: center;">
														<button class="btn btn-xs btn-danger" onclick="submit_eliminar({{$subCategoria->id_sub}})">
															<i class="ace-icon fa fa-trash-o bigger-120">  ELIMINAR</i>
														</button>
													</td>
												</tr>
											@endforeach
											
										</tbody>
									</table>
									<div style="text-align: center">{{$subCategorias->links()}}</div> 
								</div>
							</div>
						</div>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
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
	        <ul id="errores_edit">
	            
	        </ul>
	    </div>
        <form class="form-horizontal" action="{{ url('/admin/editar_subCategorias/') }}" method="POST" role="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<br>
			<div class="form-group">
				<input type="hidden" id="id" name="id" value="">
				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Nombre </label>

				<div class="col-sm-8">
					<input type="text" id="form-field-1_edit" name="subCategoria" placeholder="Sub-Categoria" class="col-xs-10 col-sm-6" />
				</div>
				<br>

				<label class="col-sm-4 control-label no-padding-right" for="form-field-select-3">Sub-Categoría</label>
				<br>
				<div class="col-sm-8">
					<select class=" chosen-select col-sm-6" data-placeholder="Selecionar categoría..." name="id_categoria_fk" id="id_categoria_fk_edit">
						<option value="">Selecione una categoría</option>
						@foreach($categorias as $categoria)
							<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="modal-footer">
	        	<button class="btn btn-info" id="editar_subCategoria" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Editar
				</button>
	          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
	        </div>
		</form>
      
    </div>
  </div>
  
</div>

@include('footerAdmin')
<script type="text/javascript">
	$(document).ready(function(){
		//función click submit
        $("#submit_subCategoria").click(function(){
            var nombre = $("#form-field-1").val();
            var id_categoria_fk = $("#id_categoria_fk").val();
            $('#errores').html('');
            if((nombre == "") || (id_categoria_fk == "")){
            	if ((nombre == "")) {
            		$('#errores').append('<li>Escribe el nombre de la Sub-Categoría</li>');	
            	}
            	if (id_categoria_fk == "") {
                	$('#errores').append('<li>Selecciona una Categoría</li>');
                }
                $('#alert_error').css('display','block');
                return false;
            }
        });
        $("#editar_subCategoria").click(function(){
            var nombre = $("#form-field-1_edit").val();
            var id_categoria_fk = $("#id_categoria_fk_edit").val();
            $('#errores_edit').html('');
            if((nombre == "") || (id_categoria_fk == "")){
            	if ((nombre == "")) {
            		$('#errores_edit').append('<li>Escribe el nombre de la Sub-Categoría</li>');	
            	}
            	if (id_categoria_fk == "") {
                	$('#errores_edit').append('<li>Selecciona una Categoría</li>');
                }
                $('#alert_error_edit').css('display','block');
                return false;
            }
        });
	});
	var url = "http://americancompany.com.co/public/";
	function submit_activar(id){
    	window.location.href = url+"/admin/activar_subCategorias/"+id;
    }
    function submit_desactivar(id){
    	window.location.href = url+"/admin/desactivar_subCategorias/"+id;
    }
    function submit_eliminar(id){
    	window.location.href = url+"/admin/eliminar_subCategorias/"+id;
    }
    function modalOpen(id,texto,option){
    	$('#id').val(id);
    	$('#form-field-1_edit').val(texto);
    	$('#id_categoria_fk_edit').val(option);
    }	
</script>
