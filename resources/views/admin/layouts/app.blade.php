<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ @$page_title ? $page_title . ( @$page_subtitle ? ' - ' . $page_subtitle : '' ) . ' | ' . getenv('APP_DOMAIN') : getenv('APP_DOMAIN') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/extras/animate.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Custom CSS -->
    <link href="{{ asset('assets/admin/css/custom.css?v=1.0.0') }}" rel="stylesheet" type="text/css">

    <!-- Page CSS files -->
@yield('style')
<!-- /page CSS files -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/media/fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/ui/headroom/headroom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/ui/headroom/headroom_jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/ui/nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/buttons/spin.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/buttons/ladda.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/notifications/sweetalert2.min.js') }}"></script>
    <style media="screen">
        .swal2-popup {
            font-size: 13px !important;
        }
    </style>
    <!-- BEGIN CDN PUGLINS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- END BEGIN CDN PLUGINS -->

    <script type="text/javascript" src="{{ asset('assets/admin/js/core/app.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('assets/js/pages/dashboard.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/admin/js/pages/layout_fixed_custom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/pages/layout_navbar_hideable_sidebar.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /theme JS files -->

    <!-- Page JS files -->
@yield('script')
<!-- /page JS files -->

</head>

<body class="navbar-top">


<!-- Main navbar -->
@include('admin.layouts.partials.navbar')
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">


        <!-- Main sidebar -->
    @include('admin.layouts.partials.sidebar')
    <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">


            <!-- Page content -->
        @yield('content')
        <!-- /page content -->


        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
