@isset($dato)
    @if(count($dato->subtemas)>0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead>
                    <tr class="text-center">
                        @if($accion=='Editar')
                            @canany(['Tema editar','Tema borrar'])
                                <th width="80px">Acción</th>
                            @endcan
                        @endif
                        <th>Nombre</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($dato->subtemas as $d)
                        <tr>
                            @canany(['Tema editar','Tema borrar'])
                                @if($accion=='Editar')
                                    <td class='text-center'>
                                        @can('Tema borrar')
                                            <a class="btn btn-xs btn-danger" href="{{ route('tema.eliminar', [$dato->id, $d->id]) }}"><i class="fas fa-trash"></i> Eliminar</a>
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