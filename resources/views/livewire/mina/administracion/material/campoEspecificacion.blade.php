<div class="row">
    <div class="col">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre de la especificación" wire:model="nombreEspecificacion"{{ ($actionEspecificacion=='Desactivar') ? ' disabled' : '' }}>
            @error('nombreEspecificacion')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Norma de ensayo</label>
            <div class="row">
                @foreach($normas as $i)
                    <div class="col-md-3">
                        <input wire:model="norma" type="checkbox" value="{{ $i->id }}"{{ ($actionEspecificacion=='Desactivar') ? ' disabled' : '' }}> {{ $i->nombre }}
                    </div>
                @endforeach
                @error('norma')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        @if ($actionEspecificacion != 'Desactivar')
            <div class="row">
                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Adicionar norma de ensayo" maxlength="180" wire:model="nombreNorma">
                    @error('nombreNorma')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-md-3">
                    <button wire:click="storeNorma" class="btn btn-info">
                        <i class="fas fa-plus-circle"></i> Adicionar
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>