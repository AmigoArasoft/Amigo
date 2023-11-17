<div class="card card-info">
	<div class="card-header">@yield('titulo') 
		@can('Rol crear')
		    <a class="btn btn-sm btn-default text-dark" href="{{ route('rol.crear') }}">
				<i class="fas fa-plus-circle"></i>	Nuevo
			</a>
		@endcan
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Rol editar', 'Rol borrar'])
			        	    <th width="110px">Acción</th>
			        	@endcanany
			            <th>Nombre</th>
			            <th width="40%">Permisos</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>