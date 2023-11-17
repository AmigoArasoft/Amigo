<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">{{ $dato->nombre }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <p><b>Nombre:</b> {{ $dato->nombre }}</p>
                <p><b>Teléfono:</b> {{ $dato->telefono }}</p>
            </div>
            <div class="col-md-6">
                <p><b>Persona:</b> {{ $dato->persona->nombre }}</p>
                <p><b>Dirección:</b> {{ $dato->direccion }}</p>
            </div>
            <div class="col-md-3">
                <p><b>{{ $dato->tipo->nombre }}:</b> {{ $dato->documento }}</p>
                <p><b>Email:</b> {{ $dato->email }}</p>
            </div>
        </div>
        @include('mina.empresa.empresa.formaContacto')
    </div>
</div>