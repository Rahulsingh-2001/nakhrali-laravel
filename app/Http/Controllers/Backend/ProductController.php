<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class ProductController extends Controller
{
    public function index(Builder $builder, Request $request)
    {

        $view_type = 'LISTING';
        $view_title = 'Products';
        $request_type = $request->get('request') ?? '';

        if ($request->ajax() && $request_type = 'ajax_listing') {
            $products = Product::with(['type'])->get();
            return DataTables::of($products)
                ->addColumn('action', function ($product) {
                    $action = '<div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Action
            </button>
            <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.product.show', $product->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.product.destroy', $product->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($product) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$product->status];
                })
                ->editColumn('type_id', function ($product) {
                    return $product->type->title;
                })
                ->removeColumn('id')
                ->make(true);
        }


        $builder->ajax(route('backend.product.index', ['request' => 'ajax_listing']));
        $dt_table = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'title', 'orderable' => true],
            ['data' => 'sku', 'name' => 'sku', 'title' => 'SKU'],
            ['data' => 'type_id', 'name' => 'type_id', 'title' => 'Type'],
            ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            ['data' => 'sale_price', 'name' => 'sale_price', 'title' => 'Sale Price'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);


        return view('backend.product', compact('view_type', 'view_title', 'dt_table'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add product';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\ProductRequest', '#productForm');

        return view('backend.product', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $action_type = 'ADD';
        return $this->postProcess($request, $action_type);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request, Builder $builder)
    {
        $view_type = 'EDIT';
        $view_title = 'Edit product';
        $product = Product::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\ProductRequest', '#productForm');

        $img_builder = $builder->ajax(route('backend.product.variant', ['id' => $id, 'request' => 'img_listing']));

        $color_builder = App(Builder::class)->ajax(route('backend.product.variant', ['id' => $id, 'request' => 'color_listing']));

        $img_table = $img_builder->columns([
            ['data' => 'img', 'name' => 'img', 'title' => 'Image', 'width' => '50%'],
            ['data' => 'alt_text', 'name' => 'alt_text', 'title' => 'Name', 'width' => '40%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ])->setTableId('img_table');

        $color_table = $color_builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name', 'width' => '70%'],
            ['data' => 'code', 'name' => 'code', 'title' => 'code', 'width' => '20%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ])->setTableId('color_table');

        return view('backend.product', compact('view_type', 'view_title', 'validator', 'product', 'img_table', 'color_table'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRequest $request, $id)
    {
    }


    public function getProductVariants(Request $request, Builder $builder)
    {
        $request_type = $request->get('request');
        $id = $request->get('id');
        $product = Product::with(['color' => function ($query) {
            return $query->with('color');
        }])->findOrFail($id);

        if ($request->ajax() && $request_type == 'img_listing') {
        }

        if ($request->ajax()) {

            switch ($request_type) {
                case 'img_listing':

                    if ($product->hasMedia()) {

                        return DataTables::of($product->getMedia())
                            ->addColumn('img', function ($product) {
                                $img_box = '<img style="height:400px; width:auto;" class="" src="' . $product->getUrl('thumb') . '"></img>';
                                return $img_box;
                            })
                            ->addColumn('alt_text', function ($product) {
                                return $product->hasCustomProperty('name') ? $product->custom_properties['name'] : '-';
                            })
                            ->addColumn('action', function ($product) {
                                $action = '<button class="btn btn-primary" onClick="deleteImage(\'' . $product->id . '\')">Delete</button>';

                                return $action;
                            })
                            ->removeColumn('id')
                            ->rawColumns(['img', 'action'])
                            ->make(true);
                    } else {
                        return 1;
                    }

                case 'color_listing':
                    if ($product->color()) {

                        return DataTables::of($product->color)
                            ->editColumn('name', function ($color) {
                                return $color->color->title;
                            })
                            ->addColumn('action', function ($color) {
                                $action = '<button class="btn btn-primary" onClick="deleteColor(\'' . $color->id .  '\')">Delete</button>';
                                return $action;
                            })
                            ->addColumn('code', function ($color) {
                                $button = '<div class="btn btn-primary" style="width:100px; height:35px; background-color:' . $color->color->code . '"></div>';
                                return $button;
                            })
                            ->removeColumn('id')
                            ->rawColumns(['code', 'action'])
                            ->make(true);
                    } else {
                        return 1;
                    }
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $variant = ProductVariant::where(['product_id' => $id])->delete();
            $product->delete();
            return redirect(route('backend.product.index'))->with('success', 'Product Has been deleted');
        }
        return redirect(route('backend.product.index'))->with('error', 'Product not found');
    }

    public function destroyImage(Request $request)
    {
        $id = $request->id;
        $image = Media::findOrFail($id);
        $response['status'] = 'error';
        if ($image) {
            $image->delete();
            $response['status'] = 'success';
        }
        return $this->successResponse($response);
    }

    public function destroyColor(Request $request)
    {
        $prod_color_id = $request->prod_color_id;

        $prod_color = ProductColor::where('id', $prod_color_id)->first();
        $response['status'] = 'error';

        if ($prod_color) {
            $prod_color->delete();
            $response['status'] = 'success';
        }
        return $this->successResponse($response);
    }

    private function postProcess($request, $action_type, $id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'Product has been added successfully' : 'Product has been updated successfully';

        $product = Product::updateOrCreate(['id' => $id], $validated_data);

        if ($product) {
            return redirect(route('backend.product.show', $product->id))->with('success', $message);
        }

        return back()->with('error', 'Something Went Wrong');
    }

    public function uploadImage(Request $request)
    {
        $product_id = $request->product_id;

        $alt_text = $request->alt_text;

        $product = Product::findOrFail($product_id);
        $response['status'] = 'error';

        if ($product) {
            $image = $request->image;
            $prd_img = $product->addMedia($image)->withCustomProperties(['name' => $alt_text])->toMediaCollection();
            $response['status'] = 'success';
        }
        return $this->successResponse($response);
    }

    public function addColor(Request $request)
    {
        $product_id = $request->product_id;

        $product = Product::findOrFail($product_id);
        $response['status'] = 'error';

        if ($product) {
            $color_id = $request->color_id;
            $prod_color = ProductColor::insert(['product_id' => $product_id, 'color_id' => $color_id]);
            $response['status'] = 'success';
        }
        return $this->successResponse($response);
    }

    public function getProducts(Request $request)
    {
        $search = $request->get('search');

        $product_query = Product::query();

        if ($search) {
            $product_query->where('title', 'like', "%$search%");
        }

        $products = $product_query->paginate(10);
        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'title' => $product->title
            ];
        }

        return response()->json($data);
    }
}
