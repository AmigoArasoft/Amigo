<div class="row">
	<div class="col-md-6">
		<p><b>Nombre:</b> {{ $dato->nombre }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Teléfono:</b> {{ $dato->telefono }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Email:</b> {{ $dato->email }}</p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<p><b>Dirección:</b> {{ $dato->direccion }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Persona:</b> {{ $dato->persona->nombre }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Documento:</b> {{ $dato->tipo->nombre.' '.$dato->documento }}</p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('transporte', 'Transportador:') }}
			{{ Form::checkbox('transporte', 1) }}
			@if($errors->has('transporte'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('transporte') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>