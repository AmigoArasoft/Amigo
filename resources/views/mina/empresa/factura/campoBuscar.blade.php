<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			{{ Form::label('tercero_id', 'Operador/Transportador:') }}
			{{ Form::select('tercero_id', $operador, $ope, ['class' => $errors->first('tercero_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'this.form.submit()', 'autofocus']) }}
			@if($errors->has('tercero_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('tercero_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('fecha', 'Fecha:') }}
			{{ Form::date('fecha', $fecha, ['class' => $errors->first('fecha') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm']) }}
			@if($errors->has('fecha'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('fecha') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('desde', 'Desde:') }}
			{{ Form::date('desde', $desde, ['class' => $errors->first('desde') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'this.form.submit()']) }}
			@if($errors->has('desde'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('desde') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('hasta', 'Hasta:') }}
			{{ Form::date('hasta', $hasta, ['class' => $errors->first('hasta') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'onchange' => 'this.form.submit()']) }}
			@if($errors->has('hasta'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('hasta') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2 text-right">
		<a class="btn btn-sm btn-info" href="{{ route('factura') }}"><i class="fas fa-undo"></i> Regresar</a>
	</div>
</div>