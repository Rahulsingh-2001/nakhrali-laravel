@extends('backend.common.app')
@push('custum-style')
@endpush

@section('content')
    @include('backend.common.common-header', ['heading' => 'Order Managment'])

    <section>
        @include('common-msg')
        <div class="card">
            <div class="card-header m-3">
                <div class="card-title d-flex" style="width:100%">
                    <div class="title col-sm-10">
                        <h3>{{ $view_title }}</h3>
                    </div>

                    <div class="float-right col-sm-2">
                        @if ($view_type == 'LISTING')
                            <a href="{{ route('backend.order-detail.create', ['order_id' => $order_id]) }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.order-detail.index', ['order_id' => $order_id]) }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <form id="orderDetailForm"
                        action="{{ $view_type == 'ADD' ? route('backend.order-detail.store') : route('backend.order-detail.update', $item->id) }}"
                        method="POST">

                        @method($view_type == 'ADD' ? 'POST' : 'PUT')
                        @csrf
                        <input type="text" name="order_id" value="{{ $order_id }}" hidden>
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Product:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="product_id" id="product_id"
                                        class="form-control basic-select2 p-2 js-example-basic-multiple">
                                        @isset($item->product_id)
                                            <option value="{{ $item->product_id }}" selected>
                                                {{ $item->product->title }}</option>
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Variant:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="variant_id" id="variant_id"
                                        class="form-control basic-select2 p-2 js-example-basic-multiple">
                                        @isset($item->variant_id)
                                            <option value="{{ $item->variant_id }}" selected>
                                                {{ $item->variant->color->title }} - {{ $item->variant->size->size }}</option>
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Quanity:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                        @isset($item->quantity) value="{{ $item->quantity }}" @endisset>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>
                @else
                    <form action="" role="form" id="frmListing" method="POST" class="form-horizontal"
                        name="frmListing">
                        @csrf
                        @method('post')
                        {!! $dt_table->table(['class' => 'table table-bordered table-hover table-striped']) !!}
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection


@push('custum-scripts')
    @if ($view_type == 'LISTING')
        {!! $dt_table->scripts() !!}
    @endif

    @isset($validator)
        {!! $validator !!}
    @endisset

    <script>
        $("#product_id").select2({
            placeholder: 'Please select product',
            ajax: {
                url: "{{ route('backend.get.product') }}",
                data: function(params) {
                    var query = {
                        search: params.term,
                    }

                    return query;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.title,
                            }
                        }),
                    };
                }
            }
        });


        $("#variant_id").select2({
            placeholder: 'Please select a variant',
            ajax: {
                url: "{{ route('backend.product.get.variant') }}",
                data: function(params) {
                    let product_id = $("#product_id").val();
                    console.log(product_id);

                    var query = {
                        search: params.term,
                        product_id: product_id,
                    }

                    return query;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.title,
                            }
                        }),
                    };
                }
            }
        });
    </script>



@endpush
