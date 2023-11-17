@can('Viaje editar')
	<a class="btn btn-xs btn-info" href="{{ route('viaje.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan
@can('Viaje borrar')
	@if($activo==1)
		<a class="btn btn-xs btn-danger" href="{{ route('viaje.activar', $id) }}"><i class="fas fa-times-circle"></i> Inactivar</a>
	@else
		<a class="btn btn-xs btn-info" href="{{ route('viaje.activar', $id) }}"><i class="fas fa-check-circle"></i> Activar</a>
	@endif
@endcan