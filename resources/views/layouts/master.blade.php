<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <head>
        {{--Meta tagas and title--}}
        <meta charset="UTF-8">
        <meta name="description" content="Demien site>">
        <meta name="keywords" content="k>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        {{--Common CSS files--}}
        <link href="/css/style.css" rel="stylesheet">

        {{--jQuery--}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        {{--Botstrap--}}
        <meta name="viewport" content="width=device-width, initial-scale=1">
{{--        <link--}}
{{--            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"--}}
{{--            rel="stylesheet"--}}
{{--            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"--}}
{{--            crossorigin="anonymous">--}}
    </head>

    <body>
        <header>
            <nav class="menu-content">
                @auth
                    <div class="menu">
                        <a href="{{ route(name: 'index') }}" @routeactive('index')>
                            <i class="fa-solid fa-house"></i><span class="menu-space">Main</span>
                        </a>
                        <a href="{{ route(name: 'categories') }}" @routeactive('categories')>
                            <i class="fa-solid fa-bars"></i><span class="menu-space">Categories</span>
                        </a>
                        @admin
                        <a href="{{ route(name: 'categories.index') }}" @routeactive('categories.index')>
                            <i class="fa-solid fa-bars"></i><span class="menu-space">Categories (A)</span>
                        </a>
                        <a href="{{ route(name: 'products.index') }}" @routeactive('products.index')>
                            <i class="fa-brands fa-apple"></i><span class="menu-space">Products (A)</span>
                        </a>
                        @endadmin
                        <a href="{{ route(name: 'basket') }}" @routeactive('basket*')>
                            <i class="fa-solid fa-basket-shopping"></i><span class="menu-space">Basket</span>
                        </a>
                    </div>
                    <div class="menu">
                        <a href="{{ route(name: 'get-logout') }}" class="menu-a">
                            <i class="fa-solid fa-right-from-bracket"></i><span class="menu-space">Logout</span>
                        </a>
                        @admin
                            <a href="{{ route(name: 'home') }}" @routeactive('home')>
                                <i class="fa-solid fa-toolbox"></i><span class="menu-space">Admin panel</span>
                            </a>
                            <a href="{{ route(name: 'reset') }}" @routeactive('reset')>
                                <i class="fa-solid fa-backward-step"></i><span class="menu-space">Set to default</span>
                            </a>
                        @else
                            <a href="{{ route(name: 'person.orders.index') }}" @routeactive('person.orders.index')>
                                <i class="fa-solid fa-cart-shopping"></i><span class="menu-space">My orders</span>
                            </a>
                        @endadmin
                    </div>
                @endauth

                @guest
                    <div class="menu">
                        <a href="{{ route(name: 'index') }}" @routeactive('index')>
                            <i class="fa-solid fa-house"></i><span class="menu-space">Main</span>
                        </a>
                        <a href="{{ route(name: 'categories') }}" @routeactive('categor*')>
                            <i class="fa-solid fa-bars"></i><span class="menu-space">Categories</span>
                        </a>
                        <a href="{{ route(name: 'basket') }}" @routeactive('basket*')>
                            <i class="fa-solid fa-basket-shopping"></i><span class="menu-space">Basket</span>
                        </a>
                    </div>
                    <div class="menu">
                        <a href="{{ route(name: 'login') }}" @routeactive('login')>
                            <i class="fa-solid fa-right-to-bracket"></i><span class="menu-space">Authorize</span>
                        </a>
                        <a href="{{ route(name: 'register') }}" @routeactive('register')>
                            <i class="fa-solid fa-id-card"></i><span class="menu-space">Registrate</span>
                        </a>
                    </div>
                @endguest
            </nav>
        </header>

        {{--Main Content--}}
        <main>
            <div class="content-container clearfix">
                <div class="dark-header"></div>
                @if(session()->has(key: 'success'))
                    <p class="alert">{{ session()->get(key: 'success') }}</p>
                @elseif(session()->has(key: 'warning'))
                    <p class="alert">{{ session()->get(key: 'warning') }}</p>
                @endif
                @yield('content')
            </div>
        </main>


        {{--FontAwesome icons set--}}
        <script src="https://kit.fontawesome.com/466db28e47.js" crossorigin="anonymous"></script>
        {{--Botstrap--}}
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous">
        </script>
    </body>
</html>
