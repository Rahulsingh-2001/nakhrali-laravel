<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CityRequest;
use App\Http\Requests\Backend\StateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'City';

        $request_type = $request->get('request');

        if ($request->ajax() && $request_type == 'ajax_listing') {
            $cities = City::where('status', 1);
            return DataTables::of($cities)
                ->addColumn('action', function ($city) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.city.show', $city->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.city.destroy', $city->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($city) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$city->status];
                })
                ->editColumn('state_id', function ($city) {
                    return $city->state->name;
                })
                ->filterColumn('state_id', function ($state, $keyword) {
                    $state->whereHas('state', function ($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword");
                    });
                })
                ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.city.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'City'],
            ['data' => 'state_id', 'name' => 'state_id', 'title' => 'State'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.location.city', compact('view_type', 'view_title', 'dt_table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add city';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\CityRequest', '#cityForm');

        return view('backend.location.city', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
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
        $view_title = 'Edit City';
        $city = city::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\CityRequest', '#cityForm');

        return view('backend.location.city', compact('view_type', 'view_title', 'validator', 'city'));
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
    public function update(CityRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        if ($city) {
            $city->delete();
            return redirect(route('backend.city.index'))->with('success', 'City has been deleted');
        }
        return redirect(route('backend.city.index'))->with('error', 'City not found');
    }

    private function postProcess($request, $action_type, $id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'City has been added successfully' : 'City has been updated successfully';

        $city = City::updateOrCreate(['id' => $id], $validated_data);

        if ($city) {
            return redirect(route('backend.city.index'))->with('success', $message);
        }

        return redirect(route('backend.city.index'))->with('error', 'Something Went Wrong');
    }

    public function getCity(Request $request)
    {
        $search = $request->get('search');
        $state_id = $request->get('state_id');

        $city_query = City::where('state_id', $state_id);

        if ($search) {
            $city_query->where('name', 'like', "%$search%");
        }

        $cities = $city_query->paginate(10);
        $data = [];

        foreach ($cities as $city) {
            $data[] = [
                'id' => $city->id,
                'title' => $city->name
            ];
        }

        return response()->json($data);
    }
}
