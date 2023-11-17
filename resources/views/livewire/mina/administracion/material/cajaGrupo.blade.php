@if(!empty($actionGrupo))
    @include('livewire.mina.administracion.material.formaGrupo')
@else
    @include('livewire.mina.administracion.material.tablaGrupo')
@endif