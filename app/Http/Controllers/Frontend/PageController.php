<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use JsValidator;

class PageController extends Controller
{
    public function contact()
    {
        $validator = JsValidator::formRequest('App\Http\Requests\Frontend\ContactEnquiryRequest', '#contactForm');
        return view('frontend.page.contact', compact('validator'));
    }

    public function saveEnquiry(ContactEnquiryRequest $request)
    {
        $response = [
            'code' => false,
            'err' => 'Something went wrong'
        ];

        $validated_data = $request->validated();

        $enquiry = Enquiry::insert($validated_data);

        if ($enquiry) {
            $response = [
                'code' => true,
                'success' => 'Enquiry submitted'
            ];
        }

        return $this->successResponse($response);
    }

    public function about()
    {
        return view('frontend.page.about');
    }
    public function termService()
    {
        return view('frontend.page.term-service');
    }
    public function privacy()
    {
        return view('frontend.page.privacy');
    }
    public function refundReturn()
    {
        return view('frontend.page.refund-return');
    }
    public function shippingPolicy()
    {
        return view('frontend.page.shipping-policy');
    }
}