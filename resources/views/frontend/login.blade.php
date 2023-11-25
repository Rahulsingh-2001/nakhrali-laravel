<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nakhrali Trends || Sign In</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/logo/favicon.ico') }}">

    <!-- CSS -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/base.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">
</head>

<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <a href="{{ route('frontend.home') }}" class="site-logo"><img width="15%"
                            src="{{ asset('frontend/images/logo/logo.png') }}" alt="logo"></a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Not a member?</p>
                        <a href="{{ route('frontend.auth.signup') }}"
                            class="axil-btn btn-bg-secondary sign-up-btn">Sign Up Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9">
                    <h3 class="title">We Offer the Best Products</h3>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Sign in to Nakhtali Trends.</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        @include('frontend-common-msg')
                        <form class="singin-form" id="loginForm" method="POST"
                            action="{{ route('frontend.auth.login_process') }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"
                                    placeholder="annie@example.com">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="******">
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Sign In</button>
                                <a href="{{ route('frontend.auth.forgot_password') }}" class="forgot-btn">Forget
                                    password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/modernizr.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/js/vendor/jquery.js') }}"></script> --}}
    <script src="{{ asset('frontend/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/counterup.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script src="{{ asset('frontend/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/jsvalidation\js\jsvalidation.min.js') }}"></script>


    {{-- Jquery form validation --}}
    @isset($validator)
        {!! $validator !!}
    @endisset

</body>

</html>
