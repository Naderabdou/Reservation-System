@include('site.layouts.header')
    <!-- BEGIN: Content-->

        @include('site.layouts.navbar')

        @yield('content')

        <!-- END: Content-->
@include('site.layouts.footer')
