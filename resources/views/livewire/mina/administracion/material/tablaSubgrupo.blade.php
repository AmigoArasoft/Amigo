<div class="row">
    <div class="col-sm-6 mb-2">
        Sub grupos
        @can('Material crear')
            <a class="btn btn-sm btn-info text-white" wire:click="createSubgrupo">
                <i class="fas fa-plus-circle"></i> Nuevo
            </a>
        @endcan
    </div>
    <div class="col-sm-6 justify-content-end">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Buscar:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" wire:model="searchSubgrupo">
            </div>
        </div>
    </div>
</div>
@if($subgrupos->count()>0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="text-center">
                <tr>
                    @canany(['Material editar', 'Material borrar'])
                        <th width="180px">Acción</th>
                    @endcanany
                    <th>Nombre</th>
                    <th>Material</th>
                    <th>Especificación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subgrupos as $e)
                    <tr>
                        <td{{ $e->materiales->count() > 1 ? ' rowspan='.$e->materiales->count().'' : '' }}>
                            <button wire:click="editSubgrupo({{ $e->id }}, 'Editar')" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button wire:click="editSubgrupo({{ $e->id }}, '{{ ($e->activo) ? 'Desactivar' : 'Activar' }}')" class="btn btn-sm btn-{{ ($e->activo) ? 'danger' : 'success' }}">
                                <i class="fas fa-{{ ($e->activo) ? 'times' : 'check' }}"></i> {{ ($e->activo) ? 'Desactivar' : 'Activar' }}
                            </button>
                        </td>
                        <td{{ $e->materiales->count() > 1 ? ' rowspan='.$e->materiales->count().'' : '' }}>
                            {{ $e->nombre }}
                        </td>
                        @foreach($e->materiales as $k => $i)
                            @if($k > 0)
                                </tr><tr>
                            @endif
                            <td class="text-sm">
                                {{ $i->nombre }}
                            </td>
                            <td class="text-sm">
                                @foreach($i->especificaciones as $o)
                                    {{ $o->nombre }}
                                    @if($loop->remaining)
                                        /
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No hay registros disponibles.</p>
@endif
