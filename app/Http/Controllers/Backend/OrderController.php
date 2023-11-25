<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductType;
use App\Models\Transaction;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Orders';

        $request_type = $request->get('request');

        if ($request->ajax() && $request_type == 'ajax_listing') {

            $order_items = Transaction::with(['user'])->get();

            return DataTables::of($order_items)
                ->addColumn('action', function ($item) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.order.show', $item->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href=' . route('backend.order-detail.index', ['order_id' => $item->id]) . '>View</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.order.destroy', $item->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->addColumn('user', function ($item) {
                    return $item->user->first_name . ' ' . $item->user->last_name;
                })
                ->editColumn('created_at', function ($item) {
                    return Carbon::parse($item->created_at)->format('M d , Y, h:i A');
                })
                ->editColumn('payment_type', function ($item) {
                    $status_array = Config::get('siteglobal.payment_type');

                    return $status_array[$item->payment_type];
                })
                ->editColumn('status', function ($item) {
                    $status_array = Config::get('siteglobal.order_status');
                    return $status_array[$item->status];
                })
                ->editColumn('payment_status', function ($item) {
                    $status_array = Config::get('siteglobal.payment_status');
                    return $status_array[$item->payment_status];
                })
                ->editColumn('tracking_status', function ($item) {
                    $status_array = Config::get('siteglobal.tracking_status');
                    return $status_array[$item->tracking_status];
                })
                ->addColumn('mobile', function ($item) {
                    return $item->user->mobile;
                })
                ->make(true);
        }

        $builder->ajax(route('backend.order.index', ['request' => 'ajax_listing']));

        $dt_table = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'id'],
            ['data' => 'user', 'name' => 'user', 'title' => 'User Name'],
            ['data' => 'mobile', 'name' => 'mobile', 'title' => 'Contact no'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'payment_type', 'name' => 'payment_type', 'title' => 'Type'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Order Status'],
            ['data' => 'tracking_status', 'name' => 'tracking_status', 'title' => 'Tracking Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Ordered On'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'width' => '10%'],
        ]);

        return view('backend.order', compact('view_type', 'view_title', 'dt_table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $view_type = 'ADD';
        $view_title = 'Add Order';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\OrderRequest', '#orderForm');

        return view('backend.order', compact('view_type', 'view_title', 'validator'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $validated = $request->validated();
        $action = 'add';
        $this->postProcess($validated, $action);
    }

    /**
     * Display the specified resource.
     */
    public function show($order_id)
    {
        $view_type = 'EDIT';
        $view_title = 'Edit Order';
        $order = Order::findOrFail($order_id);
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\OrderRequest', '#orderForm');

        return view('backend.order', compact('view_type', 'view_title', 'validator', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, $order_id)
    {
        $action_type = 'UPDATE';
        $validated = $request->validated();
        return $this->postProcess($validated, $action_type, $order_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if ($order) {
            $order->delete();
            return redirect(route('backend.order.index'))->with('success', 'Order has been deleted');
        }
        return redirect(route('backend.order.index'))->with('error', 'Order not found');
    }

    public function postProcess($validated, $action, $order_id = 0)
    {
        $msg = $action == 'add' ? 'Order has been created.' : 'Order has been updated';
        $order = Order::updateOrCreate(['id' => $order_id], $validated);

        if ($order) {
            return redirect(route('backend.order.show', $order->id));
        }

        return redirect(route('backend.order.index'))->with('error', 'something went wrong');
    }
}
