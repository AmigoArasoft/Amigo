<div class="card card-info">
	<div class="card-header">@yield('titulo') 
		@can('Material crear')
		    <a class="btn btn-sm btn-default text-dark" href="{{ route('material.crear') }}">
				<i class="fas fa-plus-circle"></i>	Nuevo
			</a>
		@endcan
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabla" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Material editar', 'Material borrar'])
			        	    <th width="50px">Acción</th>
			        	@endcanany
			            <th>Nombre</th>
			            <th>Sub materiales</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>