@extends('template')

@section('styles')
    <link rel="stylesheet"
          href="{{ asset('packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12 totals-profit"
                 data-route="{{ route('reports.profitgeneraluserstotals') }}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __("Jugado") }}</span>
                        <span class="info-box-number"><ul class="horizontal-list-ul"
                                                          id="purchase"></ul></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ribbon-b"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __("Ganado") }}</span>
                        <span class="info-box-number"><ul class="horizontal-list-ul"
                                                          id="won"></ul></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __("Profit") }}</span>
                        <span class="info-box-number"><ul class="horizontal-list-ul"
                                                          id="profit"></ul></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12 result">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('Resultado de la busqueda') }}</h3>
                        <div class="box-tools pull-right">
                            <form method="post" id="credit-transactions-form">
                                <div class="pull-right">
                                    @include('layout.calendar')
                                    <button class="btn btn-success pull-right" type="button" name="btn-update"
                                            id="btn-update"
                                            data-loading-text="<i class='fa fa-spinner fa-spin'></i> {{ __('Consultando...') }}">
                                        <i class="fa fa-refresh"></i>
                                        {{ __("Actualizar") }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body table-responsive" id="result">
                        <div class="table-responsive">
                            <table id="profitbyGame"
                                   class="table table-bordered table-striped dataTable client-datatable"
                                   data-route="{{ route('reports.profitgeneralusersdata') }}">
                                <thead class="flip-content">
                                <tr role="row">
                                    <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                        aria-controls="transactions" tabindex="0"
                                        class="sorting" width="23%">{{ __('Usuarios') }}</th>
                                    <th class="no-sort" width="23%">{{ __('Jugado') }}</th>
                                    <th class="sorting" width="23%">{{ __('Ganado') }}</th>
                                    <th class="sorting" width="23%">{{ __('Profit') }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

    <script src="{{ asset('packages/datatables-plugins/api/fnReloadAjax.js') }}"></script>
    <script src="{{ asset('packages/jquery-number/jquery.number.min.js') }}"></script>
    <script src="{{ asset('src/js/date-range.js') }}"></script>
    <script src="{{ asset('src/js/reports.js') }}"></script>
    <script>
        $(function () {
            Reports.dataTableProfitUsers();
        });
    </script>
@endsection