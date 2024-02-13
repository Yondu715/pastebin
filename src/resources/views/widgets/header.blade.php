<header>
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Pastebin</a>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Контакты</a>
                </li>
            </ul>

            <div>
                @auth
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Выход</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                @guest
                    <a class="btn btn-primary mr-2" href="{{ route('auth.login') }}">Вход</a>
                    <a class="btn btn-success" href="{{ route('auth.register') }}">Регистрация</a>
                @endguest
            </div>
        </div>
    </div>
</header>
