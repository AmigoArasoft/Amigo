@extends('plantilla.mina.index')

@section('titulo', 'Cambio de clave')

@section('vinculo')
<li class="breadcrumb-item"><a href="{{ route('/') }}">Inicio</a></li>
<li class="breadcrumb-item active">Cambio de clave</li>
@endsection

@section('contenido')
<div class="container-fluid">
	<div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info mx-4">
                <div class="card-header">
                    <h1 class="card-title">Cambio de clave</h1>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted">Cambie su clave de acceso al sistema.</p>
                    {!! Form::open(['route' => 'clave']) !!}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            {{ Form::password('current_password', ['class' => 'form-control', 'placeholder' => 'Clave actual', 'required', 'autofocus']) }}
                            @if($errors->has('current_password'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('current_password') }}
                                </div>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nueva clave', 'required']) }}
                            @if($errors->has('password'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirme nueva clave', 'required']) }}
                            @if($errors->has('password_confirmation'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                        {{ Form::button('<i class="fas fa-edit"></i> Cambiar clave', ['type' => 'submit', 'class' => 'btn btn-block btn-info']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection