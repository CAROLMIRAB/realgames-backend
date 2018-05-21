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
                        <h3 class="box-title">{{ __('Clientes') }}</h3>
                    </div>
                    <div class="box-body">
                        <table id="users"
                               class="table table-bordered table-striped table-condensed flip-content datatable-clientsdatatable"
                               data-route="{{ route('clients.findclients', [$username]) }}">
                            <thead>
                            <tr role="row">
                                <th  aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                     aria-controls="transactions" tabindex="0"
                                     class="sorting" width="5%">{{ __('ID') }}</th>
                                <th class="no-sort" width="15%">{{ __('Secret') }}</th>
                                <th class="sorting" width="10%">{{ __('Usuario') }}</th>
                                <th class="sorting" width="10%">{{ __('Nombre') }}</th>
                                <th class="sorting" width="18%">{{ __('Correo') }}</th>
                                <th class="no-sort" width="12%">{{ __('IP') }}</th>
                                <th class="sorting" width="5%">{{ __('URL') }}</th>
                                <th class="sorting" width="20%">{{ __('Moneda') }}</th>
                                <th class="sorting" width="15%">{{ __('Timezone') }}</th>
                                <th class="sorting" width="5%">{{ __('Rol') }}</th>
                                <th class="sorting" width="5%">{{ __('Estatus') }}</th>
                                <th class="no-sort" width="5%"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('clients.modals.editclient')
@endsection

@section('scripts')
    <script src="{{ asset('packages/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('packages/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('src/js/client.js') }}"></script>
    <script src="{{ asset('src/js/modalsclient.js') }}"></script>
    <script>
        $(function () {
            Client.initClientsTable();
            modalClient.chargeSelects();
            modalClient.modalEditClient();
        })
    </script>
@endsection