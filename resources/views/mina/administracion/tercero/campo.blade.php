<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('persona_id', 'Tipo de persona:') }}
			{{ Form::select('persona_id', $persona, (!isset($dato)) ? 1 : null, ['class' => $errors->first('persona_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'doc(this.value)', 'required', 'autofocus']) }}
			@if($errors->has('persona_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('persona_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('documento_id', 'Tipo de documento:') }}
			{{ Form::select('documento_id', $natural, null, ['class' => $errors->first('documento_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required']) }}
			@if($errors->has('documento_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('documento_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('documento', 'Documento:') }}
			{{ Form::text('documento', null, ['class' => $errors->first('documento') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Número de documento del tercero', 'maxlength' => '20', 'required']) }}
			@if($errors->has('documento'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('documento') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('nombre', 'Nombre:') }}
			{{ Form::text('nombre', null, ['class' => $errors->first('nombre') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Nombre completo del tercero', 'maxlength' => '255', 'required']) }}
			@if($errors->has('nombre'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('nombre') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('direccion', 'Dirección:') }}
			{{ Form::text('direccion', null, ['class' => $errors->first('direccion') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Dirección del tercero', 'maxlength' => '255', 'required']) }}
			@if($errors->has('direccion'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('direccion') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('telefono', 'Teléfono:') }}
			{{ Form::text('telefono', null, ['class' => $errors->first('telefono') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Teléfono del tercero', 'maxlength' => '255', 'required']) }}
			@if($errors->has('telefono'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('telefono') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('email', 'Email:') }}
			{{ Form::email('email', null, ['class' => $errors->first('email') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Correo electrónico del tercero', 'maxlength' => '255', 'required']) }}
			@if($errors->has('email'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('email') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>