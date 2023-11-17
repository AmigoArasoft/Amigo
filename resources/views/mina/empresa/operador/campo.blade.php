<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Persona jurídica:') }}
			{{ Form::select('tercero_id', $tercero, (!isset($dato)) ? 1 : null, ['class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required', 'autofocus']) }}
			@if($errors->has('tercero_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('tercero_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('frente_id', 'Frente:') }}
			{{ Form::select('frente_id', $frente, (!isset($dato)) ? 1 : null, ['class' => $errors->first('frente_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required']) }}
			@if($errors->has('frente_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('frente_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('rucom', 'Rucom:') }}
			{{ Form::text('rucom', null, ['class' => $errors->first('rucom') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Rucom del operador', 'maxlength' => '15']) }}
			@if($errors->has('rucom'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('rucom') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('transporte', 'Transportador:') }}
			<br>
			{{ Form::checkbox('transporte', 1) }}
			@if($errors->has('transporte'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('transporte') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('comprador_id', 'Comprador:') }}
			{{ Form::select('comprador_id', $comprador, null, ['class' => $errors->first('comprador_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required']) }}
			@if($errors->has('comprador_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('comprador_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('archivo', 'Firma:') }}
			{{ Form::file('archivo', ['accept' => 'image/*']) }}
			@if($errors->has('archivo'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('archivo') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>