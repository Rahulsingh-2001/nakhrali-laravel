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
                                <li class="axil-breadcrumb-item active" aria-current="page">Refund and Return Policy</li>
                            </ul>
                            <h1 class="title">Refund & Return</h1>
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

                            <h4 class="title">Refund and Return Policy</h4>
                            <p>At Nakhrali Trends, we strive to ensure your satisfaction with every purchase. If you are not
                                entirely satisfied with your order, we are here to help.</p>

                            <h4 class="title">Returns:</h4>
                            <ul>
                                <li>You have 3 days to return an item from the date you received it.</li>
                                <li>To be eligible for a return, your item must be unused and in the same condition that you
                                    received it.
                                </li>
                                <li>Your item must be in the original packaging.</li>
                            </ul>

                            <h4 class="title">Refunds:</h4>
                            <ul>
                                <li>Once we receive your item, we will inspect it and notify you that we have received your
                                    returned item. We will immediately notify you on the status of your refund after
                                    inspecting the item.</li>
                                <li>If your return is approved, we will initiate a refund to your original method of
                                    payment.
                                </li>
                                <li>You will receive the credit within a certain amount of days, depending on your card
                                    issuer's policies.</li>
                            </ul>

                            <h4 class="title">Exchanges:</h4>
                            <ul>
                                <li>If you need to exchange an item for a different size or color, please contact us. You
                                    will be responsible for any price difference and additional shipping costs.</li>
                            </ul>

                            <h4 class="title">Shipping:</h4>
                            <ul>
                                <li>For information regarding shipping, please refer to our<strong> <a
                                            href="{{ route('frontend.page.shipping-policy') }}">Shipping
                                            Policy</a></strong>.</li>
                            </ul>

                            <h4 class="title">Contact Us:</h4>
                            <ul>
                                <li>If you have any questions on how to return your item to us, contact our customer service
                                    team at-
                                </li>

                                <span><strong><a href="tel:(+91)9173286337"><i class="fal fa-phone-alt"></i> (+91)
                                            9173286337</a></strong></span><br />
                                <span><strong><a href="mailto:purohitvikramsingh39@gmail.com"><i
                                                class="fal fa-envelope-open"></i>
                                            purohitvikramsingh39@gmail.com</a></strong></span>
                            </ul>

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
