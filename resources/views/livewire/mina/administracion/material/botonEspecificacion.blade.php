@if ($actionEspecificacion == 'Nueva')
    <button wire:click="storeEspecificacion" class="btn btn-info">
        <i class="fas fa-save"></i> Guardar
    </button>
@elseif($actionEspecificacion=='Editar')
    <button wire:click="updateEspecificacion" class="btn btn-info">
        <i class="fas fa-edit"></i> Actualizar
    </button>
@else
    <button wire:click="destroyEspecificacion" class="btn btn-{{ ($actionEspecificacion=='Desactivar') ? 'danger' : 'success' }}">
        <i class="fas fa-{{ ($actionEspecificacion=='Desactivar') ? 'times' : 'check' }}"></i> {{ ($actionEspecificacion=='Desactivar') ? 'Desactivar' : 'Activar' }}
    </button>
@endif
<button wire:click="defaultEspecificacion" class="btn btn-info">
    <i class="fas fa-undo"></i> Cancelar
</button>