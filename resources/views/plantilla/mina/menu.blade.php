
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('mina') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>
    @auth
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @if(Auth::user()->tercero_id == 1)
                        @include('plantilla.mina.menu.acceso')
                        @include('plantilla.mina.menu.administracion')
                        @include('plantilla.mina.menu.empresa')
                    @endif
                    @include('plantilla.mina.menu.viaje')
                </ul>
            </nav>
        </div>
    @endauth
</aside>