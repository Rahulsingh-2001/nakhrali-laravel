<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductTypeRequest;
use App\Models\ProductType;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Product types';

        $request_type = $request->get('request');

        if($request->ajax() && $request_type == 'ajax_listing'){
            $product_types = ProductType::get();
            return DataTables::of($product_types)
            ->addColumn('action', function($product_type){
                $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                $action .= '<a class="dropdown-item" href='. route('backend.product-type.show', $product_type->id) .'>Edit</a>';
                $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\''.route('backend.product-type.destroy', $product_type->id).'\')">Delete</a>';
                $action .= '</div></div>';

                return $action;
            })
            ->editColumn('status', function($product_type){
                $status_array = Config::get('siteglobal.status');
                return $status_array[$product_type->status];
            })
            ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.product-type.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            ['data' => 'status', 'name' => 'status', 'title' => 'status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.master.product_type', compact('view_type', 'view_title', 'dt_table'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add product type';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\ProductTypeRequest', '#productTypeForm');

        return view('backend.master.product_type', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductTypeRequest $request)
    {
        $action_type = 'ADD';
        return $this->postProcess($request, $action_type);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $view_type = 'EDIT';
        $view_title = 'Edit product type';
        $type = ProductType::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\ProductTypeRequest', '#productTypeForm');

        return view('backend.master.product_type', compact('view_type', 'view_title', 'validator', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTypeRequest $request, $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductTypeRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = ProductType::findOrFail($id);
        if($type){
            $type->delete();
            return redirect(route('backend.product-type.index'))->with('success', 'Product Type Has been deleted');
        }
        return redirect(route('backend.product-type.index'))->with('error', 'Product Type not found');
    }

    private function postProcess($request, $action_type, $id= 0){
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'Product Type has been added successfully' : 'Product Type has been updated successfully';

        $type = ProductType::updateOrCreate(['id' => $id], $validated_data);

        if($type){
            return redirect(route('backend.product-type.index'))->with('success', $message);
        }

        return redirect(route('backend.product-type.index'))->with('error', 'Something Went Wrong');
    }

    public function getProductType(Request $request){

        $search_term = $request->get('search');
        $types_queury = ProductType::query();

        if($search_term){
            $types_queury = $types_queury->where('title','like', "%$search_term%");
        }
       $types =  $types_queury->paginate(10);

        $data = [];
        foreach ($types as $type){

            $data[] =[
                'label' => $type->title,
                'text' => $type->title,
                'value' => $type->id,
            ];
        }
        return response()->json($data);

    }
}