<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <head>
        {{--Meta tagas and title--}}
        <meta charset="UTF-8">
        <meta name="description" content="Demien site>">
        <meta name="keywords" content="k>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('main.e_shop'): @yield('title')</title>

        <link href="/css/style.css" rel="stylesheet"> {{--Common CSS files--}}

        <script src="/js/jquery.min.js"></script> {{--jQuery--}}

        {{--Botstrap--}}
        <script src="/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
            rel="stylesheet" crossorigin="anonymous">
    </head>

    <body>
        {{--Main Content--}}
        <main class="d-flex flex-nowrap">
            <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 250px;">
                <a
                    href="{{ route(name: 'index') }}"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">
                        <i class="fa-solid fa-house"></i>
                        @lang('main.nav.main')
                    </span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a
                            href="{{ route(name: 'categories') }}"
                            class="nav-link @routeactive('categories')" aria-current="page">
                            <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                                <i class="fa-solid fa-bars"></i>
                                <span class="menu-space">@lang('main.nav.categories')</span>
                        </a>
                    </li>
                    @admin
                        <li>
                            <a
                                href="{{ route(name: 'categories.index') }}"
                                class="nav-link @routeactive('categories.index')">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                <i class="fa-solid fa-bars"></i>
                                <span class="menu-space">@lang('main.nav.categories') (A)</span>
                            </a>
                            <a
                                href="{{ route(name: 'products.index') }}"
                                class="nav-link @routeactive('products.index')">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2"></use>
                                </svg>
                                <i class="fa-brands fa-apple"></i>
                                <span class="menu-space">@lang('main.nav.products') (A)</span>
                            </a>
                        </li>
                    @endadmin
                    <li>
                        <a href="{{ route(name: 'basket') }}" class="nav-link @routeactive('basket*')">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#speedometer2"></use>
                            </svg>
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span class="menu-space">@lang('main.nav.basket')</span>
                        </a>
                    </li>
                    @auth
                        @admin
                        @else
                            <li>
                                <a
                                    href="{{ route(name: 'person.orders.index') }}"
                                    class="nav-link @routeactive('person.orders.index')">
                                    <svg class="bi pe-none me-2" width="16" height="16">
                                        <use xlink:href="#table"></use>
                                    </svg>
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="menu-space">@lang('main.nav.orders')</span>
                                </a>
                            </li>
                        @endadmin
                    @endauth
                    <li>
                        <a
                            href="{{ route(name: 'locale', parameters: __('main.set_lang')) }}"
                            class="nav-link text-white">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#people-circle"></use>
                            </svg>
                            <i class="fa-solid fa-language"></i>
                            <span class="menu-space">@lang('main.set_lang')</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <span
                            class="nav-link align-items-center text-white text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="#people-circle"></use>
                            </svg>
                            <i class="fa-solid fa-coins"></i>
                            {{ \App\Services\CurrencyConversion::getCurrencySymbol() }}
                        </span>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            @foreach(\App\Services\CurrencyConversion::getCurrencies() as $currency)
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route(name: 'currency', parameters: $currency->code) }}">
                                        <span class="menu-space">{{ $currency->code.' '.$currency->symbol }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <span
                        class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @auth
                            <b>Cabinet</b>
                        @else
                            <b>Log in</b>
                        @endauth
                    </span>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        @auth
                            @admin
                                <li>
                                    <a class="dropdown-item" href="{{ route(name: 'home') }}">
                                        <i class="fa-solid fa-toolbox"></i>
                                        <span class="menu-space">@lang('main.nav.admin')</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route(name: 'reset') }}">
                                        <i class="fa-solid fa-backward-step"></i>
                                        <span class="menu-space">@lang('main.nav.default')</span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route(name: 'person.orders.index') }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="menu-space">@lang('main.nav.orders')</span>
                                    </a>
                                </li>
                            @endadmin
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route(name: 'get-logout') }}">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span class="menu-space">@lang('main.nav.logout')</span>
                                </a>
                            </li>
                        @endauth

                        @guest
                            <li>
                                <a class="dropdown-item" href="{{ route(name: 'login') }}">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    <span class="menu-space">@lang('main.nav.authorize')</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route(name: 'register') }}">
                                    <i class="fa-solid fa-id-card"></i>
                                    <span class="menu-space">@lang('main.nav.register')</span>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <div class="content-container clearfix px-4 py-5 my-5 text-center rounded-3 border shadow-lg">
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
