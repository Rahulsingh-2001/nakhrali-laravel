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
                                <li class="axil-breadcrumb-item active" aria-current="page">Shipping Policy</li>
                            </ul>
                            <h1 class="title">Shipping</h1>
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

        <!-- Start Privacy Policy Area  -->
        <div class="axil-privacy-area axil-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="axil-privacy-policy">

                            <h4 class="title">Shipping Policy</h4>
                            <p>Last updated: Nov 24, 2023</p>
                            <p>Thank you for shopping at Nakhrali Trends. We are committed to providing a seamless and
                                satisfying shopping experience, which includes efficient and transparent shipping services.
                                Please review the following information to understand our shipping policy.</p>

                            <h4 class="title">Order Processing Time:</h4>
                            <ul>
                                <li>Orders are typically processed within 1-3 business days after payment confirmation,
                                    excluding weekends and holidays.</li>
                                <li>During peak seasons or promotional periods, processing times may vary due to high order
                                    volumes.
                                </li>
                            </ul>

                            <h4 class="title">Shipping Methods and Timelines:</h4>
                            <ul>
                                <li>We offer various shipping methods, including standard and expedited options, depending
                                    on the destination.</li>
                                <li>Estimated delivery times vary based on the shipping method selected and the delivery
                                    location. Standard shipping usually takes 7 business days, while expedited shipping
                                    takes approximately 10 business days.
                                </li>

                            </ul>

                            <h4 class="title">Shipping Costs:</h4>
                            <ul>
                                <li>Free shipping may be available for orders above a certain value or during specific
                                    promotional periods.</li>
                            </ul>

                            <h4 class="title">Order Tracking:</h4>
                            <ul>
                                <li>Upon shipment, a tracking number and a link to track your package will be provided via
                                    email.</li>
                                <li>You can track your order directly on our website using the provided tracking
                                    information.</li>
                            </ul>

                            <h4 class="title">Order Status and Modifications:</h4>
                            <ul>
                                <li>Once an order has been placed, modifications or cancellations may be possible within a
                                    limited timeframe. Please contact our customer support team promptly for assistance.
                                </li>
                                <li>Once an order has been shipped, we are unable to modify the shipping address or redirect
                                    the package.</li>
                            </ul>

                            <h4 class="title">Delays and Exceptions:</h4>
                            <ul>
                                <li>Occasionally, shipping delays may occur due to unforeseen circumstances such as extreme
                                    weather conditions, carrier issues, or other factors beyond our control. We will strive
                                    to keep you informed in such situations.</li>

                            </ul>

                            <h4 class="title">Missing or Lost Packages:</h4>
                            <ul>
                                <li>In the rare event that a package is lost or missing during transit, please contact us
                                    immediately. We will work with the shipping carrier to initiate an investigation and
                                    find a resolution.</li>
                            </ul>


                            <h4 class="title">Returns and Refunds:</h4>
                            <ul>
                                <li>For information regarding returns and refunds, please refer to our<strong> <a
                                            href="{{ route('frontend.page.refund-return') }}">Returns & Refunds
                                            Policy</a></strong>.</li>
                            </ul>

                            <h4 class="title">Contact Us:</h4>
                            <ul>
                                <li>If you have any questions, concerns, or require further assistance regarding our
                                    shipping policy, please contact our customer support team at -
                                </li>

                                <span><strong><a href="tel:(+91)9173286337"><i class="fal fa-phone-alt"></i> (+91)
                                            9173286337</a></strong></span><br />
                                <span><strong><a href="mailto:purohitvikramsingh39@gmail.com"><i
                                                class="fal fa-envelope-open"></i>
                                            purohitvikramsingh39@gmail.com</a></strong></span>
                            </ul>
                            <p>Nakhrali Trends reserves the right to update or modify the Shipping Policy at any time
                                without prior notice. The terms outlined in the Shipping Policy are applicable to all
                                purchases made through our website.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Privacy Policy Area  -->

    </main>
@endsection
@push('custum-scripts')
@endpush
