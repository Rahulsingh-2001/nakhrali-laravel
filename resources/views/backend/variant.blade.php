@extends('backend.common.app')
@push('custum-style')
@endpush

@section('content')
    @include('backend.common.common-header', ['heading' => 'Product Managment'])

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
                            <a href="{{ route('backend.variant.create', $product_id) }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button>
                            </a>
                        @else
                            <a href="{{ route('backend.variant.index', $product_id) }}">
                                <button class="btn btn-success float-right mr-2"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif

                        <a href="{{ route('backend.product.show', $product_id) }}">
                            <button class="btn btn-success float-right mr-2"> <i
                                    class="right fas fa-angle-left"></i>&nbsp;Product</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">

                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">

                            <form id="variantForm"
                                action="{{ $view_type == 'ADD' ? route('backend.variant.store', $product_id) : route('backend.variant.update', ['product_id' => $product_id, 'variant_id' => $variant->id]) }}"
                                method="POST">

                                @csrf
                                @method('POST')

                                <div class="card-body">
                                    <input type="hidden" class="form-control" name="product_id" id="product_id"
                                        value="{{ $product_id }}">

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Size:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="size_id" id="size"
                                                class="form-control basic-select2 p-2 js-example-basic-multiple">
                                                @isset($variant->size)
                                                    <option value="{{ $variant->size->id }}" selected>
                                                        {{ $variant->size->code }}
                                                    </option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Color:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="color_id" id="color"
                                                class="form-control basic-select2 p-2 js-example-basic-multiple">
                                                @isset($variant->color)
                                                    <option value="{{ $variant->color->id }}" selected>
                                                        {{ $variant->color->title }}
                                                    </option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Total Pc:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" class="form-control" name="total_pc" id="total_pc"
                                                @isset($variant->total_pc)
                                    value="{{ $variant->total_pc }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Available Pc:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" class="form-control" name="available_pc" id="available_pc"
                                                @isset($variant->available_pc) value="{{ $variant->available_pc }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Status:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <?php
                                            $status = config('siteglobal.status');
                                            
                                            ?>
                                            @foreach ($status as $key => $value)
                                                <div class="form-check form-check-inline">

                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inlineRadio1" value="{{ $key }}"
                                                        @isset($variant->status) @checked($variant->status ==
                                        $key)@endisset>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ $value }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        $("#color").select2({
            placeholder: 'Please select product color',
            ajax: {
                url: "{{ route('backend.get.color') }}",
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
                                text: item.title,
                                id: item.id
                            }
                        }),
                    };
                }
            }
        });

        $("#size").select2({
            placeholder: 'Please select product size',
            ajax: {
                url: "{{ route('backend.get.size') }}",
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
                                text: item.title,
                                id: item.id
                            }
                        }),
                    };
                }
            }
        });
    </script>
@endpush
