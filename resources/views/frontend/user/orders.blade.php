@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
                @if (count($order_items))
                    <div class="axil-product-cart-wrap">
                        <div class="product-table-heading">
                            <h4 class="title">Your Orders</h4>
                        </div>
                        <div class="table-responsive">
                            <?php
                            $order_status = Config::get('siteglobal.order_status');
                            ?>

                            <table class="table axil-product-table axil-cart-table mb--40">
                                <thead>
                                    <tr>
                                        <th scope="col" class="product-thumbnail">Product</th>
                                        <th scope="col" class="product-title"></th>
                                        <th scope="col" class="product-price">Price</th>
                                        <th scope="col" class="product-quantity">Color</th>
                                        {{-- <th scope="col" class="product-quantity">Quantity</th> --}}
                                        {{-- <th scope="col" class="product-subtotal">Subtotal</th> --}}
                                        <th scope="col" class="product-subtotal">Status</th>
                                        {{-- <th scope="col" class="product-subtotal">Track</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_items as $item)
                                        <tr>
                                            <td class="product-thumbnail"><a
                                                    href="{{ route('frontend.detail', $item->product->slug) }}">
                                                    @if ($item->product->hasMedia())
                                                        <img src="{{ $item->product->getFirstMedia()->getFullURL('thumb') }}"
                                                            @if ($item->product->getFirstMedia()->hasCustomProperty('name')) alt="{{ $item->product->getFirstMedia()->custom_properties['name'] }}" @endif>
                                                    @endif
                                                </a></td>
                                            <td class="product-title"><a
                                                    href="{{ route('frontend.detail', $item->product->slug) }}">{{ $item->product->title }}</a>
                                            </td>
                                            <td class="product-price" data-title="Price"><span
                                                    class="currency-symbol">&#8377;</span>{{ $item->product->sale_price }}
                                            </td>
                                            <td class="product-quantity" data-title="Qty">
                                                <div class="pr-qty">
                                                    {{ $item->color->title }}
                                                </div>
                                            </td>
                                            {{-- <td class="product-quantity" data-title="Qty">
                                                <div class="pr-qty">
                                                    {{ $item->quantity }}
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Subtotal"><span
                                                    class="currency-symbol">&#8377;</span>{{ $item->quantity * $item->product->sale_price }}
                                            </td> --}}
                                            <td class="product-subtotal" data-title="Subtotal"><span
                                                    class="currency-symbol"></span>{{ $order_status[$item->order_status] }}
                                            </td>
                                            {{-- <td class="product-subtotal" data-title="Subtotal"><span
                                                    class="currency-symbol"></span>{{ $item->order_status }}
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @else
                    <div class="axil-product-cart-wrap d-flex flex-column justify-content-center align-items-center">
                        <div>
                            <h2>You have ordered nothing.</h2>
                        </div>
                        <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-primary checkout-btn">Buy
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Order List Area  -->

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
