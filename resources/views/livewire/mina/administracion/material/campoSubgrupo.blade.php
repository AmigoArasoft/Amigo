<div class="row">
    <div class="col">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre del sub grupo" wire:model="nombreSubgrupo"{{ ($actionSubgrupo=='Desactivar') ? ' disabled' : '' }}>
            @error('nombreSubgrupo')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Material</label>
            <div class="row">
                @foreach($materialesLista as $i)
                    <div class="col-md-3">
                        <input wire:model="material" type="checkbox" value="{{ $i->id }}"{{ ($actionSubgrupo=='Desactivar') ? ' disabled' : '' }}> {{ $i->nombre }}
                    </div>
                @endforeach
                @error('material')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>