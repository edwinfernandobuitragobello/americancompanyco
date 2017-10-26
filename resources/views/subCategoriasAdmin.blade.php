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
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="page-header">
									<h1>
										Crear Sub-Categorías
									</h1>
								</div>
								<div class="alert alert-danger" id="alert_error" style="display: none">
							    	<p>Corrige el siguiente error:</p>
							        <ul>
							            <li>Escribe el nombre de la Sub-Categoría</li>
							        </ul>
							    </div>
								<form class="form-horizontal" action="{{ url('/admin/crear_categoria') }}" method="POST" role="form">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Nombre </label>

										<div class="col-sm-7">
											<input type="text" id="form-field-1" name="categoria" placeholder="Sub-Categoria" class="col-xs-10 col-sm-6" />
										</div>
										<br>

										<label class="col-sm-5 control-label no-padding-right" for="form-field-select-3">Categoría</label>
										<br>
										<div class="col-sm-7">
											<select class=" chosen-select col-sm-6" id="form-field-select-3" data-placeholder="Choose a State...">
												<option value="">Selecione una categoría</option>
												@foreach($categorias as $categoria)
													<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-5 col-md-7">
											<button class="btn btn-info" id="submit_categoria" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Crear
											</button>
										</div>
									</div>
									<div class="hr hr-24"></div>
								</form>
							</div>
							<!-- LISTA DE CATEGORIAS -->
							<div class="page-header">
								<h1>
									Lista de Sub-categorias
								</h1>
							</div><!-- /.page-header -->
							<div class="modal-body no-padding">
								<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
									<thead>
										<tr>
											<th>Nombre</th>
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
										
										@foreach($categorias as $categoria)
											<tr>
												<td>{{ $categoria->nombre }}</td>
												<td>{{ $categoria->updated_at }}</td>
												<td style="text-align: center;">
														@if($categoria->activo==0)
															<button id="submit_activar" class="btn btn-xs btn-success" onclick="submit_activar({{$categoria->id}})">
															<i class="ace-icon fa fa-check bigger-120">  ACTIVAR</i>
														@else
															<button id="submit_desactivar" class="btn btn-xs btn-warning" onclick="submit_desactivar({{$categoria->id}})">
															<i class="ace-icon fa fa-close bigger-120">  DESACTIVAR</i>
														@endif
													</button>
												</td>
												<td style="text-align: center;">
													<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#myModal" onclick="modalOpen('{{$categoria->id}}' , '{{$categoria->nombre}}')">
														<i class="ace-icon fa fa-pencil bigger-120">  EDITAR</i>
													</button>
												</td>
												<td style="text-align: center;">
													<button class="btn btn-xs btn-danger" onclick="submit_eliminar({{$categoria->id}})">
														<i class="ace-icon fa fa-trash-o bigger-120">  ELIMINAR</i>
													</button>
												</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
								<div style="text-align: center">{{$categorias->links()}}</div> 
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
	var url = "http://localhost/americancompanyco/public";
	function submit_activar(id){
    	window.location.href = url+"/admin/activar_categoria/"+id;
    }
    function submit_desactivar(id){
    	window.location.href = url+"/admin/desactivar_categoria/"+id;
    }
    function submit_eliminar(id){
    	window.location.href = url+"/admin/eliminar_categoria/"+id;
    }
    function modalOpen(id,texto){
    	$('#id').val(id);
    	$('#form-field-1_edit').val(texto);
    }	
</script>
