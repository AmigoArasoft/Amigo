<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Persona jurídica/natural:') }}
			{{ Form::select('tercero_id', $tercero, (!isset($dato)) ? 1 : null, ['class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm selectpicker', 'data-live-search' => 'true', 'required', 'autofocus']) }}
		</div>
	</div>
</div>