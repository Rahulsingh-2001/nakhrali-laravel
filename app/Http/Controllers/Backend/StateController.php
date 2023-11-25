<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateRequest;
use App\Models\Country;
use App\Models\State;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'State';

        $request_type = $request->get('request');

        if ($request->ajax() && $request_type == 'ajax_listing') {
            $states = State::where('country_id', 101);
            return DataTables::of($states)
                ->addColumn('action', function ($state) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.state.show', $state->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.state.destroy', $state->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($state) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$state->status];
                })
                ->editColumn('country_id', function ($state) {
                    return $state->country->name;
                })
                ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.state.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'country_id', 'name' => 'country_id', 'title' => 'Country'],
            ['data' => 'name', 'name' => 'name', 'title' => 'State'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.location.state', compact('view_type', 'view_title', 'dt_table'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add state';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\StateRequest', '#stateForm');

        return view('backend.location.state', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
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
        $view_title = 'Edit Country';
        $state = State::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\StateRequest', '#stateForm');

        return view('backend.location.state', compact('view_type', 'view_title', 'validator', 'state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        if ($state) {
            $state->delete();
            return redirect(route('backend.state.index'))->with('success', 'State has been deleted');
        }
        return redirect(route('backend.state.index'))->with('error', 'State not found');
    }

    private function postProcess($request, $action_type, $id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'State has been added successfully' : 'State has been updated successfully';
        $validated_data['country_id'] = 101;
        $state = State::updateOrCreate(['id' => $id], $validated_data);

        if ($state) {
            return redirect(route('backend.state.index'))->with('success', $message);
        }

        return redirect(route('backend.state.index'))->with('error', 'Something Went Wrong');
    }

    public function getState(Request $request)
    {
        $search = $request->get('search');

        $state_query = State::where('country_id', 101);

        if ($search) {
            $state_query->where('name', 'like', "%$search%");
        }

        $states = $state_query->paginate(10);
        $data = [];

        foreach ($states as $state) {
            $data[] = [
                'id' => $state->id,
                'title' => $state->name
            ];
        }

        return response()->json($data);
    }
}