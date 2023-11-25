@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
                @if (count($cart_item))
                    <div class="axil-product-cart-wrap">
                        <div class="product-table-heading">
                            <h4 class="title">Your Cart</h4>
                            <a onclick="clearCart()" class="cart-clear show-cursor">Clear Shoping Cart</a>
                        </div>
                        <div class="table-responsive">

                            <table class="table axil-product-table axil-cart-table mb--40">
                                <thead>
                                    <tr>
                                        <th scope="col" class="product-remove"></th>
                                        <th scope="col" class="product-thumbnail">Product</th>
                                        <th scope="col" class="product-title"></th>
                                        <th scope="col" class="product-price">Price</th>
                                        <th scope="col" class="product-price">Color</th>
                                        {{-- <th scope="col" class="product-quantity">Quantity</th> --}}
                                        {{-- <th scope="col" class="product-subtotal">Subtotal</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart_item as $item)
                                        <tr>
                                            <td class="product-remove"><a onclick="removeItemFromCart({{ $item->id }})"
                                                    class="remove-wishlist show-cursor"><i class="fal fa-times"></i></a>
                                            </td>
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
                                            {{-- <td class="product-quantity" data-title="Qty">
                                                <div class="pr-qty">
                                                    {{ $item->quantity }}
                                                </div>
                                            </td> --}}
                                            {{-- <td class="product-subtotal" data-title="Subtotal"><span
                                                    class="currency-symbol">&#8377;</span>{{ $item->quantity * $item->product->sale_price }}
                                            </td> --}}
                                            <td class="product-subtotal" data-title="color">{{ $item->color->title }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="cart-update-btn-area">
                            <div class="input-group product-cupon">
                                <input placeholder="Enter coupon code" type="text">
                                <div class="product-cupon-btn">
                                    <button type="submit" class="axil-btn btn-outline">Apply</button>
                                </div>
                            </div>
                            <div class="update-btn">
                                <a href="{{ route('frontend.order.checkout') }}" class="axil-btn btn-outline">Process to
                                    Checkout</a>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="axil-product-cart-wrap d-flex flex-column justify-content-center align-items-center">
                        <div>
                            <h2>Your cart is empty.</h2>
                        </div>
                        <a href="{{ route('frontend.listing') }}" class="axil-btn btn-bg-primary checkout-btn">Add
                            Product</a>
                    </div>
                @endif
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
    <script>
        function removeItemFromCart(item_id) {
            let remove_item_url = "{{ route('frontend.user.remove-item') }}";
            if (confirm('Do you want to remove item from cart')) {
                $.ajax({
                    url: remove_item_url,
                    method: 'delete',
                    data: {
                        item_id
                    },
                    success: function(res) {
                        location.reload();
                    }
                });
            }
        }

        function clearCart() {
            let clear_cart = "{{ route('frontend.user.clear-cart') }}";
            if (confirm('Do you want to clear cart')) {
                $.ajax({
                    url: clear_cart,
                    method: 'delete',
                    success: function(res) {
                        location.reload();
                    }
                });
            }
        }
    </script>
@endpush
