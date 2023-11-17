@if(!empty($actionMaterial))
    @include('livewire.mina.administracion.material.formaMaterial')
@else
    @include('livewire.mina.administracion.material.tablaMaterial')
@endif