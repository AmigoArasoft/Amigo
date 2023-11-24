<div class="card card-info">
	<div class="card-header">@yield('titulo') 
		@can('Tercero crear')
		    <a class="btn btn-sm btn-default text-dark" href="{{ route('tercero.crear') }}">
				<i class="fas fa-plus-circle"></i>	Nuevo
			</a>
		@endcan
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Tercero editar', 'Tercero borrar'])
			        	    <th width="50px">Acción</th>
			        	@endcanany
			            <th>Nombres</th>
			            <th>Teléfono</th>
			            <th>Email</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>