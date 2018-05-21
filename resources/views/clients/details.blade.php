@extends('template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('packages/x-editable/dist/bootstrap-editable/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/styles.css') }}">
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="box details-client" data-route="{{ route('clients.detailsdata', $username) }}">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="../src/cliente.jpg" alt="User profile picture">
                        <h3 class="profile-username text-center username"></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{ __('Usuario') }}</b>
                                <a class="pull-right username" href="#" id="username" name="username"> </a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('URL de Confirmacion') }}</b>
                                <a class="btn btn-success pull-right" data-toggle="modal"
                                   data-target="#modalEditUrl"><span
                                            class="glyphicon glyphicon-edit pull-right"></span></a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('IP') }}</b>
                                <button class="btn btn-success pull-right open-modal" data-toggle="modal"
                                        data-target="#modalEditIp"><span
                                            class="glyphicon glyphicon-search" > </span></button>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('Cambiar Contraseña') }}</b>
                                <a class="btn btn-success pull-right" data-toggle="modal"
                                   data-target="#modalEditPassword"><span
                                            class="glyphicon glyphicon-edit pull-right"></span></a>

                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /details client -->
    @include('clients.modals.editpassword')
    @include('clients.modals.showip')
    @include('clients.modals.editurl')
@endsection
@section('scripts')
    <script src="{{ asset('packages/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('packages/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}"></script>
    <script src="{{ asset('src/js/client.js') }}"></script>
    <script src="{{ asset('src/js/modalsclient.js') }}"></script>
    <script>
        $(function () {
            Client.clientDetails();
            modalClient.showModals();
            modalClient.submitModals();
            modalClient.validateModals();
        });

    </script>
@endsection