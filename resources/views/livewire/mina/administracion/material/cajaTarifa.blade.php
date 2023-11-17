@if(!empty($actionTarifa))
    @include('livewire.mina.administracion.material.formaTarifa')
@else
    @include('livewire.mina.administracion.material.tablaTarifa')
@endif