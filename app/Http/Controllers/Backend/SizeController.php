<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SizeRequest;
use App\Models\Size;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Sizes';

        $request_type = $request->get('request');

        if ($request->ajax() && $request_type == 'ajax_listing') {
            $sizes = Size::get();
            return DataTables::of($sizes)
                ->addColumn('action', function ($size) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.size.show', $size->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.size.destroy', $size->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($size) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$size->status];
                })
                ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.size.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
            ['data' => 'size', 'name' => 'size', 'title' => 'Size'],
            ['data' => 'status', 'name' => 'status', 'title' => 'status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.master.size', compact('view_type', 'view_title', 'dt_table'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add size';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\SizeRequest', '#sizeForm');

        return view('backend.master.size', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request)
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
        $view_title = 'Edit size';
        $size = Size::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\SizeRequest', '#sizeForm');

        return view('backend.master.size', compact('view_type', 'view_title', 'validator', 'size'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SizeRequest $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SizeRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        if ($size) {
            $size->delete();
            return redirect(route('backend.size.index'))->with('success', 'Size Has been deleted');
        }
        return redirect(route('backend.size.index'))->with('error', 'Size not found');
    }

    private function postProcess($request, $action_type, $id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'Size has been added successfully' : 'Size has been updated successfully';

        $color = Size::updateOrCreate(['id' => $id], $validated_data);

        if ($color) {
            return redirect(route('backend.size.index'))->with('success', $message);
        }

        return redirect(route('backend.size.index'))->with('error', 'Something Went Wrong');
    }

    public function getSize(Request $request)
    {
        $search = $request->get('search');

        $size_query = Size::query();

        if ($search) {
            $size_query->where('title', 'like', "%$search%");
        }

        $sizes = $size_query->paginate(10);
        $data = [];

        foreach ($sizes as $size) {
            $data[] = [
                'id' => $size->id,
                'title' => $size->code
            ];
        }

        return response()->json($data);
    }
}
