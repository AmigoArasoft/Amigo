<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        @auth
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        @endauth
        <li class="nav-item">
            <img style="height: 40px;" class="img-rounded elevation-3 bg-light" src="{{ asset('img/logo_letras_blancas.png') }}" alt="{{ config('app.name', 'Laravel') }}">
        </li>
    </ul>
</nav>