@can('Rol editar')
	<a class="btn btn-xs btn-info" href="{{ route('usuario.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan
@can('Rol borrar')
	@if($activo==1)
		<a class="btn btn-xs btn-danger" href="{{ route('usuario.ver', $id) }}"><i class="fas fa-times-circle"></i> Inactivar</a>
	@else
		<a class="btn btn-xs btn-info" href="{{ route('usuario.ver', $id) }}"><i class="fas fa-check-circle"></i> Activar</a>
	@endif
@endcan