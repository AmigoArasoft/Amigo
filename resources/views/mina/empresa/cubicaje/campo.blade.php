<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('fecha', 'Fecha:') }}
			{{ Form::date('fecha', (!isset($dato)) ? $fecha : null, ['class' => $errors->first('fecha') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'autofocus']) }}
			@if($errors->has('fecha'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('fecha') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Operador:') }}
			{{ Form::select('tercero_id', $terceros, (!isset($dato)) ? 1 : null, ['class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onChange' => 'cambiaOperador(this.value)']) }}
			@if($errors->has('tercero_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('tercero_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('vehiculo_id', 'Vehículo:') }}
			{{ Form::select('vehiculo_id', $vehiculos, (!isset($dato)) ? 1 : null, ['class' => $errors->first('vehiculo_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onChange' => 'cambiaVehiculo(this.value)']) }}
			@if($errors->has('vehiculo_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('vehiculo_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen', 'Volúmen Real:') }}
			{{ Form::number('volumen', null, ['class' => 'form-control form-control-sm', 'disabled']) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen_bruto', 'Volúmen Bruto:') }}
			{{ Form::number('volumen_bruto', null, ['class' => 'form-control form-control-sm', 'disabled']) }}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen_ancho', 'Ancho:') }}
			{{ Form::number('volumen_ancho', (!isset($dato)) ? 0 : null, ['class' => $errors->first('volumen_ancho') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('volumen_ancho'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('volumen_ancho') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen_largo', 'Largo:') }}
			{{ Form::number('volumen_largo', (!isset($dato)) ? 0 : null, ['class' => $errors->first('volumen_largo') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('volumen_largo'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('volumen_largo') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen_alto', 'Alto:') }}
			{{ Form::number('volumen_alto', (!isset($dato)) ? 0 : null, ['class' => $errors->first('volumen_alto') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('volumen_alto'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('volumen_alto') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen_gato', 'Volúmen Gato:') }}
			{{ Form::number('volumen_gato', 0, ['class' => 'form-control form-control-sm', 'disabled']) }}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('gato_mayor', 'Borde Mayor:') }}
			{{ Form::number('gato_mayor', (!isset($dato)) ? 0 : null, ['class' => $errors->first('gato_mayor') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('gato_mayor'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('gato_mayor') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('gato_menor', 'Borde Menor:') }}
			{{ Form::number('gato_menor', (!isset($dato)) ? 0 : null, ['class' => $errors->first('gato_menor') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('gato_menor'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('gato_menor') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('gato_alto', 'Gato Alto:') }}
			{{ Form::number('gato_alto', (!isset($dato)) ? 0 : null, ['class' => $errors->first('gato_alto') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('gato_alto'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('gato_alto') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('gato_ancho', 'Gato Ancho:') }}
			{{ Form::number('gato_ancho', (!isset($dato)) ? 0 : null, ['class' => $errors->first('gato_ancho') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('gato_ancho'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('gato_ancho') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen_borde', 'Volúmen Bordes:') }}
			{{ Form::number('volumen_borde', 0, ['class' => 'form-control form-control-sm', 'disabled']) }}
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('borde_base', 'Borde Base:') }}
			{{ Form::number('borde_base', (!isset($dato)) ? 0 : null, ['class' => $errors->first('borde_base') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('borde_base'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('borde_base') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('borde_alto', 'Borde Alto:') }}
			{{ Form::number('borde_alto', (!isset($dato)) ? 0 : null, ['class' => $errors->first('borde_alto') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('borde_alto'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('borde_alto') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('borde_largo', 'Borde Largo:') }}
			{{ Form::number('borde_largo', (!isset($dato)) ? 0 : null, ['class' => $errors->first('borde_largo') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0', 'step' => '0.01', 'onChange' => 'cambiaVol()', 'required']) }}
			@if($errors->has('borde_largo'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('borde_largo') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('titular', 'Titular:') }}
			{{ Form::text('titular', (!isset($dato)) ? Auth::user()->name : null, ['class' => $errors->first('titular') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Titular', 'maxlength' => '50']) }}
			@if($errors->has('titular'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('titular') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('operador', 'Operador:') }}
			{{ Form::text('operador', (!isset($dato)) ? $operadores->first()->gerente()->nombre ?? null : null, ['class' => $errors->first('operador') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Operador', 'maxlength' => '50']) }}
			@if($errors->has('operador'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('operador') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('transportador', 'Transportador:') }}
			{{ Form::text('transportador', (!isset($dato)) ? $operadores->first()->transportesVehiculos()->get()->sortBy('placa')->first()->tercero->nombre ?? null : null, ['class' => $errors->first('transportador') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Transportador', 'maxlength' => '50']) }}
			@if($errors->has('transportador'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('transportador') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('observacion', 'Observaciones:') }}
			{{ Form::text('observacion', null, ['class' => $errors->first('observacion') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Observaciones', 'maxlength' => '255']) }}
			@if($errors->has('observacion'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('observacion') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>