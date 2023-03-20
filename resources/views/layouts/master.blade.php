<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <head>
        {{--Meta tagas and title--}}
        <meta charset="UTF-8">
        <meta name="description" content="Demien site>">
        <meta name="keywords" content="k>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('main.titles.e_shop'): @yield('title')</title>

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
    <header>
        <div class="px-3 py-2 text-bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="{{ route(name: 'index') }}"
                        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">
                        <i class="fa-solid fa-house"></i>
                        @lang('main.nav.main')
                    </span>
                    </a>

                    <ul class="nav nav-pills mb-auto col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                        <li><a href="{{ route(name: 'categories') }}"
                            class="nav-link @routeactive('categories')" aria-current="page">
                            <i class="fa-solid fa-bars"></i>
                            @lang('main.nav.categories')
                        </a></li>
                        @admin
                        <li><a href="{{ route(name: 'categories.index') }}"
                            class="nav-link @routeactive('categories.index')" aria-current="page">
                            <i class="fa-solid fa-bars"></i>
                            @lang('main.nav.categories') (A)
                        </a></li>
                        <li><a href="{{ route(name: 'products.index') }}"
                            class="nav-link @routeactive('products.index')" aria-current="page">
                            <i class="fa-brands fa-apple"></i>
                            @lang('main.nav.products') (A)
                        </a></li>
                        <li><a href="{{ route(name: 'properties.index') }}"
                            class="nav-link @routeactive('propert*')" aria-current="page">
                            <i class="fa-solid fa-list-check"></i>
                            @lang('main.nav.properties')
                        </a></li>
                        @endadmin
                        <li><a href="{{ route(name: 'basket') }}"
                            class="nav-link @routeactive('basket*')" aria-current="page">
                            <i class="fa-solid fa-basket-shopping"></i>
                            @lang('main.nav.basket')
                        </a></li>
                        @auth
                            @admin
                        @else
                            <li><a href="{{ route(name: 'person.orders.index') }}"
                                class="nav-link @routeactive('person.orders.index')" aria-current="page">
                                <i class="fa-solid fa-cart-shopping"></i>
                                @lang('main.nav.orders')
                            </a></li>
                            @endadmin
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
        <div class="px-3 py-2 border-bottom mb-3">
            <div class="container d-flex flex-wrap justify-content-center">
                <a href="{{ route(name: 'locale', parameters: __('main.set_lang')) }}"
                   type="button" class="btn btn-light text-dark me-2">
                    <i class="fa-solid fa-language"></i>
                    @lang('main.set_lang')
                </a>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="dropdown">
                        <span
                            class="btn btn-light text-dark me-2 align-items-center dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-coins"></i>
                            {{ $currencySymbol }}
                        </span>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            @foreach($currencies as $currency)
                                <li><a href="{{ route(name: 'currency', parameters: $currency->code) }}"
                                    class="dropdown-item">
                                    <span class="menu-space">{{ $currency->code.' '.$currency->symbol }}</span>
                                </a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <span class="me-lg-auto"></span>

                <div class="text-end">
                    @auth
                        @admin
                        <a href="{{ route(name: 'home') }}" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-toolbox"></i>
                            @lang('main.nav.admin')
                        </a>

                        <a href="{{ route(name: 'reset') }}" type="button" class="btn btn-light text-dark me-2">
                            <i class="fa-solid fa-backward-step"></i>
                            @lang('main.nav.default')
                        </a>
                    @else
                        <a href="{{ route(name: 'person.orders.index') }}" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-cart-shopping"></i>
                            @lang('main.nav.orders')
                        </a>
                        @endadmin
                        <a href="{{ route(name: 'get-logout') }}" type="button" class="btn btn-light text-dark me-2">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            @lang('main.nav.logout')
                        </a>
                    @endauth
                    @guest
                        <a href="{{ route(name: 'login') }}" type="button" class="btn btn-light text-dark me-2">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            @lang('main.nav.auth')
                        </a>
                        <a href="{{ route(name: 'register') }}" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-id-card"></i>
                            @lang('main.nav.register')
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    {{--Main Content--}}
    <main class="d-flex flex-nowrap">
        <div class="content-container clearfix px-4 py-5 my-5 text-center rounded-3 border shadow-lg">
            @if(session()->has(key: 'success'))
                <p class="alert">{{ session()->get(key: 'success') }}</p>
            @elseif(session()->has(key: 'warning'))
                <p class="alert">{{ session()->get(key: 'warning') }}</p>
            @endif
            @yield('content')
        </div>
    </main>

    <div class="text-bg-dark">
        <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 border-top">
            <div class="col mb-3">
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                </a>
                <p class="text-white">© 2022</p>
            </div>

            <div class="col mb-3"></div>

            <div class="col mb-3">
                <h5>@lang('main.nav.categories')</h5>
                <ul class="nav flex-column">
                    @foreach($categories as $category)
                        <li class="nav-item mb-2"><a href="{{ route(name: 'category', parameters: $category->code) }}"
                            class="nav-link p-0 text-white">
                            {{ $category->__('name') }}
                        </a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col mb-3">
                <h5>@lang('main.others.top_selling')!</h5>
                <ul class="nav flex-column">
                    @foreach($bestSkus as $bestSku)
                        <li class="nav-item mb-2">
                            <a class="nav-link p-0 text-white"
                                href="{{ route(
                                    name: 'sku',
                                    parameters: [
                                        $bestSku->product->category->code,
                                        $bestSku->product->code,
                                        $bestSku
                                    ]) }}">
                                {{ $bestSku->product->__('name') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </footer>
        </div>
    </div>


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
