@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">

        <!-- Start Cart Area  -->
        <div class="axil-product-cart-area axil-section-gap">
            <div class="container">
                @if (count($wish_list_items))
                    <div class="axil-product-cart-wrap">
                        <div class="product-table-heading">
                            <h4 class="title">My Wish list on Nakhrali Trends</h4>
                        </div>
                        <div class="table-responsive">

                            <table class="table axil-product-table axil-cart-table mb--40">
                                <thead>
                                    <tr>
                                        <th scope="col" class="product-remove"></th>
                                        <th scope="col" class="product-thumbnail">Product</th>
                                        <th scope="col" class="product-title"></th>
                                        <th scope="col" class="product-price">Unit Price</th>
                                        {{-- <th scope="col" class="product-stock-status">Stock Status</th> --}}
                                        <th scope="col" class="product-add-cart"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wish_list_items as $item)
                                        <tr>
                                            <td class="product-remove"><a
                                                    onclick="removeItemFromWishList({{ $item->id }})"
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
                                            {{-- <td class="product-stock-status" data-title="Status">In Stock </td> --}}
                                            <td class="product-add-cart"><a
                                                    href="{{ route('frontend.detail', $item->product->slug) }}"
                                                    class="axil-btn btn-outline">Add to
                                                    Cart</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                @else
                    <div class="axil-product-cart-wrap d-flex flex-column justify-content-center align-items-center">
                        <div>
                            <h2>Your wishlist is empty.</h2>
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
        function removeItemFromWishList(item_id) {
            let remove_item_url = "{{ route('frontend.user.remove-item-wishlist') }}";
            if (confirm('Do you want to remove item from wishlist')) {
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
    </script>
@endpush
