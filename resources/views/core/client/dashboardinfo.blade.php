<div class="row">
    <div class="col-md-9 col-xs-12 transactionsdata" data-route="{{ route('dashboard.graphictransactions') }}">
        <div style="cursor: move;" class="box">
            <div style="" class="box-header">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-inbox"></i>{{ __('Transacciones')}}</h3>
                    <div class="pull-right">
                        <div class="form-group form-horizontal">
                            <div class="col-md-8">
                                <form id="form-mes" method="get" action="{{ route('dashboard.graphictransactions') }}">
                                    <select id="month" name="month" class="form-control">
                                        <option value="">{{ __('Ultimas 4 semanas') }}</option>
                                        <option value="1">{{ __('Enero') }}</option>
                                        <option value="2">{{ __('Febrero') }}</option>
                                        <option value="3">{{ __('Marzo') }}</option>
                                        <option value="4">{{ __('Abril') }}</option>
                                        <option value="5">{{ __('Mayo') }}</option>
                                        <option value="6">{{ __('Junio') }}</option>
                                        <option value="7">{{ __('Julio') }}</option>
                                        <option value="8">{{ __('Agosto') }}</option>
                                        <option value="9">{{ __('Septiembre') }}</option>
                                        <option value="10">{{ __('Octubre') }}</option>
                                        <option value="11">{{ __('Noviembre') }}</option>
                                        <option value="12">{{ __('Diciembre') }}</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <button name="btn-search" id="btn-search" class="btn btn-success"
                                        data-loading-text="<i class='fa fa-spin fa-spinner'></i> {{ __('Buscando') }}">{{ __('Buscar') }} </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart box-body chart-dasboard">
                    <canvas width="600" height="228" id="barChart" style="height: 228px; width: 200px;"></canvas>
                    <div class="no-data hidden">
                        <i class="fa fa-exclamation-circle">{{ __("No existen datos para esta consulta") }}</i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--scrollable-->

    <div class="col-md-3 col-xs-12 latesttransactions">
        <div class="box direct-chat direct-chat-primary" data-route="{{ route('dashboard.latesttransactions') }}">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __("Ultimas Transacciones") }}</h3>
            </div>
            <div class="box-body">
                <div id="content-1" class="mCustomScrollbar" data-mcs-theme="3d-thick-dark">
                    <ul class="list">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="box the-most-played">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __("Los más Jugados de la semana") }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <div class=" hidden">
                    @include('layout.calendar')
                    <button class="btn btn-success pull-right" type="button" name="btn-update"
                            id="btn-update"
                            data-loading-text="<i class='fa fa-spinner fa-spin'></i> {{ __('Consultando...') }}">
                        <i class="fa fa-refresh"></i>
                        {{ __("Actualizar") }}
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row first-three" data-route="{{ route('reports.spinbygamefirst') }}">

                    <div class="col-md-4 first">

                    </div>
                    <div class="col-md-4 second">

                    </div>
                    <div class="col-md-4 third">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xs-12">
        <div class="box box-top-players" data-route="{{ route('dashboard.topplayers') }}">
            <div class="box-header with-border tabs-games" data-route="{{ route('dashboard.favoritesgames') }}">
                <h3 class="box-title">{{ __("Top de Jugadores") }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
                <div class=" hidden">
                    @include('layout.calendar')
                    <button class="btn btn-success pull-right" type="button" name="btn-update"
                            id="btn-update"
                            data-loading-text="<i class='fa fa-spinner fa-spin'></i> {{ __('Consultando...') }}">
                        <i class="fa fa-refresh"></i>
                        {{ __("Actualizar") }}
                    </button>
                </div>
            </div>
            <div class="box-body" id="top-players">


            </div>
        </div>
    </div>
</div>


