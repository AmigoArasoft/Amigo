@if($accion == 'Nuevo')
	@can('Usuario crear')
		{{ Form::button('<i class="fas fa-save"></i> Guardar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@elseif($accion == 'Editar')
	@can('Usuario editar')
		{{ Form::button('<i class="fas fa-edit"></i> Modificar', ['type' => 'submit', 'class' => 'btn btn-info']) }}
	@endcan
@elseif($accion == 'Borrar')
	@can('Usuario borrar')
		{!! Form::open(['route' => ['usuario.ver', $dato->id], 'method' => 'DELETE']) !!}
			@if($dato->activo==1)
				{{ Form::button('<i class="fas fa-times-circle"></i> Inactivar', ['type' => 'submit', 'class' => 'btn btn-danger float-left']) }}
			@else
				{{ Form::button('<i class="fas fa-check-circle"></i> Activar', ['type' => 'submit', 'class' => 'btn btn-info float-left']) }}
			@endif
        {!! Form::close() !!}
	@endcan
@endif
<a class="btn btn-info ml-2" href="{{ route('usuario') }}"><i class="fas fa-undo"></i> Regresar</a>