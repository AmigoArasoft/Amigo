<div class="row">
	<div class="col-md-6">
		<div class="form-group row{{ $errors->first('name') ? ' is-invalid' : '' }}">
			{{ Form::label('name', 'Nombre:', ['class' => 'col-sm-2 col-form-label']) }}
			<div class="col-sm-10">
				@if($accion == 'Borrar')
					{{ Form::text('name', $dato->name, ['class' => 'form-control-plaintext']) }}
				@else
					{{ Form::text('name', null, ['class' => $errors->first('name') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Nombre del usuario', 'maxlength' => '255', 'required', 'autofocus']) }}
				@endif
			</div>
			@if($errors->has('name'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('name') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group row{{ $errors->first('email') ? ' is-invalid' : '' }}">
			{{ Form::label('email', 'Email:', ['class' => 'col-sm-2 col-form-label']) }}
			<div class="col-sm-10">
				@if($accion == 'Borrar')
					{{ Form::text('email', $dato->email, ['class' => 'form-control-plaintext']) }}
				@else
					{{ Form::email('email', null, ['class' => $errors->first('email') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Correo electrónico del usuario', 'maxlength' => '255', 'required']) }}
				@endif
			</div>
			@if($errors->has('email'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('email') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>
@if($accion != 'Borrar')
	<div class="row">
		<div class="col-md-4">
			<div class="form-group row{{ $errors->first('telefono') ? ' is-invalid' : '' }}">
				{{ Form::label('telefono', 'Teléfono:', ['class' => 'col-sm-4 col-form-label']) }}
				<div class="col-sm-8">
					{{ Form::text('telefono', null, ['class' => $errors->first('telefono') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Teléfono del usuario', 'maxlength' => '255']) }}
				</div>
				@if($errors->has('telefono'))
					<div class="invalid-feedback d-block">
			        	{{ $errors->first('telefono') }}
			      	</div>
			    @endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group row{{ $errors->first('tercero_id') ? ' is-invalid' : '' }}">
				{{ Form::label('tercero_id', 'Empresa:', ['class' => 'col-sm-3 col-form-label']) }}
				<div class="col-sm-9">
					{{ Form::select('tercero_id', $tercero, null, ['class' => $errors->first('tercero_id') ? 'form-control is-invalid' : 'form-control', 'required']) }}
				</div>
				@if($errors->has('tercero_id'))
					<div class="invalid-feedback d-block">
			        	{{ $errors->first('tercero_id') }}
			      	</div>
			    @endif
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group row{{ $errors->first('password') ? ' is-invalid' : '' }}">
				{{ Form::label('password', 'Clave:', ['class' => 'col-sm-2 col-form-label']) }}
				<div class="col-sm-10">
					{{ Form::password('password', ['class' => $errors->first('password') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Clave del usuario', 'maxlength' => '255']) }}
				</div>
				@if($errors->has('password'))
					<div class="invalid-feedback d-block">
			        	{{ $errors->first('password') }}
			      	</div>
			    @endif
			</div>
		</div>
	</div>
@endif
<div class="form-group row{{ $errors->first('roles') ? ' is-invalid' : '' }}">
	{{ Form::label('roles', 'Roles:', ['class' => 'col-sm-12 col-form-label']) }}
	<div class="col-sm-12 row p-2{{ $errors->has('roles') ? ' text-danger' : '' }}">
		@if($accion == 'Borrar')
			@foreach($dato->roles as $d)
	        	<div class="col-sm-3">
	        		{{ Form::text('roles['.$d->id.']', $d->name, ['class' => 'form-control-plaintext']) }}
	        	</div>
	    	@endforeach
		@else
	    	@foreach($roles as $d)
	        	<div class="col-sm-3">
	            	{{ Form::checkbox('roles[]', $d->id) }} {{ $d->name }}
	        	</div>
	    	@endforeach
	    @endif
	</div>
	@if($errors->has('roles'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('roles') }}
      	</div>
    @endif
</div>