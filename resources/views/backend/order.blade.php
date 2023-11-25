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
                            <a href="{{ route('backend.order.create') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.order.index') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <form id="orderForm"
                        action="{{ $view_type == 'ADD' ? route('backend.order.store') : route('backend.order.update', $order->id) }}"
                        method="POST">

                        @method($view_type == 'ADD' ? 'POST' : 'PUT')
                        @csrf

                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">User:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="user_id" id="user"
                                        class="form-control basic-select2 p-2 js-example-basic-multiple">
                                        @isset($order->user_id)
                                            <option value="{{ $order->user->id }}" selected>
                                                {{ $order->user->first_name }}</option>
                                        @endisset
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Amount:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="amount" id="amount"
                                        @isset($order->amount) value="{{ $order->amount }}" @endisset>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Payment Type:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="payment_type" id="payment_type" class="form-control  p-2">

                                        @foreach (config('siteglobal.payment_type') as $key => $value)
                                            <option value="{{ $key }}"
                                                @if ($view_type == 'EDIT') @selected($key == $order->payment_type) @endif>
                                                {{ $value }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Transaction Id:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="transaction_id" id="transaction_id"
                                        @isset($order->transaction_id) value="{{ $order->transaction_id }}" @endisset>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Payment Status:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="payment_status" id="payment_status" class="form-control  p-2">
                                        @foreach (config('siteglobal.payment_status') as $key => $value)
                                            <option value="{{ $key }}"
                                                @if ($view_type == 'EDIT') @selected($key == $order->payment_status) @endif>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Tracking Id:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="tracking_id" id="tracking_id"
                                        @isset($order->tracking_id) value="{{ $order->tracking_id }}" @endisset>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Tracking Status:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="tracking_status" id="tracking_status" class="form-control  p-2">
                                        @foreach (config('siteglobal.tracking_status') as $key => $value)
                                            <option value="{{ $key }}"
                                                @if ($view_type == 'EDIT') @selected($key == $order->tracking_status) @endif>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Order Status:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="status" id="status" class="form-control  p-2">
                                        @foreach (config('siteglobal.order_status') as $key => $value)
                                            <option value="{{ $key }}"
                                                @if ($view_type == 'EDIT') @selected($key == $order->status) @endif>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
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
        $("#user").select2({
            placeholder: 'Please select user',
            ajax: {
                url: "{{ route('backend.get-users') }}",
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
    </script>



@endpush
