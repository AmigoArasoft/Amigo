{{ Form::hidden('tercero_id', $ope) }}
{{ Form::hidden('fecha', $fecha) }}
{{ Form::hidden('desde', $desde) }}
{{ Form::hidden('hasta', $hasta) }}
<div class="row">
	<div class="col-md-3">
		{{ Form::label('val_0', 'Total de viajes:') }} {{ $viajes->sum('cuenta') }}
	</div>
	<div class="col-md-3">
		{{ Form::label('val_1', 'Total de volúmen:') }} {{ number_format($viajes->sum('volumen'), 2, '.', ',') }}
	</div>
	<div class="col-md-3">
		{{ Form::label('val_2', 'Valor total:') }} $ {{ number_format($viajes->sum('total'), 2, '.', ',') }}
	</div>
	<div class="col-md-3 text-right">
		@if ($viajes->sum('total') > 0)
			@can('Factura crear')
				{{ Form::button('<i class="fas fa-money-check-alt"></i> Crear Informe', ['type' => 'submit', 'class' => 'btn btn-info']) }}
			@endcan
		@endif
	</div>
</div>
<div class="row">
	@foreach ($viajes as $e)
		<div class="col-md-4">
			<div class="card bg-light">
			  	<div class="card-header"><b>{{ $e->nombre }}</b></div>
			  	<div class="card-body">
			    	<div class="row">
			    		<div class="col-md-4"><b>Volúmen: </b></div>
			   			<div class="col-md-8">{{ number_format($e->volumen, 2, '.', ',') }}</div>
			   		</div>
			   		<div class="row">
			   			<div class="col-md-4"><b>Valor (actual): </b></div>
			    		<div class="col-md-8">$ {{ number_format($e->valor, 2, '.', ',') }}</div>
			    	</div>
			    	<div class="row">
			   			<div class="col-md-4"><b>Total: </b></div>
			   			<div class="col-md-8">$ {{ number_format($e->total, 2, '.', ',') }}</div>
			   		</div>
			  </div>
			</div>
		</div>
	@endforeach
</div>