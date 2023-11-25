<?php

namespace App\Http\Services;

use Auth;
use Instamojo\Instamojo;

class PaymentService
{
    public $api;
    public function __construct()
    {
        $this->api = Instamojo::init('user', [
            "client_id" =>  'test_sGueRpNijuTIVfGJuFAZz88QqgHiAyHF9d1',
            "client_secret" => 'test_O9YiTYRutfb6FZoOc31LeOeghsaVs2x2ZvGWhsDM3BDW3ZY5DUCEXpLlfzE4Z74LhHZMi5EMb7IN7ePp9Pz8GXMdBYHVsBH0qcQjhBx5UzSKTei4WHflnID1EBm',
            "username" => 'r_r_singh_boya',
            "password" => 'Rahul#2308'
        ], true);
    }

    public function init($amount)
    {
        $user = Auth::user();

        $requestData = [
            "purpose" => "Cloth Shopping",
            "amount" => $amount,
            "send_email" => true,
            "email" => $user->email,
            "name" => $user->first_name . ' ' . $user->last_name,
            "phone" => $user->mobile,
            "redirect_url" => route('frontend.order.listing')
        ];

        $response = $this->api->createPaymentRequest($requestData);

        return $response;
    }

    public function getPaymentInfo($transaction_id)
    {
        try {
            $response = $this->api->getPaymentRequestDetails($transaction_id);
            return $response;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }
}
