@extends('email')

@section('title')
    {{ __('Credenciales DotSpin') }}
@endsection

@section('subtitle')
    {{ __('Credenciales de acceso cliente ') . $name }}
@endsection

@section('button')
    <br>
    <p>
        {{ __('Estas son sus credenciales de acceso al administrador:') }}
        <br>
        <br>
        <strong>{{ __('URL:') }}</strong> {{ env('ADMIN_URL')  }}
        <br>
        <strong>{{ __('Username:') }}</strong> {{ $username }}
        <br>
        <strong>{{ __('Password:') }}</strong> {{ $password }}
        <br>
        <strong>{{ __('Moneda:') }}</strong> {{ $currency }}
        <br>
        <br>
        {{ __('Estas son sus credenciales de acceso a la API:') }}

        <br>
        <br>
        <strong>{{ __('URL:') }}</strong> {{ env('API_URL') }}
        <br>
        <strong>{{ __('Client ID:') }}</strong> {{ $client_id }}
        <br>
        <strong>{{ __('Client Secret:') }}</strong> {{ $secret }}
        <br>
        <br>

    </p>
@endsection

@section('footer')
    <small>{{ __('Importante: esta cuenta de correo no es monitoriada') }}</small>
@endsection