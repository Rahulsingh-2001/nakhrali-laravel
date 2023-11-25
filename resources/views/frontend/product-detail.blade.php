@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        <!-- Start Shop Area  -->
        <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
            <div class="single-product-thumb mb--40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 mb--40">
                            <div class="row">
                                <div class="col-lg-10 order-lg-2">
                                    <div class="single-product-thumbnail-wrap zoom-gallery">
                                        <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">
                                            @if ($product->hasMedia())
                                                @foreach ($product->getMedia() as $image)
                                                    <div class="thumbnail">
                                                        <a href="{{ $image->getFullURL() }}" class="popup-zoom">
                                                            <img src="{{ $image->getFullURL('thumb') }}"
                                                                @if ($product->getFirstMedia()->hasCustomProperty('name')) alt="{{ $product->getFirstMedia()->custom_properties['name'] }}" @endif>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="label-block">

                                            @if ($product->discount > 0)
                                                <div class="product-badget">{{ $product->discount }}% OFF</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 order-lg-1">
                                    <div class="product-small-thumb-3 small-thumb-wrapper">

                                        @if ($product->hasMedia())
                                            @foreach ($product->getMedia() as $image)
                                                <div class="small-thumb-img">
                                                    <img src="{{ $image->getFullURL('thumb') }}"
                                                        @if ($product->getFirstMedia()->hasCustomProperty('name')) alt="{{ $product->getFirstMedia()->custom_properties['name'] }}" @endif>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb--40">
                            <div class="single-product-content">
                                <div class="inner">
                                    <h2 class="product-title">{{ $product->title }}</h2>
                                    <span class="price-amount">&#8377; {{ $product->sale_price }}</span>

                                    <ul class="product-meta">
                                        <li><i class="fal fa-check"></i>In stock</li>
                                        <li><i class="fal fa-check"></i>Free delivery available</li>
                                        {{-- <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li> --}}
                                    </ul>
                                    <p class="description">{{ $product->short_desc }}</p>

                                    <div class="product-variations-wrapper">

                                        @if ($product->color())
                                            <!-- Start Product Variation  -->
                                            <div class="product-variation">
                                                <h6 class="title">Colors:</h6>
                                                <div class="color-variant-wrapper">
                                                    <ul class="color-variant">
                                                        @foreach ($product->color as $color)
                                                            <li class="color-extra" id="color_{{ $color->color->id }}"
                                                                style="border-color:{{ $color->color->code }}; border-radius:50%; padding: 5px 1px 4px 2px;"
                                                                onclick="addColor({{ $color->color->id }})">
                                                                <i class="fa-solid fa-circle fa-2xl"
                                                                    style="color:{{ $color->color->code }};">
                                                                </i>
                                                                {{-- <span><span class="color"
                                                                        style="background:{{ $color->color->code }}; border-color:{{ $color->color->code }}"></span></span> --}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- End Product Variation  -->

                                        <!-- Start Product Variation  -->
                                        <div class="product-variation d-none product-size-variation">
                                            <h6 class="title">Size:</h6>
                                            <ul class="range-variant">

                                            </ul>
                                        </div>
                                        <!-- End Product Variation  -->

                                    </div>

                                    <!-- Start Product Action Wrapper  -->
                                    <div class="product-action-wrapper d-flex-center">
                                        <!-- Start Quentity Action  -->
                                        {{-- <div class="pro-qty"><input type="text" id="product-quantity" value="1">
                                        </div> --}}
                                        <!-- End Quentity Action  -->

                                        <!-- Start Product Action  -->
                                        <ul class="product-action d-flex-center mb--0">
                                            <li class="add-to-cart"><a id="add-to-cart-btn"
                                                    onclick="addToCart({{ $product->id }})"
                                                    class="axil-btn btn-bg-primary add-to-cart-btn">Add
                                                    to Cart</a></li>
                                            <li class="wishlist"><a onclick="addToWishList({{ $product->id }})"
                                                    class="axil-btn wishlist-btn"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <!-- End Product Action  -->

                                    </div>
                                    <!-- End Product Action Wrapper  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .single-product-thumb -->

            <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
                <div class="container">
                    <ul class="nav tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab"
                                aria-controls="description" aria-selected="true">Description</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="product-desc-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 mb--30">
                                        <div class="single-desc">
                                            <h5 class="title">Specifications:</h5>
                                            <p>{{ $product->detail }}</p>
                                        </div>
                                    </div>
                                    <!-- End .col-lg-6 -->
                                    <div class="col-lg-6 mb--30">
                                        <div class="single-desc">
                                            <h5 class="title">Care & Maintenance:</h5>
                                            <p>Use warm water to describe us as a product team that creates amazing
                                                UI/UX experiences, by crafting top-notch user experience.</p>
                                        </div>
                                    </div>
                                    <!-- End .col-lg-6 -->
                                </div>
                                <!-- End .row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="pro-des-features">
                                            <li class="single-features">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/images/product/product-thumb/icon-3.png') }}"
                                                        alt="icon">
                                                </div>
                                                Easy Returns
                                            </li>
                                            <li class="single-features">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/images/product/product-thumb/icon-2.png') }}"
                                                        alt="icon">
                                                </div>
                                                Quality Service
                                            </li>
                                            <li class="single-features">
                                                <div class="icon">
                                                    <img src="{{ asset('frontend/images/product/product-thumb/icon-1.png') }}"
                                                        alt="icon">
                                                </div>
                                                Original Product
                                            </li>
                                        </ul>
                                        <!-- End .pro-des-features -->
                                    </div>
                                </div>
                                <!-- End .row -->
                            </div>
                            <!-- End .product-desc-wrapper -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- woocommerce-tabs -->

        </div>
        <!-- End Shop Area  -->

        <!-- Start Recently Viewed Product Area  -->
        <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
            <div class="container">
                <div class="section-title-wrapper">
                    {{-- <span class="title-highlighter highlighter-primary"><i class="far fa-shopping-basket"></i> Your
                    </span> --}}
                    <h2 class="title">Similler Items</h2>
                </div>
                <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">

                    {!! $similar_product_list !!}

                </div>
            </div>
        </div>
        <!-- End Recently Viewed Product Area  -->

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
    <script>
        const minimum_color = {{ $product->minimum_color }};
        let selected_colors = [];

        function addColor(color_id) {

            index = selected_colors.findIndex((color) => color == color_id);

            if (index > -1) {
                selected_colors.splice(index, 1);
            } else {
                selected_colors.push(color_id);
            }
        }


        function addToCart(product_id) {

            let quantity = 1;
            // let quantity = $("#product-quantity").val();

            if (selected_colors.length < minimum_color) {
                alert("Please select minimum " + minimum_color + ' colors');
            } else {
                $.ajax({
                    url: ADD_TO_CART,
                    method: "POST",
                    data: {
                        selected_color_id: selected_colors,
                        // selected_size_id: selected_size_id,
                        product_id: product_id,
                        // quantity: quantity,
                    },
                    success: function(res) {
                        if (res.type == "url") {
                            window.location.href = res.url;
                        } else {
                            $("#add-to-cart-btn").attr("disabled", true);
                        }
                    },
                });
            }
        }
    </script>
@endpush
