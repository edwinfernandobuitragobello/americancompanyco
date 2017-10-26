@include('headerAdmin')
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
							        <ul id="errores">
							            
							        </ul>
							    </div>
								<form class="form-horizontal" action="{{ url('/admin/crear_producto') }}" method="POST" role="form">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-2">
												<div class="col-xs-12">
													<input type="file" id="id-input-file-3" />
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

										<label class="col-sm-5 control-label no-padding-right" for="form-field-select-3">Sub-Categoría</label>
										
										<div class="col-sm-7">
											<select class=" chosen-select col-sm-6" data-placeholder="Selecionar Sub-Categoría..." name="id_subcategoria_fk" id="id_subcategoria_fk">
												<option value="">Selecione una Sub-Categoría</option>
												@foreach($subCategorias as $subCategoria)
													<option value="{{$subCategoria->id}}">{{$subCategoria->nombre}}</option>
												@endforeach
											</select>
										</div><br><br><br>
										<textarea id="froala-editor" name="content"></textarea>

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
