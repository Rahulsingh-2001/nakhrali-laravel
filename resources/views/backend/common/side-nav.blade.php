<?php
$tabs = [
    ['title' => 'Dashboard', 'route' => 'backend.home', 'prefix' => 'dashboard', 'has_child' => false, 'icon' => 'home'],
    ['title' => 'Admins', 'prefix' => 'admin', 'route' => 'backend.admin.listing', 'has_child' => false, 'icon' => 'user'],
    ['title' => 'Users', 'prefix' => 'user', 'route' => 'backend.user.index', 'has_child' => false, 'icon' => 'user'],
    ['title' => 'Orders', 'prefix' => 'order', 'route' => 'backend.order.index', 'has_child' => false, 'icon' => 'cart-arrow-down'],
    ['title' => 'Products', 'prefix' => 'product', 'route' => 'backend.product.index', 'has_child' => false, 'icon' => 'tshirt'],
    ['title' => 'Master', 'prefix' => 'master', 'has_child' => true, 'icon' => 'database', 'child' => [['title' => 'Product Type', 'prefix' => 'product-type', 'route' => 'backend.product-type.index'], ['title' => 'Color', 'prefix' => 'color', 'route' => 'backend.color.index'], ['title' => 'Size', 'prefix' => 'size', 'route' => 'backend.size.index']]],
    ['title' => 'Location', 'prefix' => 'location', 'has_child' => true, 'icon' => 'map', 'child' => [['title' => 'Country', 'prefix' => 'country', 'route' => 'backend.country.index'], ['title' => 'State', 'prefix' => 'state', 'route' => 'backend.state.index'], ['title' => 'City', 'prefix' => 'city', 'route' => 'backend.city.index']]],
];
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Nakhrali - Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                {{-- @dd(Request::segment(2)) --}}
                @foreach ($tabs as $tab)
                    @if (!$tab['has_child'])
                        <li class="nav-item">
                            <a href="{{ route($tab['route']) }}"
                                class="nav-link @if (Request::segment(2) == $tab['prefix']) active @endif">
                                <i class="fas fa-{{ $tab['icon'] }}"></i>
                                <p>
                                    &nbsp; {{ $tab['title'] }}
                                </p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item  @if (Request::segment(2) == $tab['prefix']) menu-open @endif">
                            <a href="#" class="nav-link @if (Request::segment(2) == $tab['prefix']) active @endif">
                                <i class="fas fa-{{ $tab['icon'] }}"></i>
                                <p>
                                    &nbsp; {{ $tab['title'] }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($tab['child'] as $child)
                                    <li class="nav-item ">
                                        <a href="{{ route($child['route']) }}"
                                            class="nav-link @if (Request::segment(3) == $child['prefix']) active @endif">
                                            <i class="left fas fa-angle-right"></i>
                                            <p>
                                                {{ $child['title'] }}
                                            </p>
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        </li>
                    @endif
                @endforeach

            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
