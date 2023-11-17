<div class="card card-info">
	<div class="card-header">@yield('titulo')
		@if(Auth::user()->tercero_id == 1)
			@can('Cubicaje crear')
			    <a class="btn btn-sm btn-default text-dark" href="{{ route('cubicaje.crear') }}">
					<i class="fas fa-plus-circle"></i> Nuevo
				</a>
			@endcan
		@endif
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Cubicaje editar', 'Cubicaje borrar'])
			        	    <th width="160px">Acción</th>
			        	@endcanany
			            <th>Nº</th>
			            <th>Fecha</th>
			            <th>Operador</th>
			            <th>Placa</th>
			            <th>Vol. Real</th>
			            <th>Activo</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>