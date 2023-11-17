<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('titulo', 'Título:') }}
			{{ Form::text('titulo', null, ['class' => $errors->first('titulo') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Título del documento', 'maxlength' => '150', 'required', 'autofocus']) }}
			@if($errors->has('titulo'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('titulo') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('descripcion', 'Descripción:') }}
			{{ Form::text('descripcion', null, ['class' => $errors->first('descripcion') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Descripción del documento', 'maxlength' => '256', 'required']) }}
			@if($errors->has('descripcion'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('descripcion') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{{ Form::label('documento', 'Documento:') }}
			{{ Form::file('documento') }}
			@if($errors->has('documento'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('documento') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>