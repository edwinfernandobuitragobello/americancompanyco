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
													<th width="8%"></th>
													<th>Nombre</th>
													<th>Categoría</th>
													<th>Sub-Categoría</th>
													<th>Descripcion</th>
													<th>Precio</th>
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
												
												@foreach($productos as $producto)
													<tr>
														<td style="vertical-align: middle;"><img class="img_ov" src="{{ url('/uploads').'/'.$producto->foto }}" width="100%" ></td>
														<td style="vertical-align: middle;">{{ $producto->nombre_prod }}</td>
														<td style="vertical-align: middle;">{{ $producto->nombre }}</td>
														<td style="vertical-align: middle;">{{ $producto->sub_categorias->nombre_sub }}</td>
														<td style="vertical-align: middle;"> <?php echo str_limit( $producto->descripcion_prod ,40); ?></td>
														<td style="vertical-align: middle;">{{ $producto->precio }}</td>
														<td style="vertical-align: middle;">{{ $producto->updated_at }}</td>
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
															<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" onclick="modalOpen('{{$producto->id_prod}}' , '{{$producto->nombre_prod}}' , '{{$producto->id_categoria_fk}}' , '{{$producto->id_subcategoria_fk}}' , '{{$producto->precio}}', '{{$producto->descripcion_prod}}')">
																<i class="ace-icon fa fa-pencil bigger-120">  EDITAR</i>
															</button>
														</td>
														<td style="text-align: center; vertical-align: middle;">
															<button class="btn btn-xs btn-danger" onclick="submit_eliminar({{$producto->id_prod}})">
																<i class="ace-icon fa fa-trash-o bigger-120">  ELIMINAR</i>
															</button>
														</td>
													</tr>
												@endforeach
												
											</tbody>
										</table>
										<div style="text-align: center">{{$productos->links()}}</div> 
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
          <h4 class="modal-title" id="tituloModal">Editar producto</h4>
        </div>
        <div class="alert alert-danger" id="alert_error_edit" style="display: none">
	    	<p>Corrige el siguiente error:</p>
	        <ul id="errores_edit">
	            
	        </ul>
	    </div>
        <form class="form-horizontal" action="{{ url('/admin/editar_producto') }}" method="POST" role="form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" id="id" name="id" value="">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4" style="position: relative;left: 35%;">
						<div class="col-xs-12">
							<input type="file" id="id-input-file-3_edit" name="foto" />
						</div>
					</div>
				</div>
				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Nombre </label>

				<div class="col-sm-7">
					<input type="text" id="form-field-1_edit" name="producto" placeholder="Nombre del producto" class="col-xs-10 col-sm-8" />
				</div>
				<br><br>

				<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Precio </label>

				<div class="col-sm-7">
					<input type="text" id="form-field-2_edit" name="precio" placeholder="Precio unitario" class="col-xs-10 col-sm-8" />
				</div>
				<br><br>

				<label class="col-sm-4 control-label no-padding-right" for="form-field-select-3">Categoría</label>
				<div class="col-sm-7">
					<select class=" chosen-select col-sm-8" data-placeholder="Selecionar categoría..." name="id_categoria_fk" id="id_categoria_fk_edit">
						<option value="">Selecione una categoría</option>
						@foreach($categorias as $categoria)
							<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
						@endforeach
					</select>
				</div>

				<br><br>

				<label class="col-sm-4 control-label no-padding-right" for="form-field-select-3">Sub-Categoría</label>
				
				<div class="col-sm-7">
					<select class=" chosen-select col-sm-8" data-placeholder="Selecionar Sub-Categoría..." name="id_subcategoria_fk" id="id_subcategoria_fk_edit">
						<option value="">Selecione una Sub-Categoría</option>
					</select>
				</div><br><br><br>
				<div class="row">
					<div class="col-sm-9" style="left: 10%;">
						<div class="col-xs-12">
							<textarea id="froala-editor-1" name="content"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
	        	<button class="btn btn-info" id="editar_producto" type="submit">
					<i class="ace-icon fa fa-check bigger-110"></i>
					Editar
				</button>
	          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
	        </div>
		</form>
      
    </div>
  </div>
  
</div>
<!-- inline scripts related to this page -->
		<!-- inline scripts related to this page -->

@include('footerAdmin')
<script>
	$('#id_categoria_fk').on('change', function() {
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
	$('#id_categoria_fk_edit').on('change', function() {
	    // $(this).val() will work here
	    $.ajax({
            data:  $(this).val(),
            url:   'obtenerSubCategorias/'+$(this).val(),
            type:  'get',
            beforeSend: function () {
                    $("#id_subcategoria_fk_edit").html("Procesando, espere por favor...");
                    $("#id_subcategoria_fk_edit").html('<option value="">Selecione una Sub-Categoría</option>');
            },
            success:  function (data) {
            	
                for (var i = 0; i < data.length; i++) {
                	$("#id_subcategoria_fk_edit").append('<option value="'+data[i].id_sub+'">'+data[i].nombre_sub+'</option>')
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
            var content = $("#froala-editor").val();
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
        $("#editar_producto").click(function(){
            var nombre = $("#form-field-1_edit").val();
            var precio = $("#form-field-2_edit").val();
            var id_categoria_fk = $("#id_categoria_fk_edit").val();
            var id_subcategoria_fk = $("#id_subcategoria_fk_edit").val();
            var content = $("#froala-editor-1").val();
            $('#errores').html('');
            if((nombre == "") || (precio == "") || (id_categoria_fk == "") || (id_subcategoria_fk == "")){
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
	});
	var url = "http://localhost/americancompanyco/public";
	function submit_activar(id){
    	window.location.href = url+"/admin/activar_producto/"+id;
    }
    function submit_desactivar(id){
    	window.location.href = url+"/admin/desactivar_producto/"+id;
    }
    function submit_eliminar(id){
    	window.location.href = url+"/admin/eliminar_producto/"+id;
    }
    function modalOpen(id,texto,option,option_sub,precio,descripcion){
    	$('#id').val(id);
    	$('#form-field-1_edit').val(texto);
    	$('#form-field-2_edit').val(precio);
    	$('#id_categoria_fk_edit').val(option);
    	$.ajax({
            data:  option,
            url:   'obtenerSubCategorias/'+option,
            type:  'get',
            beforeSend: function () {
                    $("#id_subcategoria_fk_edit").html("Procesando, espere por favor...");
            },
            success:  function (data) {
            	$("#id_subcategoria_fk_edit").html('<option value="">Selecione una Sub-Categoría</option>');
                for (var i = 0; i < data.length; i++) {
                	if (option_sub==data[i].id_sub) {
                		$("#id_subcategoria_fk_edit").append('<option value="'+data[i].id_sub+'" selected="selected">'+data[i].nombre_sub+'</option>')
                	}else{
                		$("#id_subcategoria_fk_edit").append('<option value="'+data[i].id_sub+'">'+data[i].nombre_sub+'</option>')
                	}
                	
                }
            }
    	});
    	$('textarea#froala-editor-1').froalaEditor();
    	$('textarea#froala-editor-1').froalaEditor('html.set', descripcion);

    	
    }	
</script>