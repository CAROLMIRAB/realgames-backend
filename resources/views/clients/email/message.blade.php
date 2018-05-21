@extends('email')

@section('title')
    {{ __('Activación de su cuenta') }}
@endsection

@section('subtitle')
    {{ __('Activación del usuario ') . $name }}
@endsection

@section('button')
    <br>
    <p>
        {{ __('Puede acceder al Administrador DotSpin con los siguientes datos:') }}
        <br>
        <strong>{{ __('Username:') }}</strong> {{ $username }}
        <br>
        <strong>{{ __('Password:') }}</strong> {{ $password }}
        <br>
        <strong>{{ __('Client ID:') }}</strong> {{ $client_id }}
        <br>
        <strong>{{ __('Secret ID:') }}</strong> {{ $secret_id }}
    </p>
@endsection

@section('footer')
    <strong>{{ __('Importante: esta cuenta de correo no es monitoriada') }}</strong>
@endsection