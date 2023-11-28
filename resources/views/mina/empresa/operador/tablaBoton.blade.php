@can('Operador editar')
	<a class="btn btn-xs btn-info" href="{{ route('operador.editar', $id) }}"><i class="fas fa-edit"></i> Editar</a>
@endcan

@can('Operador inactivar')
	<a class="btn btn-xs btn-warning" href="{{ route('operador.actualizarEstado', [$id, 0]) }}"><i class="fas fa-times"></i> Inactivar</a>
@endcan