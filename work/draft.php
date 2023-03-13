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







