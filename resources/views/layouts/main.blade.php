<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Deliverboo</title>
</head>

<body>
    <div id="app">
        <nav>
            <div class="container">
                <div class="row">
                    <div class="col-4 d-flex justify-content-between align-items-center">
                        <a href="{{ route('restaurant.index') }}" id="navbar-logo">
                            <img src="/img/logo/logo_black@2x.png" alt="" >
                        </a>
                    </div>
                    <div class="col-8 d-none d-xl-flex justify-content-end align-items-center">
                        <ul
                            class="d-flex justify-content-between align-items-center ">
                            <li><a href="{{ route('restaurant.index') }}"><h5>Home</h5></a></li>
                            <li><a href="{{ route('restaurant.index') }}"><h5>Aiuto</h5></a></li>
                            @guest
                                <li><a href="{{ route('login') }}">
                                        <h5>Area Ristoratori</h5>
                                    </a></li>
                                {{-- <li><a href="{{ route('register') }}">Registrati</a></li> --}}
                            @endguest
                            @if (Auth::check())
                                @if (isset(Auth::user()->getRestaurant))
                                    <li><a href="{{ route('restaurant.show', Auth::user()->getRestaurant->id) }}">
                                            <h5>Dashboard</h5>
                                        </a>
                                    </li>
                                @else
                                    <li><a  href="{{ route('restaurant.create') }}">
                                            <h5>Crea ristorante</h5>
                                        </a></li>
                                @endif

                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <input type="submit" value="Logout" class="black-button">
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-6 offset-2 d-xl-none d-flex justify-content-end align-items-center">
                        <img src="/img/homepage/icon/menu.png" alt="" id="navbar-menu-icon">
                    </div>
                </div>
            </div>
            {{-- Menu laterale --}}
            <div class="not-visible" id="route-menu">
                <h6 id="close-button" class="d-none">CHIUDI</h6>
                <ul class="d-none flex-column justify-content-center align-items-start" id="navbar-list">
                    <li class="mb-4"><a href="{{ route('restaurant.index') }}">
                            <h5 id="home-margin">Home</h5>
                        </a></li>
                    @guest
                        <li class="mb-4"><a href="{{ route('login') }}">
                                <h5>Area Ristoratori</h5>
                            </a>
                        </li>
                    @endguest
                    @if (Auth::check())
                        @if (isset(Auth::user()->getRestaurant))
                            <li class="mb-4"><a
                                    href="{{ route('restaurant.show', Auth::user()->getRestaurant->id) }}">
                                    <h5>Dashboard</h5>
                                </a>
                            </li>
                        @else
                            <li class="mb-4"><a href="{{ route('restaurant.create') }}">
                                    <h5>Crea Ristorante</h5>
                                </a>
                            </li>
                        @endif

                        <li class="mb-4">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input id="media-logout" type="submit" value="Logout" class="primary-button">
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
        <footer>
            <FooterComponent></FooterComponent>
        </footer>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        let button = document.getElementById('navbar-menu-icon')
        let closeButton = document.getElementById('close-button')
        let menu = document.getElementById('route-menu');
        let list = document.getElementById('navbar-list');
        button.addEventListener('click', () => {
            menu.classList.remove('not-visible');
            menu.classList.add('visible');
            closeButton.classList.remove('d-none');
            closeButton.classList.add('d-block');
            list.classList.remove('d-none');
            list.classList.add('d-flex');
        });
        closeButton.addEventListener('click', () => {
            menu.classList.remove('visible');
            menu.classList.add('not-visible');
            closeButton.classList.remove('d-block');
            closeButton.classList.add('d-none');
            list.classList.remove('d-flex');
            list.classList.add('d-none');
        })

    </script>
</body>


</html>
