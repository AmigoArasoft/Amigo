<div class="card card-info">
	<div class="card-header">@yield('titulo')
		@if(Auth::user()->tercero_id == 1)
			@can('Factura crear')
			    <a class="btn btn-sm btn-default text-dark" href="{{ route('factura.crear') }}">
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
			        	@canany(['Factura editar', 'Factura borrar', 'Factura leer'])
			        	    <th width="140px">Acción</th>
			        	@endcanany
			        	<th>Informe</th>
			            <th>Fecha</th>
			            <th>Operador/Transportador</th>
			            <th>Desde</th>
			            <th>Hasta</th>
			            @if (Auth::user()->role->role_id == 1 || Auth::user()->role->role_id == 3)
							<th>Valor</th>
						@endif
			            <th>M3</th>
			            <th>Anulado</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>