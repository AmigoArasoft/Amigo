@if($accion == 'Nuevo')
	@can('Rol crear')
		{{ Form::button('<i class="fas fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@elseif($accion == 'Editar')
	@can('Rol editar')
		{{ Form::button('<i class="fas fa-edit"></i> Modificar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@elseif($accion == 'Borrar')
	@can('Rol borrar')
		{!! Form::open(['route' => ['rol.ver', $dato->id], 'method' => 'DELETE']) !!}
			{{ Form::button('<i class="fas fa-trash"></i> Eliminar', ['type' => 'submit', 'class' => 'btn btn-danger float-left']) }}
        {!! Form::close() !!}
	@endcan
@endif
<a class="btn btn-info ml-2" href="{{ route('rol') }}"><i class="fas fa-undo"></i> Regresar</a>