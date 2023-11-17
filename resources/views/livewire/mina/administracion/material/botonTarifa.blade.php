@if ($actionTarifa == 'Nueva')
    <button wire:click="storeTarifa" class="btn btn-info">
        <i class="fas fa-save"></i> Guardar
    </button>
@elseif($actionTarifa=='Editar')
    <button wire:click="updateTarifa" class="btn btn-info">
        <i class="fas fa-edit"></i> Actualizar
    </button>
@else
    <button wire:click="destroyTarifa" class="btn btn-{{ ($actionTarifa=='Desactivar') ? 'danger' : 'success' }}">
        <i class="fas fa-{{ ($actionTarifa=='Desactivar') ? 'times' : 'check' }}"></i> {{ ($actionTarifa=='Desactivar') ? 'Desactivar' : 'Activar' }}
    </button>
@endif
<button wire:click="defaultTarifa" class="btn btn-info">
    <i class="fas fa-undo"></i> Cancelar
</button>