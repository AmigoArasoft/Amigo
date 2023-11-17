@if ($actionSubgrupo == 'Nuevo')
    <button wire:click="storeSubgrupo" class="btn btn-info">
        <i class="fas fa-save"></i> Guardar
    </button>
@elseif($actionSubgrupo=='Editar')
    <button wire:click="updateSubgrupo" class="btn btn-info">
        <i class="fas fa-edit"></i> Actualizar
    </button>
@else
    <button wire:click="destroySubgrupo" class="btn btn-{{ ($actionSubgrupo=='Desactivar') ? 'danger' : 'success' }}">
        <i class="fas fa-{{ ($actionSubgrupo=='Desactivar') ? 'times' : 'check' }}"></i> {{ ($actionSubgrupo=='Desactivar') ? 'Desactivar' : 'Activar' }}
    </button>
@endif
<button wire:click="defaultSubgrupo" class="btn btn-info">
    <i class="fas fa-undo"></i> Cancelar
</button>