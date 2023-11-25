{{-- <a href="#top" class="back-to-top" id="backto-top"><i class="fal fa-arrow-up"></i></a> --}}
<a href="https://api.whatsapp.com/send?phone=919173286337" target="_blank" class="whatsapp show"><img
        src="{{ asset('frontend/images/whatsapp.webp') }}" alt=""></a>

<header class="header axil-header header-style-1">
    <div class="header-top-campaign">
        <div class="container position-relative">
            <div class="campaign-content">
                <p>Open Doors To A World Of Fashion <a href="#">Discover More</a></p>
            </div>
        </div>
        <button class="remove-campaign"><i class="fal fa-times"></i></button>
    </div>
    <div class="axil-header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="header-top-dropdown">

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="header-top-link">
                        <ul class="quick-link">
                            @if (!Auth::check())
                                <li><a href="#">Help</a></li>
                                <li><a href="{{ route('frontend.auth.signup') }}">Join Us</a></li>
                                <li><a href="{{ route('frontend.auth.login') }}">Sign In</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Mainmenu Area  -->
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu">
        <div class="container">
            <div class="header-navbar">
                <div class="header-brand">
                    <a href="{{ route('frontend.home') }}" class="logo logo-dark">
                        <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="Site Logo">
                    </a>
                    <a href="{{ route('frontend.home') }}" class="logo logo-light">
                        <img src="{{ asset('frontend/images/logo/logo-light.png') }}" alt="Site Logo">
                    </a>
                </div>
                <div class="header-main-nav">
                    <!-- Start Mainmanu Nav -->
                    <nav class="mainmenu-nav">
                        <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                        <div class="mobile-nav-brand">
                            <a href="#" class="logo">
                                <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="Site Logo">
                            </a>
                        </div>
                        <ul class="mainmenu">
                            {{-- <li class="menu-item-has-children">
                                <a href="#">Top Wear</a>
                                <ul class="axil-submenu">
                                    <li><a href="{{ route('frontend.listing', ['search' => 'Kurti']) }}">Kurti</a></li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 't-shirt']) }}">T-shirt</a>
                                    </li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'Anarkali']) }}">Anarkali</a>
                                    </li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'tank top']) }}">Tank
                                            Top</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Bottom Wear</a>
                                <ul class="axil-submenu">
                                    <li><a href="{{ route('frontend.listing', ['search' => 'jeans']) }}">Jeans</a></li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'lagies']) }}">Lagies</a>
                                    </li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'plazzo']) }}">Plazzo</a>
                                    </li>
                                    <li><a href="{{ route('frontend.listing', ['search' => '3/4']) }}">3 / 4</a></li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'formal']) }}">Formal</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Accessories</a>
                                <ul class="axil-submenu">
                                    <li><a href="{{ route('frontend.listing', ['search' => 'shoes']) }}">Shoes</a></li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'imitation jwellwery']) }}">Imitation
                                            Jwellwery</a></li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'nail polis']) }}">Nail
                                            Polis</a></li>
                                    <li><a href="{{ route('frontend.listing', ['search' => 'dupatta']) }}">Dupatta</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('frontend.page.about') }}">About</a></li> --}}

                            {{-- <li><a href="{{ route('frontend.page.contact') }}">Contact</a></li> --}}
                            <li><a href="javascript:void()"></a></li>
                        </ul>
                    </nav>
                    <!-- End Mainmanu Nav -->
                </div>
                <div class="header-action">
                    <ul class="action-list">
                        <li class="axil-search">
                            <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                <i class="flaticon-magnifying-glass"></i>
                            </a>
                        </li>
                        <li class="wishlist">
                            <a href="{{ route('frontend.user.wish-list') }}">
                                <i class="flaticon-heart"></i>
                            </a>
                        </li>
                        <li class="shopping-cart">
                            <a href="{{ route('frontend.user.cart') }}" class="cart-dropdown-btn">
                                {{-- <span class="cart-count">3</span> --}}
                                <i class="flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li class="my-account">
                            <a href="javascript:void(0)">
                                <i class="flaticon-person"></i>
                            </a>
                            <div class="my-account-dropdown">
                                @if (!Auth::check())
                                    <div class="login-btn">
                                        <a href="{{ route('frontend.auth.login') }}"
                                            class="axil-btn btn-bg-primary">Login</a>
                                    </div>
                                    <div class="reg-footer text-center">No account yet? <a
                                            href="{{ route('frontend.auth.signup') }}" class="btn-link">REGISTER
                                            HERE.</a></div>
                                @else
                                    <ul>
                                        <li>
                                            <a href="{{ route('frontend.user.profile') }}">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.user.wish-list') }}">Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.user.cart') }}">Cart</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.order.listing') }}">Orders</a>
                                        </li>
                                        <li>
                                            <a href="#">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="#">Support</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('frontend.user.refer-a-friend') }}">Refer and Earn</a>
                                        </li>
                                    </ul>

                                    <div class="login-btn">
                                        <a href="{{ route('frontend.auth.logout') }}"
                                            class="axil-btn btn-bg-primary">Logout</a>
                                    </div>
                                @endif
                            </div>
                        </li>
                        {{-- <li class="axil-mobile-toggle">
                            <button class="menu-btn mobile-nav-toggler">
                                <i class="flaticon-menu-2"></i>
                            </button>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
