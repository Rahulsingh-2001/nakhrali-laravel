<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ColorRequest;
use App\Models\Color;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Colors';

        $request_type = $request->get('request');

        if($request->ajax() && $request_type == 'ajax_listing'){
            $colors = Color::get();
            return DataTables::of($colors)
            ->addColumn('action', function($color){
                $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                $action .= '<a class="dropdown-item" href='. route('backend.color.show', $color->id) .'>Edit</a>';
                $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\''.route('backend.color.destroy', $color->id).'\')">Delete</a>';
                $action .= '</div></div>';

                return $action;
            })
            ->editColumn('status', function($admins){
                $status_array = Config::get('siteglobal.status');
                return $status_array[$admins->status];
            })
            ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.color.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'Color'],
            ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
            ['data' => 'status', 'name' => 'status', 'title' => 'status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.master.color', compact('view_type', 'view_title', 'dt_table'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add Color';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\ColorRequest', '#colorForm');

        return view('backend.master.color', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
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
        $view_title = 'Edit Color';
        $color = Color::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\ColorRequest', '#colorForm');

        return view('backend.master.color', compact('view_type', 'view_title', 'validator', 'color'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ColorRequest $request, $id)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        if($color){
            $color->delete();
            return redirect(route('backend.color.index'))->with('success', 'Color Has been deleted');
        }
        return redirect(route('backend.color.index'))->with('error', 'Color not found');
    }

    private function postProcess($request, $action_type, $id= 0){
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'Color has been added successfully' : 'Color has been updated successfully';

        $color = Color::updateOrCreate(['id' => $id], $validated_data);

        if($color){
            return redirect(route('backend.color.index'))->with('success', $message);
        }

        return redirect(route('backend.color.index'))->with('error', 'Something Went Wrong');
    }

    public function getColor(Request $request){
        $search = $request->get('search');

        $color_query = Color::query();

        if($search){
            $color_query->where('title','like', "%$search%");
        }

        $colors = $color_query->paginate(10);
        $data = [];

        foreach($colors as $color){
            $data[] = [
                'id' => $color->id,
                'title' => $color->title
            ];
        }

        return response()->json($data);


    }
}