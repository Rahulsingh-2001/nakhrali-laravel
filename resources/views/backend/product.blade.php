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
                            <a href="{{ route('backend.product.create') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-plus"></i>&nbsp;Add</button> </a>
                        @else
                            <a href="{{ route('backend.product.index') }}">
                                <button class="btn btn-success float-right"> <i
                                        class="right fas fa-angle-left"></i>&nbsp;Listing</button></a>
                            @if ($view_type == 'EDIT')
                                <a href="{{ route('backend.variant.index', $product->id) }}">
                                    <button class="btn btn-success float-right mr-2"> <i
                                            class="right fas fa-angle-left"></i>&nbsp;Variants</button></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body">

                @if ($view_type == 'ADD' || $view_type == 'EDIT')
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active mr-2" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                            @if ($view_type == 'EDIT')
                                <button class="nav-link mr-2" id="nav-image-tab" data-toggle="tab" data-target="#nav-image"
                                    type="button" role="tab" aria-controls="nav-image"
                                    aria-selected="false">Image</button>
                                <button class="nav-link mr-2" id="nav-color-tab" data-toggle="tab" data-target="#nav-color"
                                    type="button" role="tab" aria-controls="nav-color"
                                    aria-selected="false">Color</button>
                            @endif
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">

                            <form id="productForm"
                                action="{{ $view_type == 'ADD' ? route('backend.product.store') : route('backend.product.update', $product->id) }}"
                                method="POST">

                                @csrf
                                @if ($view_type == 'ADD')
                                    @method('POST')
                                @else
                                    @method('PUT')
                                @endif

                                <div class="card-body">

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Title:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="title" id="title"
                                                @isset($product->title) value="{{ $product->title }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Product Type:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <select name="type_id" id="product-type"
                                                class="form-control basic-select2 p-2 js-example-basic-multiple">
                                                @isset($product->type)
                                                    <option value="{{ $product->type->id }}" selected>
                                                        {{ $product->type->title }}</option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">SKU:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="sku" id="sku"
                                                @isset($product->sku) value="{{ $product->sku }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Short Desc:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea name="short_desc" class="form-control" id="short_desc" cols="30" rows="5">
@isset($product->short_desc)
{{ $product->short_desc }}
@endisset
</textarea>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Detail:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <textarea name="detail" class="form-control" id="detail" cols="30" rows="10">
@isset($product->detail)
{{ $product->detail }}
@endisset
</textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Price:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" class="form-control" name="price" id="price"
                                                @isset($product->price) value="{{ $product->price }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Sale Price:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="sale_price" id="sale_price"
                                                @isset($product->sale_price) value="{{ $product->sale_price }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Discount:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="discount" id="discount"
                                                @isset($product->discount) value="{{ $product->discount }}" @endisset>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Minimum color:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="minimum_color"
                                                id="minimum_color"
                                                @isset($product->minimum_color) value="{{ $product->minimum_color }}" @endisset>
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
                                                        @isset($product->status) @checked($product->status == $key)@endisset>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ $value }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Is Featured:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <?php
                                            $is_featured = config('siteglobal.is_featured');
                                            
                                            ?>
                                            @foreach ($is_featured as $key => $value)
                                                <div class="form-check form-check-inline">

                                                    <input class="form-check-input" type="radio" name="is_featured"
                                                        id="inlineRadio1" value="{{ $key }}"
                                                        @isset($product->is_featured) @checked($product->is_featured == $key)@endisset>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ $value }}</label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-2 text-right">
                                            <label for="name">Is Top Selling:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <?php
                                            $is_top_selling = config('siteglobal.is_top_selling');
                                            
                                            ?>
                                            @foreach ($is_top_selling as $key => $value)
                                                <div class="form-check form-check-inline">

                                                    <input class="form-check-input" type="radio" name="is_top_selling"
                                                        id="inlineRadio1" value="{{ $key }}"
                                                        @isset($product->is_top_selling) @checked($product->is_top_selling == $key)@endisset>
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
                        @if ($view_type == 'EDIT')
                            {{-- Image Listing --}}
                            <div class="tab-pane fade" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                        data-target="#uploadImageModal">
                                        Upload Image
                                    </button>
                                    <form action="" role="form" id="imgListing" method="POST"
                                        class="form-horizontal" name="imgListing">
                                        @csrf
                                        @method('post')
                                        {!! $img_table->table(['class' => 'table table-bordered table-hover table-striped w-100']) !!}
                                    </form>
                                </div>
                            </div>

                            {{-- Color Listing --}}
                            <div class="tab-pane fade" id="nav-color" role="tabpanel" aria-labelledby="nav-color-tab">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                        data-target="#addColorModal">
                                        Add Color
                                    </button>
                                    <form action="" role="form" id="colorListing" method="POST"
                                        class="form-horizontal" name="colorListing">
                                        @csrf
                                        @method('post')
                                        {!! $color_table->table(['class' => 'table table-bordered table-hover table-striped w-100']) !!}
                                    </form>
                                </div>
                            </div>
                        @endif
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

    @if ($view_type == 'EDIT')
        <!-- Image Modal -->
        <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST" onsubmit="uploadimage(event,this)" id="uploadImageForm">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label for="image">Image:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label for="image">Name:</label>
                                </div>
                                <div class="col-sm-10">
                                    <input type="input" name="alt_text" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="img_submit" class="btn btn-primary">
                                <i class="fa fa-spinner fa-spin d-none" id="loader"> </i>
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Color</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST" onsubmit="addColor(event,this)" id="addColorForm">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-sm-2">
                                    <label for="image">Color:</label>
                                </div>
                                <div class="col-md-5">
                                    <select name="color_id" id="color"
                                        class="form-control basic-select2 p-2 js-example-basic-multiple">
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="color_submit" class="btn btn-primary">
                                <i class="fa fa-spinner fa-spin d-none" id="loader"> </i>
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

@endsection


@push('custum-scripts')
    @if ($view_type == 'LISTING')
        {!! $dt_table->scripts() !!}
    @endif

    @if ($view_type == 'EDIT')
        {!! $img_table->scripts() !!}
        {!! $color_table->scripts() !!}
    @endif

    @isset($validator)
        {!! $validator !!}
    @endisset

    <script>
        $("#product-type").select2({
            placeholder: 'Please select product type',
            ajax: {
                url: "{{ route('backend.get.product.type') }}",
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
                                id: item.value,
                                text: item.label,
                            }
                        }),
                    };
                }
            }
        });

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

        function uploadimage(event, formObj) {
            event.preventDefault();
            const UPLOAD_URL = "{{ route('backend.upload.product.image') }}";
            let formData = new FormData(formObj);

            $.ajax({
                url: UPLOAD_URL,
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {

                    if (response.status == 'success') {
                        $("#uploadImageModal").modal('toggle');
                        formObj.reset();
                        $('#img_table').DataTable().ajax.reload();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        function addColor(event, formObj) {
            event.preventDefault();
            const UPLOAD_URL = "{{ route('backend.add.product.color') }}";
            let formData = new FormData(formObj);

            $.ajax({
                url: UPLOAD_URL,
                type: 'POST',
                data: formData,
                async: false,
                success: function(response) {

                    if (response.status == 'success') {
                        $("#addColorModal").modal('toggle');
                        formObj.reset();
                        $('#color_table').DataTable().ajax.reload();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        function deleteImage(image_id) {
            event.preventDefault();
            if (confirm("Sure You want to delete this image")) {
                const DELETE_URL = "{{ route('backend.delete.product.image') }}";
                console.log(image_id);
                $.ajax({
                    url: DELETE_URL,
                    type: 'GET',
                    data: {
                        'id': image_id
                    },
                    success: function(response) {

                        if (response.status == 'success') {
                            $('#img_table').DataTable().ajax.reload();
                        }
                    },
                });
            }
        }

        function deleteColor(prod_color_id) {
            event.preventDefault();
            if (confirm("Sure You want to delete this color")) {
                const DELETE_URL = "{{ route('backend.delete.product.color') }}";

                $.ajax({
                    url: DELETE_URL,
                    type: 'GET',
                    data: {
                        'prod_color_id': prod_color_id,
                    },
                    success: function(response) {

                        if (response.status == 'success') {
                            $('#color_table').DataTable().ajax.reload();
                        }
                    },
                });
            }
        }
    </script>
@endpush
