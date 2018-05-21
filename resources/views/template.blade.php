<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title> {{ __('DotSpin') }} | {{ __('Dashboard') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{ url('') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('packages/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/iCheck/skins/flat/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/datatables/media/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/spinner.css') }}">
    <link rel="stylesheet"
          href="{{ asset('packages/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/styles.css') }}">
    @yield('styles')
    <script src="{{ asset('packages/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $(window).load(function () {
            $('#page-loader').fadeOut(500)
            $('#page-logo-loader').fadeOut(500);
        });
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="page-logo-loader"></div>
<div id="page-loader"><span class="preloader-interior"></span></div>
<div class="wrapper">
    @include('layout.bartop')
    @include('layout.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
    @include('layout.footer')
</div>
<script src="{{ asset('packages/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('packages/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('packages/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('packages/jquery-knob/js/jquery.knob.js') }}"></script>
<script src="{{ asset('packages/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('packages/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('packages/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('packages/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('packages/jquery.slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('packages/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('packages/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('packages/datatables-tabletools/js/dataTables.tableTools.js')}}"></script>
<script src="{{ asset('packages/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('packages/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('packages/toastr/toastr.js') }}"></script>
<script src="{{ asset('packages/jquery.maskedinput/dist/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('packages/bootstrapvalidator/dist/js/language/es_ES.js') }}"></script>
<script src="{{ asset('admin-lte/dist/js/app.min.js') }}"></script>
<script src="{{ asset('src/js/toastrconfiguration.js') }}"></script>
<script src="{{ asset('src/js/animateNumber.min.js') }}"></script>
<script src="{{ asset('src/js/core.js') }}"></script>
@yield('scripts')
<script>
    $(function () {
        Core.activateMenu();
        Core.language();
    });
</script>
</body>
</html>
