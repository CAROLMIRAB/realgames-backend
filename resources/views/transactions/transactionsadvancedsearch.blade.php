@extends('template')

@section('styles')
    <link rel="stylesheet"
          href="{{ asset('packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Buscar Transaccion') }}</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="" method="post"
                              id="form-transaction-search">
                            <div class="form-group">
                                <label for="dates">{{ __('Rango de fechas') }}</label>
                                @include('layout.calendar')
                            </div>
                            <div class="form-group">
                                <label for="rut">{{ __('ID de transaccion') }}</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" name="idtransaction"
                                           id="idtransaction" placeholder="{{ __('ID de transaccion') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">{{ __('Usuario') }}</label>
                                <input type="text" class="form-control" name="username"
                                       id="username" placeholder="{{ __('Usuario') }}">
                            </div>
                            <div class="form-group">
                                <label for="username">{{ __('ID de juego') }}</label>
                                <input type="text" class="form-control" name="idgame"
                                       id="idgame" placeholder="{{ __('ID Juego') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Nombre del juego') }}</label>
                                <input type="text" class="form-control" name="gamename"
                                       id="gamename" placeholder="{{ __('Juego') }}">
                            </div>
                    </div>
                    <div class="box-footer">
                        <button type="reset" class="btn btn-info">{{ __('Limpiar busqueda') }}</button>
                        <button class="btn btn-success pull-right" type="button" name="btn-update"
                                id="btn-update"
                                data-loading-text="<i class='fa fa-spinner fa-spin'></i> {{ __('Consultando...') }}">
                            <i class="fa fa-search"></i>
                            {{ __("Buscar") }}
                        </button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('Resultado de la busqueda') }}</h3>
                    </div>
                    <div class="box-body flip-scroll" id="result">

                        <table id="transactions"
                               class="table table-bordered table-striped dataTable flip-content find-transaction-datatable"
                               data-route="{{ route('transactions.transactionsadvancedsearch') }}">
                            <thead class="flip-content">
                            <tr role="row">
                                <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                    aria-controls="transactions" tabindex="0"
                                    class="sorting" width="20%">{{ __('Transacción') }}</th>
                                <th class="no-sort" width="20%">{{ __('Usuario') }}</th>
                                <th class="no-sort" width="20%">{{ __('Juego') }}</th>
                                <th class="no-sort" width="20%">{{ __('Tipo') }}</th>
                                <th class="no-sort" width="20%">{{ __('Monto') }}</th>
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
    <script src="{{ asset('src/js/date-range.js') }}"></script>
    <script src="{{ asset('packages/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('packages/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('packages/datatables-plugins/api/fnReloadAjax.js') }}"></script>
    <script src="{{ asset('src/js/reports.js') }}"></script>

    <script>
        $(function () {
            Reports.initTransactionAdvancedSearch();
        });

    </script>

@endsection