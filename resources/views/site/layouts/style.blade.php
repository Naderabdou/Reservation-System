<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.xyz/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@if (Route::currentRouteName() == 'site.retreat.index')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" />
@endif

<link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

<link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/lightgallery-bundle.min.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="{{ asset('site/css/animate.css') }}">



<link rel="stylesheet" href="{{ asset('site/css/general.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/loader.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/header.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/footer.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('loginLayout/site/css/main2.css') }}">
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('site/css/ar.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('site/css/en.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('site/css/responsive.css') }}">


@stack('css')
<style>
    .error {
        color: red !important;
        font-size: 15px !important;
        display: flex !important;

    }

    .custom-confirm-btn {

        background-color: var(--color-Primary1) !important;
        /* Green background for the confirm button */
        color: white !important;
        /* White text for the confirm button */
    }

    .custom-deny-btn {
        background-color: #f44336 !important;
        /* Red background for the deny button */
        color: white !important;
        /* White text for the deny button */
    }
</style>


<style>
    .pagination li {
        display: inline-block;
        padding: 5px;
    }

    .custom-pagination {
        display: flex;
        list-style: none;
        padding: 0;
        justify-content: center;
        margin-top: 20px;
    }

    .custom-pagination li {
        margin: 0 5px;
    }

    .custom-pagination a {
        background-color: #fff;
        border: 1px solid #B3B8B9;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        color: #999999;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        padding-top: 3px;
    }

    .custom-pagination a:hover,
    .custom-pagination .active a {
        border-color: var(--color-Primary2);
        color: #000000;
        background-color: var(--color-Primary2);
    }
</style>
