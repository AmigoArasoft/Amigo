<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('fecha', 'Fecha:') }}
			{{ Form::date('fecha', (!isset($dato)) ? $hoy : null, ['class' => $errors->first('fecha') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => $desde, 'max' => $hoy, 'autofocus']) }}
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
			{{ Form::select('operador_id', $operador, null, ['class' => $errors->first('operador_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'cambiaOperador(this.value)']) }}
			@if($errors->has('operador_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('operador_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('material_id', 'Material:') }}
			{{ Form::select('material_id', $material, (!isset($dato)) ? 1 : null, ['class' => $errors->first('material_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'cambiaMaterial(this.value)']) }}
			@if($errors->has('material_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('material_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('submaterial_id', 'Sub material:') }}
			{{ Form::select('submaterial_id', $submaterial, (!isset($dato)) ? 1 : null, ['class' => $errors->first('submaterial_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
			@if($errors->has('submaterial_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('submaterial_id') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('vehiculo_id', 'Vehículo:') }}
			{{ Form::select('vehiculo_id', $vehiculo, (!isset($dato)) ? 1 : null, ['class' => $errors->first('vehiculo_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'cambiaVehiculo(this.value)']) }}
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
			{{ Form::select('conductor_id', $conductor, (!isset($dato)) ? $vehi->conductor_id : null, ['class' => $errors->first('conductor_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
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
</div>