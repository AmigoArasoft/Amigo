<div class="row">
    <div class="col-sm-6 mb-2">
        Materiales
        @can('Material crear')
            <a class="btn btn-sm btn-info text-white" wire:click="createMaterial">
                <i class="fas fa-plus-circle"></i> Nuevo
            </a>
        @endcan
    </div>
    <div class="col-sm-6 justify-content-end">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Buscar:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" wire:model="searchMaterial">
            </div>
        </div>
    </div>
</div>
@if($materiales->count()>0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="text-center">
                <tr>
                    @canany(['Material editar', 'Material borrar'])
                        <th width="180px">Acción</th>
                    @endcanany
                    <th>Nombre</th>
                    <th>Especificación</th>
                    <th>Norma de ensayo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiales as $e)
                    <tr>
                        <td{{ $e->especificaciones->count() > 1 ? ' rowspan='.$e->especificaciones->count().'' : '' }}>
                            <button wire:click="editMaterial({{ $e->id }}, 'Editar')" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button wire:click="editMaterial({{ $e->id }}, '{{ ($e->activo) ? 'Desactivar' : 'Activar' }}')" class="btn btn-sm btn-{{ ($e->activo) ? 'danger' : 'success' }}">
                                <i class="fas fa-{{ ($e->activo) ? 'times' : 'check' }}"></i> {{ ($e->activo) ? 'Desactivar' : 'Activar' }}
                            </button>
                        </td>
                        <td{{ $e->especificaciones->count() > 1 ? ' rowspan='.$e->especificaciones->count().'' : '' }}>
                            {{ $e->nombre }}
                        </td>
                        @forelse($e->especificaciones as $k => $i)
                            @if($k > 0)
                                </tr><tr>
                            @endif
                            <td class="text-sm">
                                {{ $i->nombre }}
                            </td>
                            <td class="text-sm">
                                @if($e->especificaciones->count() > 0 )
                                    @foreach($e->especificaciones as $i)
                                        @foreach($i->normas as $o)
                                            {{ $o->nombre }}
                                            @if($loop->remaining)
                                                /
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                            </td>
                        @empty
                            <td></td>
                            <td></td>
                        @endforelse
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No hay registros disponibles.</p>
@endif
