<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Cart;
use App\Http\Services\PaymentService;
use App\Models\Transaction;
use Auth;
use Illuminate\Http\Request;
use Instamojo\Instamojo;
use JsValidator;

class OrderController extends Controller
{
    public function index()
    {
        // $paymentService = new PaymentService();
        $user_id = Auth::id();
        $order_item_query = Cart::where(['user_id' => $user_id])->where('order_status', '<>', 'PENDING');
        $pending_transactions = Transaction::where(['user_id' => $user_id, 'status' => 'PENDING'])->pluck('transaction_id');

        /* if (!empty($pending_transactions)) {

            foreach ($pending_transactions as $transaction_id) {

                $payment_response =  $paymentService->getPaymentInfo($transaction_id);

                if ($payment_response && filled($payment_response['status'])) {
                    $transaction_info  = Transaction::where(['user_id' => $user_id, 'transaction_id' => $transaction_id])->update(['status' => $payment_response['status']]);
                    $order_item_query->update(['order_status' => $payment_response['status']]);
                }
            }
        } */
        $order_items = $order_item_query->with(['product', 'variant', 'transaction'])->get();

        return view('frontend.user.orders', compact('order_items'));
    }

    public function checkoutProcess(CheckoutRequest $request)
    {
        $user_id = Auth::id();
        $validated_data = $request->validated();
        $cart_items = Cart::with(['product'])->where(['user_id' => $user_id, 'order_status' => 'PENDING'])->get();
        $amount = 0;

        foreach ($cart_items as $item) {
            $item_price = $item->product->sale_price;
            $total_quantity = $item->quantity;
            $amount += ($item_price * $total_quantity);
        }

        /*   if ($validated_data['payment_type'] == 'ONLINE') {

            $payment_response = (new PaymentService())->init($amount);

            if ($payment_response['status'] == 'Pending') {
                $transaction_data = [
                    'user_id' => $user_id,
                    'amount' => $amount,
                    'transaction_id' => $payment_response['id'],
                    'status' => 'PENDING'
                ];

                $transaction = Transaction::create($transaction_data);

                if ($transaction) {


                    $cart_items = Cart::where(['user_id' => $user_id, 'order_status' => 'PENDING'])->update(['order_status' => 'Ready', 'payment_type' => 'ONLINE', 'transaction_id' => $transaction->id]);
                    return redirect($payment_response['longurl']);
                }
            }
        } else { */
        $transaction_data = [
            'user_id' => $user_id,
            'amount' => $amount,
            'transaction_id' => null,
            'status' => 'PENDING',
            'payment_type' => 'COD',
            'payment_status' => 'PENDING',
            'tracking_status' => 'PENDING'
        ];

        $transaction = Transaction::create($transaction_data);

        $cart_items = Cart::with(['product'])->where(['user_id' => $user_id, 'order_status' => 'PENDING'])->update(['order_status' => 'PROCESSING', 'payment_type' => 'COD', 'transaction_id' => $transaction->id]);
        if ($cart_items) {
            return redirect(route('frontend.order.listing'));
        }
        /* } */

        return redirect(route('frontend.home'));
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::id();
        $cart_items = Cart::with(['product'])->where(['user_id' => $user_id, 'order_status' => 'PENDING'])->get();
        $amount = 0;
        foreach ($cart_items as $item) {
            $item_price = $item->product->sale_price;
            $total_quantity = $item->quantity;
            $amount += ($item_price * $total_quantity);
        }
        $validator = JsValidator::formRequest(CheckoutRequest::class, '#checkOutForm');
        return view('frontend.user.checkout', compact(['validator', 'amount']));
    }
}
