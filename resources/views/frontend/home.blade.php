@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        {{-- Hero Slider --}}
        <div class="axil-main-slider-area main-slider-style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-sm-6">
                        <div class="main-slider-content">
                            <div class="slider-content-activation-one">
                                {{-- Slide 1 --}}
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="400"
                                    data-sal-duration="800">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                                    <h1 class="title">Roco Wireless Headphone</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Shop Now</a>
                                        </div>
                                        <div class="item-rating">

                                        </div>
                                    </div>
                                </div>

                                {{-- Slide 2 --}}
                                <div class="single-slide slick-slide">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                                    <h1 class="title">Smart Digital Watch</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Shop Now</a>
                                        </div>
                                        <div class="item-rating">


                                        </div>
                                    </div>
                                </div>

                                {{-- Slide 3 --}}
                                <div class="single-slide slick-slide">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                                    <h1 class="title">Roco Wireless Headphone</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Shop Now</a>
                                        </div>
                                        <div class="item-rating">

                                        </div>
                                    </div>
                                </div>

                                {{-- Slide 4 --}}
                                <div class="single-slide slick-slide">
                                    <span class="subtitle"><i class="fas fa-fire"></i> Hot Deal In This Week</span>
                                    <h1 class="title">Smart Digital Watch</h1>
                                    <div class="slide-action">
                                        <div class="shop-btn">
                                            <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-white"><i
                                                    class="fal fa-shopping-cart"></i>Shop Now</a>
                                        </div>
                                        <div class="item-rating">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="main-slider-large-thumb">
                            <div class="slider-thumb-activation-one axil-slick-dots">
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
                                    data-sal-duration="1500">
                                    <img src="{{ asset('frontend/images/product/product-38.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide" data-sal="slide-up" data-sal-delay="600"
                                    data-sal-duration="1500">
                                    <img src="{{ asset('frontend/images/product/product-39.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <img src="{{ asset('frontend/images/product/product-38.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                                <div class="single-slide slick-slide">
                                    <img src="{{ asset('frontend/images/product/product-39.png') }}" alt="Product">
                                    <div class="product-price">
                                        <span class="text">From</span>
                                        <span class="price-amount">$49.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1"><img src="{{ asset('frontend/images/others/shape-1.png') }}" alt="Shape"></li>
                <li class="shape-2"><img src="{{ asset('frontend/images/others/shape-2.png') }}" alt="Shape"></li>
            </ul>
        </div>
        {{-- Here Slider End --}}

        <!-- Start Categorie Area  -->
        {{-- <div class="axil-categorie-area bg-color-white axil-section-gapcommon">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-secondary"> <i class="fa-solid fa-tag"></i> Categories</span>
                    <h2 class="title">Browse by Category</h2>
                </div>
                <div class="categrie-product-activation slick-layout-wrapper--15 axil-slick-arrow  arrow-top-slide">

                    @foreach ($product_types as $type)
                        <div class="slick-single-layout">
                            <div class="categrie-product" data-sal="zoom-out" data-sal-delay="200"
                                data-sal-duration="500">
                                <a href="{{ route('frontend.listing', ['cat' => $type->title]) }}">
                                    <img class="img-fluid"
                                        src="{{ asset('frontend/images/product/categories/elec-4.png') }}"
                                        alt="product categorie">
                                    <h6 class="cat-title">{{ $type->title }}</h6>
                                </a>
                            </div>
                            <!-- End .categrie-product -->
                        </div>
                    @endforeach

                </div>
            </div>
        </div> --}}
        <!-- End Categorie Area  -->

        <!-- Poster Countdown Area  -->
        <div class="axil-poster-countdown">
            <div class="container">
                <div class="poster-countdown-wrap bg-lighter">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6">
                            <div class="poster-countdown-content">
                                <div class="section-title-wrapper">
                                    <span class="title-highlighter highlighter-secondary"> <i
                                            class="fal fa-headphones-alt"></i> Don’t Miss!!</span>
                                    <h2 class="title">Update your wardrobe with us..</h2>
                                </div>
                                {{-- <div class="poster-countdown countdown mb--40"></div> --}}
                                <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-primary">Check it
                                    Out!</a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="poster-countdown-thumbnail">
                                <img src="{{ asset('frontend/images/product/poster/poster-03.png') }}"
                                    alt="Poster Product">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Poster Countdown Area  -->

        <!-- Start Expolre Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap">
            <div class="container">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"> <i class="fa-solid fa-cart-shopping"></i> Our
                        Products</span>
                    <h2 class="title">Explore our Products</h2>
                </div>
                <div
                    class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                    <div class="slick-single-layout">
                        <div class="row row--15">

                            @foreach ($featured_products as $product)
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12 mb--30">
                                    <div class="axil-product product-style-one">
                                        <div class="thumbnail">
                                            <a href="{{ route('frontend.detail', $product->slug) }}">
                                                @if ($product->hasMedia())
                                                    @foreach ($product->getMedia() as $image)
                                                        @if ($loop->index == 0)
                                                            <img data-sal="zoom-out" data-sal-delay="200"
                                                                data-sal-duration="800" loading="lazy" class="main-img"
                                                                src="{{ $image->getFullURL('thumb') }}"
                                                                @if ($image->hasCustomProperty('name')) alt="{{ $image->custom_properties['name'] }}" @endif>
                                                        @endif

                                                        @if ($loop->index == 1)
                                                            <img class="hover-img"
                                                                src="{{ $image->getFullURL('thumb') }}"
                                                                @if ($image->hasCustomProperty('name')) alt="{{ $image->custom_properties['name'] }}" @endif>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif

                                        </a>
                                        <div class="label-block label-right">
                                            @if ($product->discount > 0)
                                                <div class="product-badget">{{ $product->discount }}% Off</div>
                                            @endif
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="quickview"><a
                                                        href="{{ route('frontend.detail', $product->slug) }}"><i
                                                            class="far fa-eye"></i></a>
                                                </li>
                                                {{--  <li class="select-option">
                                                    <a href="{{ route('frontend.detail', $product->slug) }}">
                                                        Add to Cart
                                                    </a>
                                                </li> --}}
                                                <li class="wishlist show-cursor"><a
                                                        onclick="addToWishList({{ $product->id }})"><i
                                                            class="far fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <h5 class="title"><a
                                                    href="{{ route('frontend.detail', $product->slug) }}">{{ $product->title }}</a>
                                            </h5>
                                            <div class="product-price-variant">
                                                <span class="price current-price">&#8377;
                                                    {{ $product->sale_price }}</span>
                                                <span class="price old-price">&#8377;
                                                    {{ $product->price }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- End .slick-single-layout -->

            </div>
            <div class="row">
                <div class="col-lg-12 text-center mt--20 mt_sm--0">
                    <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-lighter btn-load-more">View All
                        Products</a>
                </div>
            </div>

        </div>
    </div>
    <!-- End Expolre Product Area  -->

    <!-- Start Testimonila Area  -->
    <div class="axil-testimoial-area axil-section-gap bg-vista-white">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-secondary"> <i
                        class="fal fa-quote-left"></i>Testimonials</span>
                <h2 class="title">Users Feedback</h2>
            </div>
            <!-- End .section-title -->
            <div
                class="testimonial-slick-activation testimonial-style-one-wrapper slick-layout-wrapper--20 axil-slick-arrow arrow-top-slide">
                <div class="slick-single-layout testimonial-style-one">
                    <div class="review-speech">
                        <p>“ Enjoy Nakhrali kurtis for their quality and style. While diverse, affordability and more
                            variety are areas to enhance. Overall, the commitment to quality and service is evident. “
                        </p>
                    </div>
                    <div class="media">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/images/testimonial/review-1.jpg') }}"
                                alt="testimonial image" width="55px">
                        </div>
                        <div class="media-body">
                            <h6 class="title">Anjali</h6>
                        </div>
                    </div>
                    <!-- End .thumbnail -->
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout testimonial-style-one">
                    <div class="review-speech">
                        <p>“ Nakhrali kurtis offer quality and style. However, enhancing affordability and variety would
                            make them even more appealing. Overall, their commitment to quality and service shines
                            through. “</p>
                    </div>
                    <div class="media">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/images/testimonial/review-2.jpg') }}"
                                alt="testimonial image" width="55px">
                        </div>
                        <div class="media-body">
                            <h6 class="title">Nishita</h6>
                        </div>
                    </div>
                    <!-- End .thumbnail -->
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout testimonial-style-one">
                    <div class="review-speech">
                        <p>“ Nakhrali's kurtis impress with their quality and style, though more budget-friendly options
                            and a wider range of designs would be appreciated. Their dedication to quality and service
                            is evident. “</p>
                    </div>
                    <div class="media">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/images/testimonial/review-3.jpg') }}"
                                alt="testimonial image" width="55px">
                        </div>
                        <div class="media-body">
                            <h6 class="title">Bhavina</h6>
                        </div>
                    </div>
                    <!-- End .thumbnail -->
                </div>
                <!-- End .slick-single-layout -->
                <div class="slick-single-layout testimonial-style-one">
                    <div class="review-speech">
                        <p>“ Nakhrali kurtis excel in quality and style, but increasing variety and affordability would
                            elevate the brand. Nevertheless, their commitment to quality and service is clear. “</p>
                    </div>
                    <div class="media">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/images/testimonial/review-4.jpg') }}"
                                alt="testimonial image" width="55px">
                        </div>
                        <div class="media-body">
                            <h6 class="title">Rakhi</h6>
                        </div>
                    </div>
                    <!-- End .thumbnail -->
                </div>
                <!-- End .slick-single-layout -->

            </div>
        </div>
    </div>
    <!-- End Testimonila Area  -->

    <!-- Start New Arrivals Product Area  -->
    <div class="axil-new-arrivals-product-area bg-color-white axil-section-gap pb--0">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper">
                    <span class="title-highlighter highlighter-primary"><i class="fa-solid fa-cart-shopping"></i>This
                        Week’s</span>
                    <h2 class="title">New Arrivals</h2>
                </div>
                <div
                    class="new-arrivals-product-activation slick-layout-wrapper--30 axil-slick-arrow  arrow-top-slide">

                    @foreach ($latest_products as $product)
                        <div class="slick-single-layout">
                            <div class="axil-product product-style-two">

                                <div class="thumbnail">
                                    @if ($product->hasMedia())
                                        <a href="{{ route('frontend.detail', $product->slug) }}">
                                            <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500"
                                                loading="lazy" class="main-img"
                                                src="{{ $product->getFirstMedia()->getFullURL('thumb') }}"
                                                @if ($product->getFirstMedia()->hasCustomProperty('name')) alt="{{ $product->getFirstMedia()->custom_properties['name'] }}" @endif>
                                        </a>
                                    @endif
                                    <div class="label-block label-right">
                                        @if ($product->discount > 0)
                                            <div class="product-badget">{{ $product->discount }}% OFF</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="product-content">
                                    <div class="inner">
                                        {{-- <div class="color-variant-wrapper">
                                        <ul class="color-variant">
                                            <li class="color-extra-01 active"><span><span
                                                        class="color"></span></span>
                                            </li>
                                            <li class="color-extra-02"><span><span class="color"></span></span>
                                            </li>
                                            <li class="color-extra-03"><span><span class="color"></span></span>
                                            </li>
                                        </ul>
                                    </div> --}}
                                        <h5 class="title"><a
                                                href="{{ route('frontend.detail', $product->slug) }}">{{ $product->title }}</a>
                                        </h5>
                                        <div class="product-price-variant">
                                            <span class="price old-price">&#8377; {{ $product->price }}</span>
                                            <span class="price current-price">&#8377;
                                                {{ $product->sale_price }}</span>
                                        </div>
                                        <div class="product-hover-action">
                                            <ul class="cart-action">
                                                <li class="quickview"><a
                                                        href="{{ route('frontend.detail', $product->slug) }}"><i
                                                            class="far fa-eye"></i></a>
                                                </li>
                                                {{-- <li class="select-option"><a href="#">Add to
                                                        Cart</a>
                                                </li> --}}
                                                <li class="wishlist show-cursor cart-btn"><a
                                                        onclick="addToWishList({{ $product->id }})"><i
                                                            class="far fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End New Arrivals Product Area  -->

    <!-- Start Most Sold Product Area  -->
    <div class="axil-most-sold-product axil-section-gap">
        <div class="container">
            <div class="product-area pb--50">
                <div class="section-title-wrapper section-title-center">
                    <span class="title-highlighter highlighter-primary"><i class="fas fa-star"></i> Most Sold</span>
                    <h2 class="title">Most Sold in Nakhrali Trends Store</h2>
                </div>
                <div class="row row-cols-xl-2 row-cols-1 row--15">
                    @foreach ($top_selling_products as $product)
                        <div class="col">
                            <div class="axil-product-list">
                                <div class="thumbnail">


                                    <a href="{{ route('frontend.detail', $product->slug) }}">
                                        <img style="width:120px" data-sal="zoom-in" data-sal-delay="100"
                                            data-sal-duration="1500"
                                            src="{{ $product->getFirstMedia()->getFullURL('thumb') }}"
                                            alt="Product Images">
                                    </a>

                                </div>
                                <div class="product-content">

                                    <h6 class="product-title"><a
                                            href="{{ route('frontend.detail', $product->slug) }}">{{ $product->title }}</a>
                                    </h6>
                                    <div class="product-price-variant">
                                        <span class="price current-price">&#8377; {{ $product->sale_price }}</span>
                                        <span class="price old-price">&#8377; {{ $product->price }}</span>
                                    </div>
                                    <div class="product-cart">
                                        <a href="{{ route('frontend.detail', $product->slug) }}" class="cart-btn"><i
                                                class="fal fa-shopping-cart"></i></a>
                                        <a onclick="addToWishList({{ $product->id }})"
                                            class=" show-cursor cart-btn"><i class="fal fa-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- End Most Sold Product Area  -->

        <!-- Start Why Choose Area  -->
        <div class="axil-why-choose-area pb--50 pb_sm--30">
            <div class="container">
                <div class="section-title-wrapper section-title-center">
                    <span class="title-highlighter highlighter-secondary"><i class="fal fa-thumbs-up"></i>Why
                        Us</span>
                    <h2 class="title">Why People Choose Us</h2>
                </div>
                <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 row--20">
                    <div class="col">
                        <div class="service-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/icons/service6.png') }}" alt="Service">
                            </div>
                            <h6 class="title">Fast &amp; Secure Delivery</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/icons/service7.png') }}" alt="Service">
                            </div>
                            <h6 class="title">100% Guarantee On Product</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/icons/service8.png') }}" alt="Service">
                            </div>
                            <h6 class="title">24 Hour Return Policy</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/icons/service9.png') }}" alt="Service">
                            </div>
                            <h6 class="title">24 Hour Return Policy</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="service-box">
                            <div class="icon">
                                <img src="{{ asset('frontend/images/icons/service10.png') }}" alt="Service">
                            </div>
                            <h6 class="title">Next Level Pro Quality</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Why Choose Area  -->


        <!-- Start Axil Product Poster Area  -->
        <div class="axil-poster">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb--30">
                        <div class="single-poster">
                            <a href="{{ route('frontend.listing') }}">
                                <img src="{{ asset('frontend/images/product/poster/poster-01.png') }}"
                                    alt="eTrade promotion poster">
                                <div class="poster-content">
                                    <div class="inner">
                                        <h3 class="title">Rich sound, <br> for less.</h3>
                                        <span class="sub-title">Collections <i
                                                class="fal fa-long-arrow-right"></i></span>
                                    </div>
                                </div>
                                <!-- End .poster-content -->
                            </a>
                        </div>
                        <!-- End .single-poster -->
                    </div>
                    <div class="col-lg-6 mb--30">
                        <div class="single-poster">
                            <a href="shop-sidebar.html">
                                <img src="{{ asset('frontend/images/product/poster/poster-02.png') }}"
                                    alt="eTrade promotion poster">
                                <div class="poster-content content-left">
                                    <div class="inner">
                                        <span class="sub-title">50% Offer In Winter</span>
                                        <h3 class="title">Get VR <br> Reality Glass</h3>
                                    </div>
                                </div>
                                <!-- End .poster-content -->
                            </a>
                        </div>
                        <!-- End .single-poster -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Axil Product Poster Area  -->

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
@endsection
@push('custum-scripts')
@endpush
