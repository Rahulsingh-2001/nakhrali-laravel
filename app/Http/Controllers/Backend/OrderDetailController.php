<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrderDetailRequest;
use App\Http\Requests\Backend\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductType;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use JsValidator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Builder $builder)
    {
        $view_type = 'LISTING';
        $view_title = 'Orders';

        $request_type = $request->get('request');
        $order_id = $request->get('order_id');

        if ($request->ajax() && $request_type == 'ajax_listing') {

            $order_items = Cart::with(['product', 'variant'])->where(['transaction_id' => $order_id])->get();

            return DataTables::of($order_items)
                ->addColumn('action', function ($item) {
                    $action = '<div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Action
                </button>
                <div class="dropdown-menu">';
                    $action .= '<a class="dropdown-item" href=' . route('backend.order-detail.show', $item->id) . '>Edit</a>';
                    $action .= '<a class="dropdown-item" href="javascript:void(0)" onClick="deleteRecord(\'' . route('backend.order.destroy', $item->id) . '\')">Delete</a>';
                    $action .= '</div></div>';

                    return $action;
                })
                ->addColumn('sku', function ($item) {
                    return $item->product->sku;
                })
                ->addColumn('title', function ($item) {
                    return $item->product->title;
                })
                ->addColumn('color', function ($item) {
                    return $item->color->title;
                })
                ->make(true);
        }

        $builder->ajax(route('backend.order-detail.index', ['request' => 'ajax_listing', 'order_id' => $order_id]));

        $dt_table = $builder->columns([
            ['data' => 'title', 'name' => 'title', 'title' => 'Name'],
            ['data' => 'sku', 'name' => 'sku', 'title' => 'Sku'],
            ['data' => 'quantity', 'name' => 'quantity', 'title' => 'Quantity'],
            ['data' => 'color', 'name' => 'color', 'title' => 'Color'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action'],
        ]);

        return view('backend.order-detail', compact('view_type', 'view_title', 'dt_table', 'order_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $order_id = $request->get('order_id');
        $view_type = 'ADD';
        $view_title = 'Add product in order';
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\OrderDetailRequest', '#orderDetailForm');

        return view('backend.order-detail', compact('view_type', 'view_title', 'validator', 'order_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderDetailRequest $request)
    {
        $validated = $request->validated();
        $action = 'add';
        $this->postProcess($validated, $action);
    }

    /**
     * Display the specified resource.
     */
    public function show($order_item_id, Request $request)
    {
        $view_type = 'EDIT';
        $view_title = 'Edit Order';
        $item = Cart::findOrFail($order_item_id);
        $order_id = $item->transaction_id;
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\OrderDetailRequest', '#orderDetailForm');

        return view('backend.order-detail', compact('view_type', 'view_title', 'validator', 'item', 'order_id'));
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
    public function update(OrderDetailRequest $request, $order_item_id)
    {
        $action_type = 'UPDATE';
        $validated = $request->validated();
        return $this->postProcess($validated, $action_type, $order_item_id);
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

    public function postProcess($validated, $action, $order_item_id = 0)
    {

        $msg = $action == 'add' ? 'Order has been created.' : 'Order has been updated';

        if ($action == 'add') {

            $order = Order::where(['id' => $validated['order_id']])->first();

            if ($order) {

                $validated['user_id'] = Auth::user()->id;
                $validated['transaction_id'] = $validated['order_id'];
                $validated['payment_type'] = 'COD';
                $validated['order_status'] = 'Completed';

                $cart = Cart::create($validated);
                return redirect(route('backend.order-detail.show',  $cart->id));
            }
        } else {
            $cart = Cart::updateOrCreate(['id' => $order_item_id], $validated);
            return redirect(route('backend.order-detail.show',  $cart->id));
        }

        return redirect(route('backend.order-detail.index', ['order_id' => $order->id]))->with('error', 'something went wrong');
    }
}
