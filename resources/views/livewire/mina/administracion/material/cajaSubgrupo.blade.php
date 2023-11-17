@if(!empty($actionSubgrupo))
    @include('livewire.mina.administracion.material.formaSubgrupo')
@else
    @include('livewire.mina.administracion.material.tablaSubgrupo')
@endif