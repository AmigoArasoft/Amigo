<div class="row">
	<div class="col-md-6">
		<p><b>Nombre:</b> {{ $dato->nombre }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Teléfono:</b> {{ $dato->telefono }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Email:</b> {{ $dato->email }}</p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<p><b>Dirección:</b> {{ $dato->direccion }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Persona:</b> {{ $dato->persona->nombre }}</p>
	</div>
	<div class="col-md-3">
		<p><b>Documento:</b> {{ $dato->tipo->nombre.' '.$dato->documento }}</p>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('operador', 'Operador:') }}
			{{ Form::checkbox('operador', 1) }}
			@if($errors->has('operador'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('operador') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group row">
			{{ Form::label('frente_id', 'Frente:', ['class' => 'col-md-5']) }}
			<div class="col-md-7">
				{{ Form::select('frente_id', $frente, (!isset($dato)) ? 1 : null, ['class' => $errors->first('frente_id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'required']) }}
			</div>
			@if($errors->has('frente_id'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('frente_id') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			{{ Form::label('transporte', 'Transportador:') }}
			{{ Form::checkbox('transporte', 1) }}
			@if($errors->has('transporte'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('transporte') }}
		      	</div>
		    @endif
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group row">
			{{ Form::label('rucom', 'Rucom:', ['class' => 'col-md-5']) }}
			<div class="col-md-7">
				{{ Form::text('rucom', null, ['class' => $errors->first('rucom') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'placeholder' => 'Rucom del operador', 'maxlength' => '15']) }}
			</div>
			@if($errors->has('rucom'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('rucom') }}
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
	<div class="col-md-3">
		<div class="form-group row">
			{{ Form::label('archivo', 'Firma:', ['class' => 'col-md-4']) }}
			<div class="col-md-8">
				{{ Form::file('archivo', ['accept' => 'image/*']) }}
			</div>
			@if($errors->has('archivo'))
				<div class="invalid-feedback d-block">
		        	{{ $errors->first('archivo') }}
		      	</div>
		    @endif
		</div>
	</div>
</div>