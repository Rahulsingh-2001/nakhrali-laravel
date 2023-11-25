@extends('frontend.common.app')
@push('custum-style')
@endpush

@section('content')
    <main class="main-wrapper">
        <!-- Start Breadcrumb Area  -->
        <div class="axil-breadcrumb-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="inner">
                            <ul class="axil-breadcrumb">
                                <li class="axil-breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="separator"></li>
                                <li class="axil-breadcrumb-item active" aria-current="page">Term of Use</li>
                            </ul>
                            <h1 class="title">Terms Of Use</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="inner">
                            <div class="bradcrumb-thumb">
                                <img src="{{ asset('frontend/images/product/product-45.png') }}" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb Area  -->

        <!-- Start Privacy Policy Area  -->
        <div class="axil-privacy-area axil-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="axil-privacy-policy">

                            <h4 class="title">About Nakhrali</h4>
                            <p>We are committed to ensuring that your privacy is protected. Should we ask you to provide
                                certain information by which you can be identified when using this website, and then you can
                                be assured that it will only be used in accordance with this privacy statement.

                                We may change this policy from time to time by updating this page. You should check this
                                page from time to time to ensure that you are happy with any changes.</p>
                            <h4 class="title">We may collect the following information:</h4>
                            <ul>
                                <li>Name and job title</li>
                                <li>Contact information including email address</li>
                                <li>Demographic information such as postcode, preferences and interests.</li>
                                <li>Other information relevant to customer surveys and/or offers</li>
                            </ul>
                            <h4 class="title">What we do with the information we gather</h4>
                            <p>We require this information to understand your needs and provide you with a better service,
                                and in particular for the following reasons:</p>
                            <ul>
                                <li>Internal record keeping.</li>
                                <li>We may use the information to improve our products and services.</li>
                                <li>We may periodically send promotional emails about new products, special offers or other
                                    information which we think you may find interesting using the email address which you
                                    have provided.</li>
                                <li>From time to time, we may also use your information to contact you for market research
                                    purposes. We may contact you by email, phone, fax or mail. We may use the information to
                                    customise the website according to your interests.</li>
                            </ul>
                            <p>We are committed to ensuring that your information is secure. In order to prevent
                                unauthorised
                                access or disclosure we have put in suitable measures.</p>
                            <h4 class="title">How we use cookies</h4>
                            <p>A cookie is a small file which asks permission to be placed on your computer’s hard drive.
                                Once you agree, the file is added and the cookie helps analyses web traffic or lets you know
                                when you visit a particular site. Cookies allow web applications to respond to you as an
                                individual. The web application can tailor its operations to your needs, likes and dislikes
                                by gathering and remembering information about your preferences.</p>
                            <p>We use traffic log cookies to identify which pages are being used. This helps us analyses
                                data about webpage traffic and improve our website in order to tailor it to customer needs.
                                We only use this information for statistical analysis purposes and then the data is removed
                                from the system.</p>
                            <p>Overall, cookies help us provide you with a better website, by enabling us to monitor which
                                pages you find useful and which you do not. A cookie in no way gives us access to your
                                computer or any information about you, other than the data you choose to share with us.</p>
                            <p>You can choose to accept or decline cookies. Most web browsers automatically accept cookies,
                                but you can usually modify your browser setting to decline cookies if you prefer. This may
                                prevent you from taking full advantage of the website.</p>
                            <h4 class="title">Controlling your personal information</h4>
                            <p>You may choose to restrict the collection or use of your personal information in the
                                following ways:</p>
                            <ul>
                                <li>whenever you are asked to fill in a form on the website, look for the box that you can
                                    click to indicate that you do not want the information to be used by anybody for direct
                                    marketing purposes</li>
                                <li>if you have previously agreed to us using your personal information for direct marketing
                                    purposes, you may change your mind at any time by writing to or emailing us at
                                    r.r.singh.boya@gmail.com</li>

                            </ul>
                            <p>We will not sell, distribute or lease your personal information to third parties unless we
                                have your permission or are required by law to do so. We may use your personal information
                                to send you promotional information about third parties which we think you may find
                                interesting if you tell us that you wish this to happen.</p>
                            <p>If you believe that any information we are holding on you is incorrect or incomplete, please
                                write to or email us as soon as possible, at the above address. We will promptly correct any
                                information found to be incorrect.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Privacy Policy Area  -->

    </main>
@endsection
@push('custum-scripts')
@endpush
