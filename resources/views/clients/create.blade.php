@extends('template')
@section('styles')
    <link rel="stylesheet" href="{{ asset('packages/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Crear Clientes') }}</h3>
                    </div>
                    <form role="form" action="{{ route('clients.create-post') }}" method="post"
                          id="form-client-register" name="form-client-register" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="id" class="col-md-2 control-label">{{ __('ID de cliente') }}</label>
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
                                <label for="email" class="col-md-2 control-label">{{ __('Correo') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="email"
                                           id="email" placeholder="{{ __('Correo') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="urlconfirm"
                                       class="col-md-2 control-label">{{ __('Url Confirmación') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="urlconfirm"
                                           id="urlconfirm" placeholder="{{ __('Url Confirmacion') }}">
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
                                <label for="timezone" class="col-md-2 control-label">{{ __('Zona Horaria') }}</label>
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
                                            <option value="{{ $rol->id  }}" @if($rol->id==1) {{ "selected" }} @endif>{{ $rol->description }}</option>
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
                                            <option value="{{ $stat->id  }}" @if($stat->id==1) {{ "selected" }} @endif>{{ $stat->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ip" class="col-md-2 control-label">{{ __('Ip') }}</label>
                                <div class="col-md-10">
                                    <ol class="ipreg">
                                        <li class=" ipli">
                                            <div class="ipl input-group input-group-sm">
                                                <input type="text" name="ip[]" class="ip form-control" id="ip"/>
                                                <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat"
                                                    onclick="javascript:Client.addIp();">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                            </span>
                                            </div>
                                        </li>
                                    </ol>

                                </div>
                                <!--   <div class="form-group">
                                       <label for="domain"
                                              class="col-md-2 control-label">Dominio</label>
                                       <div class="col-md-10">
                                           <input type="text" class="form-control" name="domain"
                                                  id="domain" placeholder="Dominio">
                                       </div>
                                   </div>-->
                            </div>
                    </form>
                    <div class="box-footer">
                        <button type="button" id="btn-create" name="btn-create"
                                class="btn btn-primary pull-right">{{ __('Crear') }}</button>
                        <button type="reset" class="btn btn-default pull-left">{{ __('Limpiar') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('packages/bootstrapvalidator/dist/js/bootstrapValidator.min.js') }}"></script>
    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('src/js/client.js') }}"></script>
    <script src="{{ asset('src/js/validatorentry.js') }}"></script>
    <script>
        $('#name').validCampFranz('abcdefghijklmnñopqrstuvwxyzáéíóú');
        $('#timezone, #currency, #status, #rol').select2();
        $(function () {
            Client.validateRegister();
        });
    </script>
@endsection