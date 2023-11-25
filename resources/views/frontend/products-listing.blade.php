@foreach ($products as $product)
    <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
        <div class="axil-product product-style-one">
            <div class="thumbnail">
                <a href="{{ route('frontend.detail', $product->slug) }}">
                    @if ($product->hasMedia())
                        @foreach ($product->getMedia() as $image)
                            @if ($loop->index == 0)
                                <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="800" style="opacity:1"
                                    loading="lazy" class="main-img" src="{{ $image->getFullURL('thumb') }}"
                                    @if ($image->hasCustomProperty('name')) alt="{{ $image->custom_properties['name'] }}" @endif>
                            @endif

                            @if ($loop->index == 1)
                                <img class="hover-img" src="{{ $image->getFullURL('thumb') }}"
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
                    <li class="quickview"><a href="#" data-bs-toggle="modal"
                            data-bs-target="#quick-view-modal"><i class="far fa-eye"></i></a>
                    </li>
                    {{--  <li class="select-option">
                        <a href="single-product.html">
                            Add to Cart
                        </a>
                    </li> --}}
                    <li class="wishlist show-cursor"><a onclick="addToWishList({{ $product->id }})"><i
                                class="far fa-heart"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <div class="inner">
                <h5 class="title"><a
                        href="{{ route('frontend.detail', $product->slug) }}">{{ $product->title }}</a></h5>
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
