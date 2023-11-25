@extends('backend.common.app')
@push('custum-style')
@endpush

@section('content')
    @include('backend.common.common-header', ['heading' => 'Admin Managment'])

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
                            <a href="{{ route('backend.admin.add') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.admin.listing') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <form id="adminForm"
                        action="{{ $view_type == 'ADD' ? route('backend.admin.store') : route('backend.admin.edit', $admin->id) }}"
                        method="POST">
                        @method('POST')
                        @csrf
                        <div class="card-body">

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Name:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="name" id="name"
                                        @isset($admin->name) value="{{ $admin->name }}" @endisset>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-2 text-right">
                                    <label for="name">Email:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="email" id="email"
                                        @isset($admin->email) value="{{ $admin->email }}" @endisset>
                                </div>
                            </div>

                            @if ($view_type == 'EDIT')
                                <div class="row form-group">
                                    <div class="col-md-2 text-right">
                                        <label for="name">Change Password:</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="checkbox" class="form-checkBox" name="isChangePassword"
                                            id="isChangePassword">
                                    </div>
                                </div>
                            @endif

                            <div class="row form-group" id="changePassword">
                                <div class="col-md-2 text-right">
                                    <label for="name">Password:</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="password" id="password">
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
                                                @isset($admin->name) @checked($admin->status == $key)@endisset>
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
                    <form action="" role="form" id="frmListing" method="POST" class="form-horizontal" name="frmListing">
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
        const VIEW_TYPE = '{{ $view_type }}';

        $(document).ready(function() {
            if (VIEW_TYPE == 'EDIT') {
                $("#changePassword").hide();
            }

            $("#isChangePassword").on("click", function() {
                if (this.checked) {
                    $("#changePassword").show();
                } else {
                    $("#changePassword").hide();
                }
            });


        });


    </script>
@endpush
