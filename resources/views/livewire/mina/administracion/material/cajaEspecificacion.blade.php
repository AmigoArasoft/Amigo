@if(!empty($actionEspecificacion))
    @include('livewire.mina.administracion.material.formaEspecificacion')
@else
    @include('livewire.mina.administracion.material.tablaEspecificacion')
@endif