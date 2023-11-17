<h5 class="text-{{ ($actionTarifa=='Desactivar') ? 'danger' : 'info' }}">{{ $actionTarifa }} Tarifa</h5>
@include('livewire.mina.administracion.material.campoTarifa')
@include('livewire.mina.administracion.material.botonTarifa')