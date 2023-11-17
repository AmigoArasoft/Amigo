<div class="form-group row{{ $errors->first('name') ? ' is-invalid' : '' }}">
	{{ Form::label('name', 'Nombre:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Borrar')
			{{ Form::text('name', $dato->name, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::text('name', null, ['class' => $errors->first('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nombre del permiso', 'maxlength' => '255', 'required', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('name'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('name') }}
      	</div>
    @endif
</div>