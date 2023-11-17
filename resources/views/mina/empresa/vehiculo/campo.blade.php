<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Transportadora:') }}
			{{ Form::select('tercero_id', $tercero, (!isset($dato)) ? 1 : null, ['class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onChange' => 'cambiaTransportador(this.value)', 'autofocus']) }}
			@if($errors->has('tercero_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('tercero_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('conductor_id', 'Conductor:') }}
			{{ Form::select('conductor_id', $conductor, (!isset($dato)) ? 1 : null, ['class' => $errors->first('conductor_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
			@if($errors->has('conductor_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('conductor_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('placa', 'Placa:') }}
			{{ Form::text('placa', null, ['class' => $errors->first('placa') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Placa del vehículo', 'maxlength' => '6', 'required']) }}
			@if($errors->has('placa'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('placa') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('volumen', 'Volúmen:') }}
			{{ Form::number('volumen', null, ['class' => $errors->first('volumen') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => '0.01', 'step' => '0.01', 'required']) }}
			@if($errors->has('volumen'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('volumen') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('marca', 'Marca:') }}
			{{ Form::text('marca', null, ['class' => $errors->first('marca') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Marca del vehículo', 'maxlength' => '20']) }}
			@if($errors->has('marca'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('marca') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>