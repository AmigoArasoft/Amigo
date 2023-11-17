@if ($actionGrupo == 'Nuevo')
    <button wire:click="storeGrupo" class="btn btn-info">
        <i class="fas fa-save"></i> Guardar
    </button>
@elseif($actionGrupo=='Editar')
    <button wire:click="updateGrupo" class="btn btn-info">
        <i class="fas fa-edit"></i> Actualizar
    </button>
@else
    <button wire:click="destroyGrupo" class="btn btn-{{ ($actionGrupo=='Desactivar') ? 'danger' : 'success' }}">
        <i class="fas fa-{{ ($actionGrupo=='Desactivar') ? 'times' : 'check' }}"></i> {{ ($actionGrupo=='Desactivar') ? 'Desactivar' : 'Activar' }}
    </button>
@endif
<button wire:click="defaultGrupo" class="btn btn-info">
    <i class="fas fa-undo"></i> Cancelar
</button>