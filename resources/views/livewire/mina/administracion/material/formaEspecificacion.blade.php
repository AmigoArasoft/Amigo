<h5 class="text-{{ ($actionEspecificacion=='Desactivar') ? 'danger' : 'info' }}">{{ $actionEspecificacion }} especificación</h5>
@include('livewire.mina.administracion.material.campoEspecificacion')
@include('livewire.mina.administracion.material.botonEspecificacion')