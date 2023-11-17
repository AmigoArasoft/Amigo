<div class="row">
    <div class="col">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" class="form-control" placeholder="Nombre del grupo" wire:model="nombreGrupo"{{ ($actionGrupo=='Desactivar') ? ' disabled' : '' }}>
            @error('nombreGrupo')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label>Sub grupo</label>
            <div class="row">
                @foreach($subgruposLista as $i)
                    <div class="col-md-3">
                        <input wire:model="subgrupo" type="checkbox" value="{{ $i->id }}"{{ ($actionGrupo=='Desactivar') ? ' disabled' : '' }}> {{ $i->nombre }}
                    </div>
                @endforeach
                @error('subgrupo')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>