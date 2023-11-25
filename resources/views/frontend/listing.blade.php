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
                                <li class="axil-breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">Products</li>
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
        <!-- Start Shop Area  -->
        <div class="axil-shop-area axil-section-gap bg-color-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="axil-shop-top">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="category-select">

                                        <!-- Start Single Select  -->
                                        <select class="single-select" id="type" name="product_type">
                                            <option value="0">Categories</option>
                                            @foreach ($product_types as $type)
                                                <option @selected($type->title == $cat) value={{ $type->id }}>
                                                    {{ $type->title }}</option>
                                            @endforeach
                                        </select>
                                        <!-- End Single Select  -->

                                        <!-- Start Single Select  -->
                                        <select class="single-select" id="price" name="price">
                                            <option value="0">Price Range</option>
                                            <option vlaue="0-100">0 - 100</option>
                                            <option value="100-500">100 - 500</option>
                                            <option value="500-1000">500 - 1000</option>
                                            <option value="1000-1500">1000 - 1500</option>
                                        </select>
                                        <!-- End Single Select  -->

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="category-select mt_md--10 mt_sm--10 justify-content-lg-end">
                                        <!-- Start Single Select  -->
                                        <select class="single-select" id="sort" name="sort">
                                            <option value="latest">Sort by Latest</option>
                                            <option value="name">Sort by Name</option>
                                            <option value="low_price">Sort by Price Low to High</option>
                                            <option value="high_price">Sort by Price High to Low</option>
                                            <option value="featured">Sort by Viewed</option>
                                        </select>
                                        <!-- End Single Select  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row--15 mt--30" id="product-list">
                    {!! $product_list !!}
                </div>
                <div class="text-center pt--30">
                    <a href="javascript:void(0)" id="load_more" onclick="loadMore()"
                        class="axil-btn btn-bg-lighter btn-load-more">Load
                        more</a>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End Shop Area  -->

        <!-- Start Axil Newsletter Area  -->
        <div class="axil-newsletter-area axil-section-gap pt--0">
            <div class="container">
                <div class="etrade-newsletter-wrapper bg_image bg_image--5">
                    <div class="newsletter-content">
                        <span class="title-highlighter highlighter-primary2"><i
                                class="fas fa-envelope-open"></i>Newsletter</span>
                        <h2 class="title mb--40 mb_sm--30">Get weekly update</h2>
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
@endpush
