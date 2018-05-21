@extends('email')

@section('title')
    {{ __('Bienvenido') }}
@endsection

@section('subtitle')
    {{ __('Bienvenido') . $username }}
@endsection

@section('content')
    {{ __('Bienvenido a nuestro sistema DotSpin.') }}
@endsection

@section('button')
    <a href="{{ route('clients.login') }}"
       style="color: #fff; font-family: Arial, Helvetica, sans-serif; font-size: 13px; background: #ff6b57; padding:  15px 40px; text-transform: uppercase; font-weight: bold; text-decoration: none; border-radius: 5px;">
        {{ __('Ir al administrador') }}
    </a>
@endsection

@section('footer')
    <strong>
        {{ __('Si no ve el boton entrar a : ') }}
    </strong>
    <br>
    <br>
    {{ route('clients.login') }}
@endsection