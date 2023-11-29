
<div class="card card-info">
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
			            <th>Valor</th>
			            <th>M3</th>
			            <th>Anulado</th>
			        </tr>
			    </thead>
			</table>
		</div>
	</div>
</div>