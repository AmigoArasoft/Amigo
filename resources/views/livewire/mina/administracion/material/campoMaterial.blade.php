<div class="row">
    <div class="col">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre del material" wire:model="nombreMaterial"{{ ($actionMaterial=='Desactivar') ? ' disabled' : '' }}>
            @error('nombreMaterial')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Especificación</label>
            <div class="row">
                @foreach($especificacionesLista as $i)
                    <div class="col-md-3">
                        <input wire:model="especificacion" type="checkbox" value="{{ $i->id }}"{{ ($actionMaterial=='Desactivar') ? ' disabled' : '' }}> {{ $i->nombre }}
                    </div>
                @endforeach
                @error('especificacion')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>