<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ColorRequest;
use App\Http\Requests\Backend\CountryRequest;
use App\Models\Color;
use App\Models\Country;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Countries';

        $request_type = $request->get('request');

        if ($request->ajax() && $request_type == 'ajax_listing') {
            $countries = Country::get();
            return DataTables::of($countries)
                ->addColumn('action', function ($country) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.country.show', $country->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.country.destroy', $country->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($country) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$country->status];
                })
                ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.country.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Country Name'],
            ['data' => 'phonecode', 'name' => 'phonecode', 'title' => 'Phonecode'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.location.country', compact('view_type', 'view_title', 'dt_table'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add Country';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\CountryRequest', '#countryForm');

        return view('backend.location.country', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
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
        $country = Country::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\CountryRequest', '#countryForm');

        return view('backend.location.country', compact('view_type', 'view_title', 'validator', 'country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CountryRequest $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        if ($country) {
            $country->delete();
            return redirect(route('backend.country.index'))->with('success', 'Country Has been deleted');
        }
        return redirect(route('backend.color.index'))->with('error', 'Color not found');
    }

    private function postProcess($request, $action_type, $id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'Country has been added successfully' : 'Country has been updated successfully';

        $country = Country::updateOrCreate(['id' => $id], $validated_data);

        if ($country) {
            return redirect(route('backend.country.index'))->with('success', $message);
        }

        return redirect(route('backend.country.index'))->with('error', 'Something Went Wrong');
    }

    public function getCountry(Request $request)
    {
        $search = $request->get('search');

        $country_query = Country::query();

        if ($search) {
            $country_query->where('title', 'like', "%$search%");
        }

        $countries = $country_query->paginate(10);
        $data = [];

        foreach ($countries as $country) {
            $data[] = [
                'id' => $country->id,
                'title' => $country->name
            ];
        }

        return response()->json($data);
    }
}
