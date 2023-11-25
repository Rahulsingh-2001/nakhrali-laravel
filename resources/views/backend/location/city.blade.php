@extends('backend.common.app')
@push('custum-style')
@endpush

@section('content')
    @include('backend.common.common-header', ['heading' => 'City Managment'])

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
                            <a href="{{ route('backend.city.create') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.city.index') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <form id="cityForm"
                        action="{{ $view_type == 'ADD' ? route('backend.city.store') : route('backend.city.update', $city->id) }}"
                        method="POST">

                        @if ($view_type == 'ADD')
                            @method('POST')
                        @else
                            @method('PUT')
                        @endif
                        @csrf
                        <div class="card-body">



                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Name:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="name" id="name"
                                        @isset($city->name) value="{{ $city->name }}" @endisset>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">State:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="state_id" id="state"
                                        class="form-control basic-select2 p-2 js-example-basic-multiple">
                                        @isset($city->state)
                                            <option value="{{ $city->state->id }}" selected>
                                                {{ $city->state->name }}
                                            </option>
                                        @endisset
                                    </select>
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

                                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1"
                                                value="{{ $key }}"
                                                @isset($city->status) @checked($city->status == $key)@endisset>
                                            <label class="form-check-label" for="inlineRadio1">{{ $value }}</label>
                                        </div>
                                    @endforeach

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
        $("#state").select2({
            placeholder: 'Please select product size',
            ajax: {
                url: "{{ route('backend.get.states') }}",
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
