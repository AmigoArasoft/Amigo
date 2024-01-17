<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('fecha', 'Fecha:') }}
			{{ Form::date('fecha', (!isset($dato)) ? $hoy : null, ['class' => $errors->first('fecha') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'autofocus']) }}
			@if($errors->has('fecha'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('fecha') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('operador_id', 'Operador:') }}
			{{ Form::select('operador_id', $operador, null, ['class' => $errors->first('operador_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'onchange' => 'cambiaOperador(this.value)']) }}
			@if($errors->has('operador_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('operador_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('subgrupo_id', 'Sub Grupo:') }}
			{{ Form::select('subgrupo_id', $subgrupo, (!isset($dato)) ? 1 : null, ['class' => $errors->first('subgrupo_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'onchange' => 'cambiaMaterial(this.value)']) }}
			@if($errors->has('subgrupo_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('subgrupo_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('material_id', 'Material:') }}
			{{ Form::select('material_id', $materiales, (!isset($dato)) ? 1 : null, ['class' => $errors->first('material_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'title' => 'Seleccione material']) }}
			@if($errors->has('material_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('material_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('cliente', 'Cliente:') }}
			{{ Form::text('cliente', (!isset($dato)) ? $vehi->cliente : null, ['class' => $errors->first('cliente') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Cliente del viaje']) }}
			@if($errors->has('cliente'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('cliente') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('vehiculo_id', 'Vehículo:') }}
			{{ Form::select('vehiculo_id', $vehiculo, (!isset($dato)) ? 1 : null, ['class' => $errors->first('vehiculo_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'onchange' => 'cambiaVehiculo(this.value)', 'title' => 'Seleccione vehículo']) }}
			@if($errors->has('vehiculo_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('vehiculo_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('conductor_id', 'Conductor:') }}
			{{ Form::select('conductor_id', $conductor, (!isset($dato)) ? $vehi->conductor_id : null, ['class' => $errors->first('conductor_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'title' => 'Seleccione conductor']) }}
			@if($errors->has('conductor_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('conductor_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen', 'Volúmen:') }}
			{{ Form::number('volumen', (!isset($dato)) ? $vehi->volumen : null, ['class' => $errors->first('volumen') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0.01', 'step' => '0.01', 'required']) }}
			@if($errors->has('volumen'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('volumen') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('nro_viaje', 'Número de Vale (Opcional):') }}
			{{ Form::text('nro_viaje', (!isset($dato)) ? $vehi->nro_viaje : null, ['class' => $errors->first('nro_viaje') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Número de vale']) }}
			@if($errors->has('nro_viaje'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('nro_viaje') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('destino', 'Destino:') }}
			{{ Form::text('destino', (!isset($dato)) ? $vehi->destino : null, ['class' => $errors->first('destino') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Destino del viaje']) }}
			@if($errors->has('destino'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('destino') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>