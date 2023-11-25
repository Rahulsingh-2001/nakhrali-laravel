@extends('backend.common.app')
@push('custum-style')
@endpush

@section('content')
    @include('backend.common.common-header', ['heading' => 'State Managment'])

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
                            <a href="{{ route('backend.state.create') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.state.index') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <form id="stateForm"
                        action="{{ $view_type == 'ADD' ? route('backend.state.store') : route('backend.state.update', $state->id) }}"
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
                                        @isset($state->name) value="{{ $state->name }}" @endisset>
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
                                                @isset($state->status) @checked($state->status == $key)@endisset>
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

@endpush
