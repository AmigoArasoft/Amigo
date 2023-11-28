@canany(['Usuario leer', 'Usuario crear', 'Usuario editar', 'Usuario borrar',
    'Rol leer', 'Rol crear', 'Rol editar', 'Rol borrar',
    'Permiso leer', 'Permiso crear', 'Permiso editar', 'Permiso borrar'
])
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-lock"></i>
            <p>
                Acceso
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @canany(['Usuario leer', 'Usuario crear', 'Usuario editar', 'Usuario borrar'])
                <li class="nav-item">
                    <a href="{{ route('usuario') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
            @endcanany
            @canany(['Rol leer', 'Rol crear', 'Rol editar', 'Rol borrar'])
                <li class="nav-item">
                    <a href="{{ route('rol') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
            @endcanany
            @canany(['Permiso leer', 'Permiso crear', 'Permiso editar', 'Permiso borrar'])
                <li class="nav-item">
                    <a href="{{ route('permiso') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Permisos</p>
                    </a>
                </li>
            @endcanany
            @canany(['Topes'])
                <li class="nav-item">
                    <a href="{{ route('tope') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Topes</p>
                    </a>
                </li>
            @endcanany
        </ul>
    </li>
@endcanany