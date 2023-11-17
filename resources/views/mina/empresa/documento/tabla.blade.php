<div class="card card-info">
	<div class="card-header">@yield('titulo') 
		@can('Documento crear')
		    <a class="btn btn-sm btn-default text-dark" href="{{ route('documento.crear') }}">
				<i class="fas fa-plus-circle"></i> Nuevo
			</a>
		@endcan
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Documento editar', 'Documento borrar'])
			        	    <th width="200px">Acción</th>
			        	@endcanany
			            <th>Título</th>
			            <th>Descripción</th>
			            <th>Tema</th>
			            <th>Sub tema</th>
			            <th>Activo</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>