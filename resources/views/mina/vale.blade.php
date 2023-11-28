@extends('plantilla.externo.index')

@section('titulo', 'Certificado de Vale')

@section('vinculo')
<li class="breadcrumb-item active">Certificado de Vale</li>
@endsection

@section('contenido')
{!! Form::open(['route' => 'getVale', 'name' => 'forma', 'target' => 'blank']) !!}
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="form-group row">
                {{ Form::label('id', 'No. Certificado Vale:', ['class' => 'col-md-8']) }}
                <div class="col-md-4">
                    {{ Form::number('id', null, ['class' => $errors->first('id') ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm', 'min' => 1, 'required', 'autofocus']) }}
                </div>
                @if($errors->has('id'))
                    <div class="invalid-feedback d-block">
                        {{ $errors->first('id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-2">
            {{ Form::button('<i class="fas fa-search"></i> Consultar', ['type' => 'submit', 'class' => 'btn btn-sm btn-info']) }}
        </div>
    </div>
{!! Form::close() !!}
@endsection