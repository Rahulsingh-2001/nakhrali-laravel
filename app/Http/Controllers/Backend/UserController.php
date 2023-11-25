<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\Color;
use App\Models\User;
use Carbon\Carbon;
use Config;
use Hash;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Users';

        $request_type = $request->get('request');

        if ($request->ajax() && $request_type == 'ajax_listing') {
            $users = User::with(['refferedBy'])->get();

            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.user.show', $user->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.user.destroy', $user->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->editColumn('status', function ($user) {
                    $status_array = Config::get('siteglobal.status');
                    return $status_array[$user->status];
                })
                ->editColumn('name', function ($user) {
                    return $user->first_name . ' ' . $user->last_name;
                })
                ->editColumn('refered_by', function ($user) {
                    return isset($user->refferedBy) ? $user->refferedBy->mobile : '-';
                })
                ->removeColumn('id')
                ->make(true);
        }

        $builder->ajax(route('backend.user.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'mobile', 'name' => 'mobile', 'title' => 'mobile'],
            ['data' => 'email', 'name' => 'email', 'title' => 'email'],
            ['data' => 'status', 'name' => 'status', 'title' => 'status'],
            ['data' => 'refered_by', 'name' => 'refered_by', 'title' => 'Refered By'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.user', compact('view_type', 'view_title', 'dt_table'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add User';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\UserRequest', '#userForm');

        return view('backend.user', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
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
        $view_title = 'Edit User';
        $user = User::findOrFail($id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\UserRequest', '#userForm');

        return view('backend.user', compact('view_type', 'view_title', 'validator', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRequest $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $action_type = 'UPDATE';

        return $this->postProcess($request, $action_type, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return redirect(route('backend.user.index'))->with('success', 'User Has been deleted');
        }
        return redirect(route('backend.user.index'))->with('error', 'User not found');
    }

    private function postProcess($request, $action_type, $id = 0)
    {
        $validated_data = $request->validated();

        $message = $action_type == 'ADD' ? 'User has been added successfully' : 'User has been updated successfully';

        if ($action_type == 'ADD') {
            $validated_data['password'] =  Hash::make($validated_data['password']);
        } else {
            unset($validated_data['password']);
        }

        $validated_data['is_email_verified'] = (isset($validated_data['is_email_verified']) && $validated_data['is_email_verified'] == 'on') ? 1 : 0;

        $validated_data['is_mobile_verified'] = (isset($validated_data['is_mobile_verified']) && $validated_data['is_mobile_verified'] == 'on') ? 1 : 0;


        $user = User::updateOrCreate(['id' => $id], $validated_data);

        if ($user) {
            return redirect(route('backend.user.show', $user->id))->with('success', $message);
        }

        return redirect(route('backend.user.index'))->with('error', 'Something Went Wrong');
    }

    public function getUser(Request $request)
    {
        $search = $request->get('search');

        $user_query = User::query();

        if ($search) {
            $user_query->where('first_name', 'like', "%$search%");
        }

        $users = $user_query->paginate(10);
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id,
                'title' => $user->first_name . ' ' . $user->last_name
            ];
        }

        return response()->json($data);
    }
}
