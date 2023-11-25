<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRequest;
use App\Models\Admin;
use Config;
use Hash;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Admin Listing';
        $request_type = $request->get('request') ?? '';

        if($request->ajax() && $request_type == 'ajax_listing'){
            $admins = Admin::where('type', '!=','SUPPER')->get();
            return DataTables::of($admins)
            ->addColumn('action', function($admin){
                $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                $action .= '<a class="dropdown-item" href='. route('backend.admin.show', $admin->id) .'>Edit</a>';
                $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\''.route('backend.admin.delete', $admin->id).'\')">Delete</a>';
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

        $builder->ajax(route('backend.admin.listing', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'name', 'name'=> 'name', 'title' => 'Name', 'orderable' => true],
            ['data' => 'email', 'name'=> 'email', 'title' => 'email', 'orderable' => true],
            ['data' => 'status', 'name'=> 'status', 'title' => 'Status', 'orderable' => true],
            ['data' => 'action', 'name'=> 'action', 'title' => 'Action', 'orderable' => false, 'width' => '10%'],
        ]);

        return view('backend.admin', compact('view_type', 'view_title', 'dt_table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add Admin';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\AdminRequest', '#adminForm');
        return view('backend.admin', compact('view_type', 'view_title', 'validator'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
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
        $view_title = 'Edit Admin';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\AdminRequest', '#adminForm');

        $admin = Admin::findOrFail($id);
        return view('backend.admin', compact('view_type', 'view_title', 'validator', 'admin'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminRequest $request ,$id)
    {
        $action_type = 'EDIT';
        return $this->postProcess($request, $action_type, $id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

            $admin = Admin::findOrFail($id);
            $admin->delete();
            $message = 'Admin has been deleted';

        return redirect(route('backend.admin.listing'))->with('success' , $message);

    }

    private function postProcess($request, $action_type, $id = 0){
        $validated = $request->validated();

        $message = 'Admin has been added successfully';

        if($action_type == 'ADD' || isset($validated['isChangePassword'])){
            $validated['password'] =  Hash::make($validated['password']);
        }else{
            unset($validated['password']);
        }

        $message = $action_type == 'ADD' ? 'Admin has been added successfully' : 'Admin has been updated successfully';

        $admin = Admin::updateOrCreate(['id' => $id], $validated);

        return redirect(route('backend.admin.listing'))->with('success' , $message);
    }
}
