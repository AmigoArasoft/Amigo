<div class="row">
    <div class="col-sm-6 mb-2">
        Tarifas
        @can('Material crear')
            <a class="btn btn-sm btn-info text-white" wire:click="createTarifa">
                <i class="fas fa-plus-circle"></i> Nueva
            </a>
        @endcan
    </div>
    <div class="col-sm-6 justify-content-end">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Buscar:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" wire:model="searchTarifa">
            </div>
        </div>
    </div>
</div>
@if($tarifas->count()>0)
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="text-center">
                <tr>
                    @canany(['Material editar', 'Material borrar'])
                        <th width="180px">Acción</th>
                    @endcanany
                    <th>Nombre</th>
                    <th>Material</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tarifas as $e)
                <tr>
                    <td {{ $e->materiales->count() > 1 ? ' rowspan='.$e->materiales->count().'' : '' }}>
                        <button wire:click="editTarifa({{ $e->id }}, 'Editar')" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button wire:click="editTarifa({{ $e->id }}, '{{ ($e->activo) ? 'Desactivar' : 'Activar' }}')" class="btn btn-sm btn-{{ ($e->activo) ? 'danger' : 'success' }}">
                            <i class="fas fa-{{ ($e->activo) ? 'times' : 'check' }}"></i> {{ ($e->activo) ? 'Desactivar' : 'Activar' }}
                        </button>
                    </td>
                    <td {{ $e->materiales->count() > 1 ? ' rowspan='.$e->materiales->count().'' : '' }}>
                        {{ $e->nombre }}
                    </td>
                    @foreach($e->materiales as $k => $i)
                        @if($k > 0)
                            </tr><tr>
                        @endif
                        <td class="text-sm">
                            {{ $i->nombre }}
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
