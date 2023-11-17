<h5 class="text-{{ ($actionMaterial=='Desactivar') ? 'danger' : 'info' }}">{{ $actionMaterial }} material</h5>
@include('livewire.mina.administracion.material.campoMaterial')
@include('livewire.mina.administracion.material.botonMaterial')