<div class="form-group row{{ $errors->first('name') ? ' is-invalid' : '' }}">
	{{ Form::label('name', 'Nombre:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Borrar')
			{{ Form::text('name', $dato->name, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::text('name', null, ['class' => $errors->first('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nombre del rol', 'maxlength' => '255', 'required', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('name'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('name') }}
      	</div>
    @endif
</div>
<div class="form-group row{{ $errors->first('permissions') ? ' is-invalid' : '' }}">
	{{ Form::label('permissions', 'Permisos:', ['class' => 'col-sm-12 col-form-label']) }}
	<div class="row p-2{{ $errors->has('permissions') ? ' text-danger' : '' }}">
		@if($accion == 'Borrar')
			@foreach($dato->permissions as $d)
	        	<div class="col-sm-3">
	        		{{ Form::text('permissions['.$d->id.']', $d->name, ['class' => 'form-control-plaintext']) }}
	        	</div>
	    	@endforeach
		@else
	    	@foreach($permissions as $d)
	        	<div class="col-sm-3">
	            	{{ Form::checkbox('permissions[]', $d->id) }} {{ $d->name }}
	        	</div>
	    	@endforeach
	    @endif
	</div>
	@if($errors->has('permissions'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('permissions') }}
      	</div>
    @endif
</div>