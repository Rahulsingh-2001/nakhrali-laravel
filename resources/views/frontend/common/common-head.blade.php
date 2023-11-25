<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/bootstrap.rtl.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/font-awesome.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/flaticon/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/sal.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/vendor/base.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
<script src="https://kit.fontawesome.com/87a0c91fb7.js" crossorigin="anonymous"></script>
<script>
    const LOAD_MORE_URL = "{{ route('frontend.load.more') }}";
    const GET_SIZES_URL = "{{ route('frontend.get.sizes') }}";
    const ENQUIRY_URL = "{{ route('frontend.page.save.enquiry') }}";
    const ADD_TO_CART = "{{ route('frontend.add-to-cart') }}";
    const ADD_TO_WISH_LIST = "{{ route('frontend.user.add-to-wishList') }}";
</script>
</head>


<body class="sticky-header newsletter-popup-modal">
