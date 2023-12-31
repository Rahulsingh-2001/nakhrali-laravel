@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">

                <div class="axil-product-cart-wrap d-flex flex-column justify-content-center align-items-center">
                    <div>
                        <h2 align="center"> Refer and Earn
                        </h2>
                        <p>Please Share the code to your friend and earn upto 2% of the shooped ammount of your friend.</p>
                        <br />
                    </div>

                    <input disabled type="text" class="refer-a-friend-btn" value="{{ Auth::user()->refer_code }}" />
                </div>

            </div>
        </div>
        <!-- End Cart Area  -->

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
