<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | {{ getenv('APP_DOMAIN') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/admin/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/forms/styling/uniform.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/admin/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/pages/login.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/ui/ripple.min.js') }}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container">

<!-- Main navbar -->

<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Advanced login -->
                {{ Form::open(['route' => 'admin.login']) }}
                <div class="login-form">
                    <div class="text-center">
                        <div class="icon-object border-teal-400 text-teal-600"><i class="icon-office"></i></div>
                        <h5 class="content-group-lg">
                            {{ getenv('APP_NAME') }}
                        </h5>
                    </div>

                    @include('admin.layouts.partials.alert')

                    <div class="form-group has-feedback has-feedback-left {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" class="form-control input-lg" name="email" placeholder="Email" value="{{ old('email') }}">
                        <div class="form-control-feedback">
                            <i class="icon-envelop5 text-muted"></i>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">{{ implode('<br>', $errors->get('email')) }}</span>
                        @endif
                    </div>

                    <div class="form-group has-feedback has-feedback-left {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" class="form-control input-lg" name="password" placeholder="Password">
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">{{ implode('<br>', $errors->get('password')) }}</span>
                        @endif
                    </div>

                    <div class="form-group login-options">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="styled" name="remember" checked="checked">
                                    Remember
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn bg-teal-400 btn-block btn-lg">Login <i class="icon-arrow-right14 position-right"></i></button>
                    </div>

                    <div class="content-divider text-muted form-group"><span>&copy;</span></div>
                    <span class="help-block text-center">Copyright {{ date('Y') }}</span>
                </div>
            {{ Form::close() }}
            <!-- /advanced login -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
