<div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="{{ route('dashboard') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/logo/logo.jpg') }}" width="100" alt="">
                </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            @foreach ($routes as $route)
                @can($route->permission_name)
                    <li
                        class="menu-item {{ request()->routeIs($route->route) ? 'active' : '' }} {{ $route->items->contains(function ($item) {return request()->routeIs($item->route);})? 'open active': '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx {{ $route->icon }}"></i>
                            <div data-i18n="Dashboards">{{ $route->name }}</div>
                        </a>
                        <ul class="menu-sub">
                            @foreach ($route->items as $item)
                                @can($item->permission_name)
                                    <li class="menu-item {{ request()->routeIs($item->route) ? 'active' : '' }}">
                                        <a href="{{ route($item->route) }}" class="menu-link">
                                            <i class="{{ $item->icon }}"></i>
                                            <div data-i18n="CRM">{{ $item->name }}</div>
                                        </a>
                                    </li>
                                @endcan
                            @endforeach
                        </ul>
                    </li>
                @endcan
            @endforeach
        </ul>
    </aside>
</div>
