@canany(['Empresa leer', 'Empresa crear', 'Empresa editar', 'Empresa borrar',
        'Operador leer', 'Operador crear', 'Operador editar', 'Operador borrar',
        'Transporte leer', 'Transporte crear', 'Transporte editar', 'Transporte borrar',
        'Vehiculo leer', 'Vehiculo crear', 'Vehiculo editar', 'Vehiculo borrar',
        'Documento leer', 'Documento crear', 'Documento editar', 'Documento borrar',
    ])
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-landmark"></i>
            <p>
                Empresa
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @canany(['Documento leer', 'Documento crear', 'Documento editar', 'Documento borrar'])
                <li class="nav-item">
                    <a href="{{ route('documento') }}" class="nav-link">
                        <i class="nav-icon fas fa-caret-right"></i>
                        <p>Documento</p>
                    </a>
                </li>
            @endcanany
            @canany(['Empresa leer', 'Empresa crear', 'Empresa editar', 'Empresa borrar'])
                <li class="nav-item">
                    <a href="{{ route('empresa') }}" class="nav-link">
                        <i class="nav-icon fas fa-caret-right"></i>
                        <p>Empresa</p>
                    </a>
                </li>
            @endcanany
            @canany(['Operador leer', 'Operador crear', 'Operador editar', 'Operador borrar'])
                <li class="nav-item">
                    <a href="{{ route('operador') }}" class="nav-link">
                        <i class="nav-icon fas fa-caret-right"></i>
                        <p>Operador</p>
                    </a>
                </li>
            @endcanany
            @canany(['Transporte leer', 'Transporte crear', 'Transporte editar', 'Transporte borrar'])
                <li class="nav-item">
                    <a href="{{ route('transporte') }}" class="nav-link">
                        <i class="nav-icon fas fa-caret-right"></i>
                        <p>Transportador</p>
                    </a>
                </li>
            @endcanany
            @canany(['Vehiculo leer', 'Vehiculo crear', 'Vehiculo editar', 'Vehiculo borrar'])
                <li class="nav-item">
                    <a href="{{ route('vehiculo') }}" class="nav-link">
                        <i class="nav-icon fas fa-caret-right"></i>
                        <p>Vehículo</p>
                    </a>
                </li>
            @endcanany
        </ul>
    </li>
@endcanany