<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Nombre Transportista:') }}
			{{ Form::text('tercero_id', null, [
				'class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 
				'required', 
				'autofocus',
				'placeholder' => 'Ingrese Nombre del Transportista'
			]) }}
			@if($errors->has('tercero_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('tercero_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Operadores:') }}
			{{ Form::select('tercero_id', $tercero, (!isset($dato)) ? 1 : null, [
				'class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm',
				'required', 
				'autofocus',
				'multiple' => 'multiple',
				'name' => 'tercero_id[]'
			]) }}
			@if($errors->has('tercero_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('tercero_id') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>