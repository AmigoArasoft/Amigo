<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Persona jurídica:') }}
			{{ Form::select('tercero_id', $tercero, (!isset($dato)) ? 1 : null, ['class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required', 'autofocus']) }}
		</div>
	</div>
</div>