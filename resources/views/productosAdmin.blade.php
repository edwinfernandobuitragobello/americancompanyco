@include('headerAdmin')
<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>
							<li class="active">Productos</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="widget-box collapsed">
							<div class="widget-header">
								<h4 class="widget-title">Crear Productos</h4>

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
										<form class="form-horizontal" action="{{ url('/admin/crear_producto') }}" method="POST" role="form" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="form-group">
												<div class="row">
													<div class="col-sm-2">
														<div class="col-xs-12">
															<input type="file" id="id-input-file-3" name="foto" />
														</div>
													</div>
												</div>
												<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Nombre </label>

												<div class="col-sm-7">
													<input type="text" id="form-field-1" name="producto" placeholder="Nombre del producto" class="col-xs-10 col-sm-6" />
												</div>
												<br><br>

												<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Precio </label>

												<div class="col-sm-7">
													<input type="text" id="form-field-2" name="precio" placeholder="Precio unitario" class="col-xs-10 col-sm-6" />
												</div>
												<br><br>

												<label class="col-sm-5 control-label no-padding-right" for="form-field-select-3">Categoría</label>
												<div class="col-sm-7">
													<select class=" chosen-select col-sm-6" data-placeholder="Selecionar categoría..." name="id_categoria_fk" id="id_categoria_fk">
														<option value="">Selecione una categoría</option>
														@foreach($categorias as $categoria)
															<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
														@endforeach
													</select>
												</div>

												<br><br>

												<label class="col-sm-5 control-label no-padding-right" for="form-field-select-3">Sub-Categoría</label>
												
												<div class="col-sm-7">
													<select class=" chosen-select col-sm-6" data-placeholder="Selecionar Sub-Categoría..." name="id_subcategoria_fk" id="id_subcategoria_fk">
														<option value="">Selecione una Sub-Categoría</option>
													</select>
												</div><br><br><br>
												<div class="row">
													<div class="col-sm-6" style="left: 30%;">
														<div class="col-xs-12">
															<textarea id="froala-editor" name="content"></textarea>
														</div>
													</div>
												</div>
												

												<div class="clearfix form-actions">
													<div class="col-md-offset-5 col-md-7">
														<button class="btn btn-info" id="submit_producto" type="submit">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Crear
														</button>
													</div>
												</div>
												<div class="hr hr-24"></div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">Lista de Prodcutos</h4>

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
										<!--  -->
									</div>
								</div>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
<!-- TERMINAR DE CREAR LA CATEGORIA -->
<!-- inline scripts related to this page -->
		<!-- inline scripts related to this page -->

@include('footerAdmin')
<script>
	$('#id_categoria_fk').on('change', function() {
		alert($(this).val());
	    // $(this).val() will work here
	    $.ajax({
            data:  $(this).val(),
            url:   'obtenerSubCategorias/'+$(this).val(),
            type:  'get',
            beforeSend: function () {
                    $("#id_subcategoria_fk").html("Procesando, espere por favor...");
            },
            success:  function (data) {
            	$("#id_subcategoria_fk").html('<option value="">Selecione una Sub-Categoría</option>');
                for (var i = 0; i < data.length; i++) {
                	$("#id_subcategoria_fk").append('<option value="'+data[i].id_sub+'">'+data[i].nombre_sub+'</option>')
                }
                
            }
    	});
	});
	
</script>
<script type="text/javascript">
	$(document).ready(function(){
		//función click submit
        $("#submit_producto").click(function(){
            var nombre = $("#form-field-1").val();
            var precio = $("#form-field-2").val();
            var id_categoria_fk = $("#id_categoria_fk").val();
            var id_subcategoria_fk = $("#id_subcategoria_fk").val();
            var foto = $('#id-input-file-3')[0].files.length;
            var content = $("#content").val();
            $('#errores').html('');
            if((nombre == "") || (precio == "") || (id_categoria_fk == "") || (id_subcategoria_fk == "") || (foto == 0)){
            	if (foto == 0) {
                	$('#errores').append('<li>Sube una foto del producto</li>');
                }
            	if ((nombre == "")) {
            		$('#errores').append('<li>Escribe el nombre del producto</li>');	
            	}
            	if (precio == "") {
                	$('#errores').append('<li>Escribe un precio</li>');
                }
                if (id_categoria_fk == "") {
                	$('#errores').append('<li>Selecciona una categoría</li>');
                }
                if (id_subcategoria_fk == "") {
                	$('#errores').append('<li>Selecciona una Sub-Categoría</li>');
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
	var url = "http://localhost/americancompanyco/public";
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