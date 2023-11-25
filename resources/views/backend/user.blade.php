@extends('backend.common.app')
@push('custum-style')
@endpush

@section('content')
    @include('backend.common.common-header', ['heading' => 'User Managment'])

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
                            <a href="{{ route('backend.user.create') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.user.index') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <form id="userForm"
                        action="{{ $view_type == 'ADD' ? route('backend.user.store') : route('backend.user.update', $user->id) }}"
                        method="POST">

                        @method($view_type == 'ADD' ? 'POST' : 'PUT')
                        @csrf
                        <div class="card-body">

                            <nav>
                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                    <button class="nav-link active mr-2" id="nav-detail-tab" data-toggle="tab"
                                        data-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail"
                                        aria-selected="true">Detail</button>

                                    <button class="nav-link mr-2" id="nav-add-tab" data-toggle="tab" data-target="#nav-add"
                                        type="button" role="tab" aria-controls="nav-add"
                                        aria-selected="false">Address</button>
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active mb-2" id="nav-detail" role="tabpanel"
                                    aria-labelledby="nav-detail-tab">

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">First Name:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                @isset($user->first_name) value="{{ $user->first_name }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Last Name:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="last_name" id="last_name"
                                                @isset($user->last_name) value="{{ $user->last_name }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="number">Mobile:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="mobile" id="mobile"
                                                @isset($user->mobile) value="{{ $user->mobile }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Email:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="email" id="email"
                                                @isset($user->email) value="{{ $user->email }}" @endisset>
                                        </div>
                                    </div>

                                    @if ($view_type == 'ADD')
                                        <div class="row form-group" id="changePassword">
                                            <div class="col-md-2 text-right">
                                                <label for="name">Password:</label>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" name="password" id="password">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="is_email_varified">Is email verified:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="checkbox" class="form-checkBox" name="is_email_verified"
                                                id="is_email_varified"
                                                @isset($user->is_email_verified) @checked($user->is_email_verified) @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="mobile_verified">Is mobile verified:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="checkbox" class="form-checkBox" name="is_mobile_verified"
                                                id="mobile_verified"
                                                @isset($user->is_mobile_verified) @checked($user->is_mobile_verified) @endisset>
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
                                                        @isset($user->status) @checked($user->status == $key)@endisset>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ $value }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Address line 1:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="address_1" id="address_1"
                                                @isset($user->address_1) value="{{ $user->address_1 }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Address line 2:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="address_2" id="address_2"
                                                @isset($user->address_2) value="{{ $user->address_2 }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">State:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="state_id" id="state"
                                                class="form-control basic-select2 p-2 js-example-basic-multiple">
                                                @isset($user->state_id)
                                                    <option value="{{ $user->state->id }}" selected>
                                                        {{ $user->state->name }}
                                                    </option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">City:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="city_id" id="city" disabled
                                                class="form-control basic-select2 p-2 js-example-basic-multiple">
                                                @isset($user->city_id)
                                                    <option value="{{ $user->city->id }}" selected>
                                                        {{ $user->city->name }}
                                                    </option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">City Id:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="city_id" id="city_id"
                                                @isset($user->city_id) value="{{ $user->city_id }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Pincode:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="pincode" id="pincode"
                                                @isset($user->pincode) value="{{ $user->pincode }}" @endisset>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
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
        $("document").ready(function() {
            $("#state").on('change', function() {

                if (this.length > 0) {
                    $("#city").prop("disabled", false);
                } else {
                    $("#city").prop('disabled', true);
                }

            });
        });


        $("#state").select2({
            width: '100%',
            placeholder: 'Please select the state',
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


        $("#city").select2({
            width: '100%',
            placeholder: 'Please select the city',
            ajax: {

                url: "{{ route('backend.get.city') }}",
                data: function(params) {

                    let state_id = $("#state").val();
                    var query = {
                        search: params.term,
                        state_id: state_id
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
