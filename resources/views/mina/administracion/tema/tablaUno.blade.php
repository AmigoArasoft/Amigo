<div class="card card-info">
	<div class="card-header">Adicionar sub tema</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="tablaUno" class="table table-bordered table-striped table-hover table-sm">
			    <thead>
			        <tr class="text-center">
			        	@canany(['Tema editar', 'Tema borrar'])
			        	    <th width="50px">Acción</th>
			        	@endcanany
			            <th>Nombre</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>