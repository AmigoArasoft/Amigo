@canany(['Factura leer', 'Factura crear', 'Factura editar', 'Factura borrar'])
    <li class="nav-item">
        <a href="{{ route('factura') }}" class="nav-link">
            <i class="nav-icon fas fa-file-invoice"></i>
            <p>Factura</p>
        </a>
    </li>
@endcanany
@canany(['Cubicaje leer', 'Cubicaje crear', 'Cubicaje editar', 'Cubicaje borrar'])
    <li class="nav-item">
        <a href="{{ route('cubicaje') }}" class="nav-link">
            <i class="nav-icon fas fa-ruler-combined"></i>
            <p>Cubicaje</p>
        </a>
    </li>
@endcanany
@canany(['Viaje leer', 'Viaje crear', 'Viaje editar', 'Viaje borrar'])
    <li class="nav-item">
        <a href="{{ route('viaje') }}" class="nav-link">
            <i class="nav-icon fas fa-truck-loading"></i>
            <p>Viaje</p>
        </a>
    </li>
@endcanany