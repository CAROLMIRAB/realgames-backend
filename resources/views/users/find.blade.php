@extends('template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('packages/datatables/media/css/dataTables.bootstrap.min.css') }}">

    @endsection

@section('content')
    <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ __('Usuarios') }}</h3>
                </div>
                <div class="box-body">
                    <table id="users" class="table table-bordered table-striped table-condensed flip-content datatable-usersdatatable" data-route="{{ route('users.find', [$username]) }}">
                        <thead>

                        <tr>
                            <th>{{ __('Id') }}</th>
                            <th>{{ __('DNI') }}</th>
                            <th>{{ __('Usuario') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Nombre') }}</th>
                            <th>{{ __('Apellido') }}</th>
                            <th>{{ __('Detalles') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{ asset('packages/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('packages/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('src/js/users.js') }}"></script>
    <script>
        $(function() {
            Users.initUsersTable();
        })
    </script>
@endsection

