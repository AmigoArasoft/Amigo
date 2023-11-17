<div class="card card-info">
	<div class="card-header">@yield('titulo') 
		@can('Usuario crear')
		    <a class="btn btn-sm btn-default text-dark" href="{{ route('usuario.crear') }}">
				<i class="fas fa-plus-circle"></i>	Nuevo
			</a>
		@endcan
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Usuario editar', 'Usuario borrar'])
			        	    <th width="120px">Acción</th>
			        	@endcanany
			            <th>Nombre</th>
			            <th>Correo</th>
			            <th>Empresa</th>
			            <th>Roles</th>
			            <th>Activo</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>