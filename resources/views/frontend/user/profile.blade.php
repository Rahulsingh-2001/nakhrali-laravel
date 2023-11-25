@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="index-2.html">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">My Account</li>
                            </ul>
                            <h1 class="title">Explore All Products</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="{{ asset('frontend/images/product/product-45.png') }}" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->

        <!-- Start My Account Area  -->
        <div class="axil-dashboard-area axil-section-gap">
            <div class="container">
                <div class="axil-dashboard-warp">

                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div class="tab-content">

                                <div class="tab-pane show active" id="nav-account" role="tabpanel">
                                    <div class="col-lg-9">
                                        <div class="axil-dashboard-account">
                                            <form action="{{ route('frontend.user.update-profile') }}"
                                                class="account-details-form" id="userProfileForm" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <input type="text" class="form-control" name="first_name"
                                                                value="{{ Auth::user()->first_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Last Name</label>
                                                            <input type="text" class="form-control" name="last_name"
                                                                value="{{ Auth::user()->last_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Email id</label>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ Auth::user()->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Contact No.</label>
                                                            <input type="text" class="form-control" name="mobile"
                                                                value="{{ Auth::user()->mobile }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group  mb--0">
                                                        <button type="submit"
                                                            class="axil-btn col-lg-3 btn-bg-primary checkout-btn">Save
                                                            Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Account Area  -->

        <!-- Start Axil Newsletter Area  -->
        <div class="axil-newsletter-area axil-section-gap pt--0">
            <div class="container">
                <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                    <div class="newsletter-content">
                        <span class="title-highlighter highlighter-primary2"><i
                                class="fas fa-envelope-open"></i>Newsletter</span>
                        <h2 class="title mb--40 mb_sm--30">Get weekly update
                        </h2>
                        <div class="input-group newsletter-form">
                            <div class="position-relative newsletter-inner mb--15">
                                <input placeholder="example@gmail.com" type="text">
                            </div>
                            <button type="submit" class="axil-btn mb--15">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End Axil Newsletter Area  -->
    </main>

    <div class="service-area">
        <div class="container">
            <div class="service-area">
                <div class="container">
                    <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 row--20">
                        <div class="col">
                            <div class="service-box service-style-2">
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/icons/service1.png') }}" alt="Service">
                                </div>
                                <div class="content">
                                    <h6 class="title">Fast &amp; Secure Delivery</h6>
                                    <p>Tell about your service.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="service-box service-style-2">
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/icons/service2.png') }}" alt="Service">
                                </div>
                                <div class="content">
                                    <h6 class="title">Money Back Guarantee</h6>
                                    <p>Within 10 days.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="service-box service-style-2">
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/icons/service3.png') }}" alt="Service">
                                </div>
                                <div class="content">
                                    <h6 class="title">24 Hour Return Policy</h6>
                                    <p>No question ask.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="service-box service-style-2">
                                <div class="icon">
                                    <img src="{{ asset('frontend/images/icons/service4.png') }}" alt="Service">
                                </div>
                                <div class="content">
                                    <h6 class="title">Pro Quality Support</h6>
                                    <p>24/7 Live support.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custum-scripts')

    @isset($validator)
        {!! $validator !!}
    @endisset
@endpush
