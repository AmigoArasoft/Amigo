<div class="card card-info">
	<div class="card-header">@yield('titulo') 
		@can('Parametro crear')
		    <a class="btn btn-sm btn-default text-dark" href="{{ route('parametro.crear') }}">
				<i class="fas fa-plus-circle"></i>	Nuevo
			</a>
		@endcan
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Parametro editar', 'Parametro borrar'])
			        	    <th width="50px">Acción</th>
			        	@endcanany
			            <th>Nombre</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>