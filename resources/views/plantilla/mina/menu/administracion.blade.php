@canany(['Parametro leer', 'Parametro crear', 'Parametro editar', 'Parametro borrar',
        'Grupo leer', 'Grupo crear', 'Grupo editar', 'Grupo borrar',
        'Tercero leer', 'Tercero crear', 'Tercero editar', 'Tercero borrar',
        'Material leer', 'Material crear', 'Material editar', 'Material borrar',
        'Tema leer', 'Tema crear', 'Tema editar', 'Tema  borrar',
    ])
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
                Administración
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @canany(['Tercero leer', 'Tercero crear', 'Tercero editar', 'Tercero borrar'])
                <li class="nav-item">
                    <a href="{{ route('tercero') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Terceros</p>
                    </a>
                </li>
            @endcanany
            @canany(['Tema leer', 'Tema crear', 'Tema editar', 'Tema borrar'])
                <li class="nav-item">
                    <a href="{{ route('tema') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Temas</p>
                    </a>
                </li>
            @endcanany
            @canany(['Material leer', 'Material crear', 'Material editar', 'Material borrar'])
                <li class="nav-item">
                    <a href="{{ route('material') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Materiales</p>
                    </a>
                </li>
            @endcanany
{{--            @canany(['Material leer', 'Material crear', 'Material editar', 'Material borrar'])--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('material1') }}" class="nav-link">--}}
{{--                        <i class="fas fa-caret-right nav-icon"></i>--}}
{{--                        <p>Materiales 1</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcanany--}}
            @canany(['Grupo leer', 'Grupo crear', 'Grupo editar', 'Grupo borrar'])
                <li class="nav-item">
                    <a href="{{ route('grupo') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Grupos</p>
                    </a>
                </li>
            @endcanany
            @canany(['Parametro leer', 'Parametro crear', 'Parametro editar', 'Parametro borrar'])
                <li class="nav-item">
                    <a href="{{ route('parametro') }}" class="nav-link">
                        <i class="fas fa-caret-right nav-icon"></i>
                        <p>Parámetros</p>
                    </a>
                </li>
            @endcanany
        </ul>
    </li>
@endcanany
