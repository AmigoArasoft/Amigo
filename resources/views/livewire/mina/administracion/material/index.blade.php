<div>
    <div class="card card-info">
        <div class="card-header pb-0">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link{{ ($tab == 5) ? ' active': '' }}" id="nav-tarifa-tab" data-toggle="tab" href="#nav-tarifa" role="tab" aria-controls="nav-tarifa" aria-selected="true">Tarifa</a>
                    <a class="nav-link{{ ($tab == 4) ? ' active': '' }}" id="nav-grupo-tab" data-toggle="tab" href="#nav-grupo" role="tab" aria-controls="nav-grupo" aria-selected="true">Grupo</a>
                    <a class="nav-link{{ ($tab == 3) ? ' active': '' }}" id="nav-subgrupo-tab" data-toggle="tab" href="#nav-subgrupo" role="tab" aria-controls="nav-subgrupo" aria-selected="false">Sub Grupo</a>
                    <a class="nav-link{{ ($tab == 2) ? ' active': '' }}" id="nav-material-tab" data-toggle="tab" href="#nav-material" role="tab" aria-controls="nav-material" aria-selected="false">Material</a>
                    <a class="nav-link{{ ($tab == 1) ? ' active': '' }}" id="nav-especificacion-tab" data-toggle="tab" href="#nav-especificacion" role="tab" aria-controls="nav-especificacion" aria-selected="false">Especificación</a>
                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade{{ ($tab == 5) ? ' show active': '' }}" id="nav-tarifa" role="tabpanel" aria-labelledby="nav-tarifa-tab">
                    @include('livewire.mina.administracion.material.cajaTarifa')
                </div>
                <div class="tab-pane fade{{ ($tab == 4) ? ' show active': '' }}" id="nav-grupo" role="tabpanel" aria-labelledby="nav-grupo-tab">
                    @include('livewire.mina.administracion.material.cajaGrupo')
                </div>
                <div class="tab-pane fade{{ ($tab == 3) ? ' show active': '' }}" id="nav-subgrupo" role="tabpanel" aria-labelledby="nav-subgrupo-tab">
                    @include('livewire.mina.administracion.material.cajaSubgrupo')
                </div>
                <div class="tab-pane fade{{ ($tab == 2) ? ' show active': '' }}" id="nav-material" role="tabpanel" aria-labelledby="nav-material-tab">
                    @include('livewire.mina.administracion.material.cajaMaterial')
                </div>
                <div class="tab-pane fade{{ ($tab == 1) ? ' show active': '' }}" id="nav-especificacion" role="tabpanel" aria-labelledby="nav-especificacion-tab">
                    @include('livewire.mina.administracion.material.cajaEspecificacion')
                </div>
            </div>
        </div>
    </div>
</div>