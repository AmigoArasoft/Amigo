@isset($dato)
    @if(count($dato->submateriales)>0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="text-center">
                        @if($accion=='Editar')
                            @canany(['Grupo editar','Grupo borrar'])
                                <th width="80px">Acción</th>
                            @endcan
                        @endif
                        <th>Nombre</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($dato->submateriales as $d)
                        <tr>
                            @canany(['Grupo editar','Grupo borrar'])
                                @if($accion=='Editar')
                                    <td class='text-center'>
                                        @can('Grupo borrar')
                                            <a class="btn btn-xs btn-danger" href="{{ route('material.eliminar', [$dato->id, $d->id]) }}"><i class="fas fa-trash"></i> Eliminar</a>
                                        @endcan
                                    </td>
                                @endif
                                <td>{{ $d->nombre }}</td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No hay datos</p>
    @endif
@endisset