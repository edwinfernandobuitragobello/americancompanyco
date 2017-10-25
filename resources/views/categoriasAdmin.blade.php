@include('headerAdmin')
<!-- INICIO DE CREAR LA CATEGORIA -->
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<li class="active">
						<a href="index.html">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="{{url('/admin/categorias')}}">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Categorias </span>
						</a>
						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>
							<li class="active">Categorias</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="page-header">
									<h1>
										Crear categoria
									</h1>
								</div>
								<form class="form-horizontal" role="form">
									<div class="form-group">
										<label class="col-sm-5 control-label no-padding-right" for="form-field-1"> Nombre </label>

										<div class="col-sm-7">
											<input type="text" id="form-field-1" placeholder="Categoria" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-5 col-md-7">
											<button class="btn btn-info" type="button">
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
									Lista de categorias
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
													<button class="btn btn-xs btn-success">
														<i class="ace-icon fa fa-check bigger-120">  ACTIVAR</i>
													</button>
												</td>
												<td style="text-align: center;">
													<button class="btn btn-xs btn-info">
														<i class="ace-icon fa fa-pencil bigger-120">  EDITAR</i>
													</button>
												</td>
												<td style="text-align: center;">
													<button class="btn btn-xs btn-danger">
														<i class="ace-icon fa fa-trash-o bigger-120">  ELIMINAR</i>
													</button>
												</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
							</div>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->
<!-- TERMINAR DE CREAR LA CATEGORIA -->

@include('footerAdmin')
			
