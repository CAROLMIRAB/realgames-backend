<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DotSpin | Log in</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('packages/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/styles.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a><b>{{__('Dot')}}</b><strong>{{__('Spin')}}</strong></a>
    </div>
    <div class="login-box-body">
        @if(\Session::has('error'))
            <div class="callout callout-danger">
                <h4>Error</h4>
                <p>{{ \Session::get('error') }}</p>
            </div>
        @endif
        <p class="login-box-msg">{{ __("Logueate para entrar a tu sesión") }}</p>
        <form action="{{ route('clients.post-login') }}" method="post" id="form-login">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="{{ __('Nombre de Usuario') }}" name="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ __('Contraseña') }}" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <button type="submit" id="btn-enter" class="btn btn-primary btn-block btn-flat" data-loading-text="<i class='fa fa-spinner fa-spin'></i> {{ __('Enviando...') }}">
                        {{ __("Entrar") }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div id="alert" class="alert alert-danger alert-dismissible alert-login hidden">
        <h4><i class="icon fa fa-ban"></i> {{ __('Alert!') }}</h4>
        <div class="message-login"></div>
    </div>
</div>

<script src="{{ asset('packages/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('packages/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('src/js/login.js') }}"></script>
<script>
    $(function () {
        Login.loginMessage();
    });
</script>
</body>
</html>
