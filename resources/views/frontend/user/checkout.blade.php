@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        <!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <form action="{{ route('frontend.order.checkout-process') }}" id="checkOutForm" method="GET">
                    @csrf
                    @method('GET')

                    <div class="row">
                        <div class="col-lg-6">

                            <div class="axil-checkout-billing">
                                <h4 class="title mb--40">Billing details</h4>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>First Name <span>*</span></label>
                                            <input type="text" id="first-name" name="first_name" placeholder="Adam"
                                                value="{{ Auth::user()->first_name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Last Name <span>*</span></label>
                                            <input type="text" id="last-name" name="last_name" placeholder="John"
                                                value="{{ Auth::user()->last_name }}">>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Street Address <span>*</span></label>
                                    <input type="text" name="add_1" id="address1" class="mb--15"
                                        placeholder="House number and street name">
                                    <input type="text" id="address2" name="add_2"
                                        placeholder="Apartment, suite, unit, etc. (optonal)">
                                </div>
                                <div class="form-group">
                                    <label>Town/ City <span>*</span></label>
                                    <input type="text" id="town" name="city">
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" id="state" name="state">
                                </div>
                                <div class="form-group">
                                    <label>Pincode</label>
                                    <input type="text" id="pincode" name="pincode">
                                </div>
                                <div class="form-group">
                                    <label>Phone <span>*</span></label>
                                    <input type="tel" id="phone" name="phone" value="{{ Auth::user()->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label>Email Address <span>*</span></label>
                                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="form-group">
                                    <label>Other Notes (optional)</label>
                                    <textarea name="note" id="notes" rows="2"
                                        placeholder="Notes about your order, e.g. speacial notes for delivery."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="axil-order-summery order-checkout-summery">
                                <h5 class="title mb--20">Your Order</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr class="order-total">
                                                <td>Total</td>
                                                <td class="order-total-amount">&#8377; {{ $amount }} /- </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <input type="text" name="payment_type" value="COD" hidden>
                                {{-- <div class="order-payment-method">
                                    <div class="single-payment">
                                        <div class="input-group">
                                            <input type="radio" id="radio5" name="payment_type" value="COD">
                                            <label for="radio5">Cash on delivery</label>
                                        </div>
                                        <p>Pay with cash upon delivery.</p>
                                    </div>
                                    <div class="single-payment">
                                        <div class="input-group justify-content-between align-items-center">
                                            <input type="radio" id="radio6" name="payment_type" value="ONLINE" checked>
                                            <label for="radio6">UPI / Wallet/ Net Benking</label>
                                            <img src="{{ asset('frontend/images/others/payment.png') }}"
                                                alt="Paypal payment">
                                        </div>
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                            account.</p>
                                    </div>
                                </div> --}}
                                <button type="submit" class="axil-btn btn-bg-primary btn">Process to
                                    Checkout</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Checkout Area  -->

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
    @isset($validator)
        {!! $validator !!}
    @endisset

@endpush
