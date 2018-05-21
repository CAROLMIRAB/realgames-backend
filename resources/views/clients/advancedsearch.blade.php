@extends('template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('packages/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Busqueda Avanzada') }}</h3>
                    </div>
                    <form role="form" action="" method="post"
                          id="form-client-search" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="id" class="col-md-2 control-label">{{ __('ID') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="id"
                                           id="id" placeholder="{{ __('ID de Cliente') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-md-2 control-label">{{ __('Nombre') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control col-md-4" name="name"
                                           id="name" placeholder="{{ __('Nombre') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-md-2 control-label">{{ __('Usuario') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="username"
                                           id="username" placeholder="{{ __('Usuario') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="urlconfirm"
                                       class="col-md-2 control-label">{{ __('URL') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="urlconfirm"
                                           id="urlconfirm" placeholder="{{ __('Url de Confirmacion') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="currency" class="col-md-2 control-label">{{ __('Moneda') }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="currency" name="currency">
                                        <option value="">{{ __('Seleccione') }}</option>
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->iso  }}">{{ $currency->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="timezone" class="col-md-2 control-label">{{ __('Timezone') }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="timezone" name="timezone">
                                        <option value="">{{ __('Seleccione') }}</option>
                                        @foreach($timezones as $timezone)
                                            <option value="{{ $timezone  }}">{{ $timezone  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rol" class="col-md-2 control-label">{{ __('Rol') }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="rol" name="rol">
                                        <option value="">{{ __('Seleccione') }}</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->id  }}">{{ $rol->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-2 control-label">{{ __('Estatus') }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="status" name="status">
                                        <option value="">{{ __('Seleccione') }}</option>
                                        @foreach($status as $stat)
                                            <option value="{{ $stat->id  }}">{{ $stat->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-primary pull-right" id="btn-search"
                                        data-loading-text="<i class='fa fa-spin fa-spinner'></i> {{ __('Buscando') }}">
                                    {{ __('Buscar') }}
                                </button>
                                <button type="reset" class="btn btn-default pull-left">{{ __('Limpiar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ __('Resultado de la busqueda') }}</h3>
                    </div>
                    <div class="box-body table-responsive" id="result">
                        <div class="table-responsive">
                            <table id="transactions"
                                   class="table table-bordered table-striped dataTable find-clients-datatable"
                                   data-route="{{ route('clients.advance-search-clients') }}">
                                <thead class="flip-content">
                                <tr role="row">
                                    <th aria-label="Name: activate to sort column ascending" style="width: 304px;"
                                        aria-controls="transactions" tabindex="0"
                                        class="sorting" width="5%">{{ __('ID') }}</th>
                                    <th class="no-sort" width="12%">{{ __('Secret') }}</th>
                                    <th class="sorting" width="10%">{{ __('Usuario') }}</th>
                                    <th class="sorting" width="10%">{{ __('Nombre') }}</th>
                                    <th class="sorting" width="15%">{{ __('Correo') }}</th>
                                    <th class="no-sort" width="12%">{{ __('Dominio') }}</th>
                                    <th class="sorting" width="5%">{{ __('URL') }}</th>
                                    <th class="sorting" width="3%">{{ __('Moneda') }}</th>
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
        </div>
    </section>
    @include('clients.modals.editclient')
@endsection

@section('scripts')
    <script src="{{ asset('packages/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('packages/datatables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('packages/datatables-plugins/api/fnReloadAjax.js') }}"></script>
    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('src/js/client.js') }}"></script>
    <script src="{{ asset('src/js/modalsclient.js') }}"></script>
    <script src="{{ asset('src/js/validatorentry.js') }}"></script>
    <script>
        $('#timezone, #currency, #status, #rol').select2();
        $(function () {
            Client.initAdvancedSearch();
        });
        Client.sendPass();
        modalClient.chargeSelects();
        modalClient.modalEditClient();
        modalClient.updateClient();

    </script>
@endsection