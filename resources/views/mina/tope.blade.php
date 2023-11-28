@extends('plantilla.mina.index')

@section('titulo', 'Ingreso de Tope')

@section('vinculo')
<li class="breadcrumb-item active">Ingreso de Tope</li>
@endsection

@section('contenido')
{!! Form::open(['route' => 'tope', 'name' => 'forma', 'target' => 'blank', 'method' => 'POST']) !!}
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="form-group row">
                {{ Form::label('tope', 'Tope de Informe (Numérico):', ['class' => 'col-md-8']) }}
                <div class="col-md-4">
                    {{ Form::number('tope', isset($tope) ? $tope : "", ['class' => $errors->first('tope') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => 1, 'required', 'autofocus']) }}
                </div>
                @if($errors->has('tope'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('tope') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            {{ Form::button('<i class="fas fa-search"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) }}
        </div>
    </div>
{!! Form::close() !!}
@endsection