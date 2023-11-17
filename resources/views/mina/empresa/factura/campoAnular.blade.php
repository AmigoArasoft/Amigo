<div class="row">
	<div class="col-md-2">
		{{ Form::label('val_0', 'Informe:') }} {{ $dato->id }}
		<br>
		{{ Form::label('val_3', 'Viajes:') }} {{ $dato->viajes->count() }}
	</div>
	<div class="col-md-4">
		{{ Form::label('val_1', 'Fecha:') }} {{ $dato->fecha_nombre }}
		<br>
		{{ Form::label('val_5', 'Valor:') }} $ {{ number_format($dato->valor, 2, '.', ',') }}
	</div>
	<div class="col-md-4">
		{{ Form::label('val_2', 'Desde:') }} {{ $dato->desde_nombre }}
		<br>
		{{ Form::label('val_4', 'Hasta:') }} {{ $dato->hasta_nombre }}
	</div>
	<div class="col-md-2 text-right">
		@if(Auth::user()->tercero_id == 1)
			@can('Factura borrar')
				<a class="btn btn-sm btn-danger" href="{{ route('factura.activar', $dato->id) }}"><i class="fas fa-times-circle"></i> Anular</a>
			@endcan
		@endif
		<a class="btn btn-sm btn-info" href="{{ route('factura') }}"><i class="fas fa-undo"></i> Regresar</a>
	</div>
</div>
<div class="row">
	@foreach ($dato->materiales as $e)
		<div class="col-md-4">
			<div class="card bg-light">
			  	<div class="card-header"><b>{{ $e->nombre }}</b></div>
			  	<div class="card-body">
			    	<div class="row">
			    		<div class="col-md-4"><b>Volúmen: </b></div>
			   			<div class="col-md-8">{{ number_format($e->volumen, 2, '.', ',') }}</div>
			   		</div>
			   		<div class="row">
			   			<div class="col-md-4"><b>Valor: </b></div>
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