@extends('admin.layouts.app')

@section('content')
    <!-- Page header -->
    @include('admin.layouts.partials.header', [
      'title' => 'Dashboard',
      'breadcrumbs' => []
    ])
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">

        <!-- Alert -->
        @include('admin.layouts.partials.alert')
        <!-- /alert -->


        <!-- Footer -->
        @include('admin.layouts.partials.footer')
        <!-- /footer -->

    </div>
@endsection

@section('script')
    <!-- BEGIN CDN PUGLINS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- END BEGIN CDN PLUGINS -->
@endsection
