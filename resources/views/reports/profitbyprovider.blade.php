@extends('template')

@section('styles')
    <link rel="stylesheet"
          href="{{ asset('packages/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="pull-right">
                            @include('layout.calendar')
                            <button class="btn btn-success pull-right" type="button" name="btn-update"
                                    id="btn-update"
                                    data-loading-text="<i class='fa fa-spinner fa-spin'></i> {{ __('Consultando...') }}">
                                <i class="fa fa-refresh"></i>
                                {{ __("Actualizar") }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 total" data-route="{{ route("reports.profitbyprovidertotal") }}">
                <div class="info-box ">
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
        </div>

    </section>
    <section class="content">
        <div class="row">
            <div class="loader hidden" > {{ __('Loading...') }}</div>
            <div class="col-xs-12 col-sm-6 col-md-12 providers" data-route="{{ route("reports.profitbyproviderdata") }}">

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('src/js/date-range.js') }}"></script>
    <script src="{{ asset('src/js/reports.js') }}"></script>
    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(function () {
            Reports.profitByProvider();
            Reports.totalProfitByProvider();
            Reports.updateProviders();
        });
    </script>
@endsection