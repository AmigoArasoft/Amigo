@can('Rol editar')
	<a class="btn btn-xs btn-info" href="{{ route('rol.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan
@can('Rol borrar')
	<a class="btn btn-xs btn-danger" href="{{ route('rol.ver', $id) }}"><i class="fas fa-trash"></i> Eliminar</a>
@endcan