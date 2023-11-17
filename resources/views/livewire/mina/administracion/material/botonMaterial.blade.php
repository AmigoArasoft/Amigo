@if ($actionMaterial == 'Nuevo')
    <button wire:click="storeMaterial" class="btn btn-info">
        <i class="fas fa-save"></i> Guardar
    </button>
@elseif($actionMaterial=='Editar')
    <button wire:click="updateMaterial" class="btn btn-info">
        <i class="fas fa-edit"></i> Actualizar
    </button>
@else
    <button wire:click="destroyMaterial" class="btn btn-{{ ($actionMaterial=='Desactivar') ? 'danger' : 'success' }}">
        <i class="fas fa-{{ ($actionMaterial=='Desactivar') ? 'times' : 'check' }}"></i> {{ ($actionMaterial=='Desactivar') ? 'Desactivar' : 'Activar' }}
    </button>
@endif
<button wire:click="defaultMaterial" class="btn btn-info">
    <i class="fas fa-undo"></i> Cancelar
</button>