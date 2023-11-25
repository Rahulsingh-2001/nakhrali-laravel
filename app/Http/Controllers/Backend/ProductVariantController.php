<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\VariantRequest;
use App\Models\ProductVariant;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id, Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Variant';

        $request_type = $request->get('request');


        if ($request->ajax() && $request_type == 'ajax_listing') {
            $variants = ProductVariant::where(['product_id' => $product_id])->get();
            return DataTables::of($variants)
                ->addColumn('action', function ($variant) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.variant.edit', ['variant_id' => $variant->id, 'product_id' => $variant->product_id]) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.variant.destroy', ['variant_id' => $variant->id, 'product_id' => $variant->product_id]) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($variant) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$variant->status];
                })
                ->editColumn('size_id', function ($variant) {
                    return $variant->size->code;
                })
                ->editColumn('color_id', function ($variant) {
                    return $variant->color->title;
                })
                ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.variant.index', [$product_id, 'request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'color_id', 'name' => 'color_id', 'title' => 'Color'],
            ['data' => 'size_id', 'name' => 'size_id', 'title' => 'Size'],
            ['data' => 'total_pc', 'name' => 'total_pc', 'title' => 'Toatal PC'],
            ['data' => 'available_pc', 'name' => 'available_pc', 'title' => 'Available PC'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.variant', compact('view_type', 'view_title', 'dt_table', 'product_id'));
        //
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($product_id)
    {
        $view_type = 'ADD';
        $view_title = 'Add variant';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\VariantRequest', '#variantForm');

        return view('backend.variant', compact('view_type', 'view_title', 'validator', 'product_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($product_id, VariantRequest $request)
    {
        $action_type = 'ADD';
        return $this->postProcess($request, $action_type);
    }

    /**
     * Display the specified resource.
     */
    public function edit($product_id,  $variant_id)
    {
        $view_type = 'EDIT';
        $view_title = 'Edit variant';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\VariantRequest', '#variantForm');

        $variant = ProductVariant::where(['product_id' => $product_id, 'id' => $variant_id])->first();

        return view('backend.variant', compact('view_type', 'view_title', 'validator', 'product_id', 'variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($product_id, $variant_id, VariantRequest $request)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $variant_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id, $variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        if ($variant) {
            $variant->delete();
            return redirect(route('backend.variant.index', $product_id))->with('success', 'Variant Has been deleted');
        }
        return redirect(route('backend.product.index', $product_id))->with('error', 'Variant not found');
    }

    private function postProcess($request, $action_type, $variant_id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'Variant has been added successfully' : 'Variant has been updated successfully';

        $variant = ProductVariant::updateOrCreate(['id' => $variant_id], $validated_data);

        if ($variant) {
            return redirect(route('backend.variant.edit', ['variant_id' => $variant->id, 'product_id' => $variant->product_id]))->with('success', $message);
        }

        return back()->with('error', 'Something Went Wrong');
    }

    public function getVariants(Request $request)
    {
        $search = $request->get('search');
        $product_id = $request->get('product_id');

        $variant_query = ProductVariant::query();
        $variant_query->with(['color', 'size'])->where('product_id', $product_id);

        /*  if ($search) {
            $color_query->where('title', 'like', "%$search%");
        } */

        $variants = $variant_query->get();
        $data = [];

        foreach ($variants as $variant) {
            $data[] = [
                'id' => $variant->id,
                'title' => $variant->color->title . ' - ' . $variant->size->size
            ];
        }

        return response()->json($data);
    }

    public function getSizes(Request $request)
    {
        $search = $request->get('search');
        $product_id = $request->get('product_id');

        $color_query = ProductVariant::query();
        $color_query->with(['color'])->where('product_id', $product_id);

        if ($search) {
            $color_query->where('title', 'like', "%$search%");
        }

        $colors = $color_query->paginate(10);
        $data = [];

        foreach ($colors as $color) {
            $data[] = [
                'id' => $color->color->id,
                'title' => $color->color->title
            ];
        }

        return response()->json($data);
    }
}
