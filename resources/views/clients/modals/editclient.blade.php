<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-route="{{ route("clients.selects") }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditLabel">{{ __('Modificar Client') }}</h4>
            </div>
            <div class="modal-body">
                <form id="form-client" name="form-client" method="post" class="form-horizontal hidden"
                      action="{{ route('clients.update') }}">
                    <div class="form-group">
                        <label for="id" class="col-md-2 control-label">{{ __('ID') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="idM"
                                   id="idM" placeholder="{{ __('ID de Cliente') }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">{{ __('Nombre') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control col-md-4" name="nameM"
                                   id="nameM" placeholder="{{ __('Nombre') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-md-2 control-label">{{ __('Usuario') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="usernameM"
                                   id="usernameM" placeholder="{{ __('Usuario') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">{{ __('Correo') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="emailM"
                                   id="emailM" placeholder="{{ __('Correo') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="urlconfirm"
                               class="col-md-2 control-label">{{ __('Url') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="urlconfirmM"
                                   id="urlconfirmM" placeholder="{{ __('Url de Confirmacion') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ipM"
                               class="col-md-2 control-label">{{ __('IP') }}</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="ipM"
                                   id="ipM" placeholder="{{ __('Array ip') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="currency" class="col-md-2 control-label">{{ __('Moneda') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" id="currencyM" name="currencyM">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="timezone" class="col-md-2 control-label">{{ __('Timezone') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" id="timezoneM" name="timezoneM">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rol" class="col-md-2 control-label">{{ __('Rol') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" id="rolM" name="rolM">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-md-2 control-label">{{ __('Estatus') }}</label>
                        <div class="col-md-10">
                            <select class="form-control" id="statusM" name="statusM">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('Cerrar') }}</button>
                            <button type="button" class="btn btn-success left"
                                    id="btn-update">{{ __('Aceptar') }}</button>
                        </div>
                    </div>

                </form>
                <div class="box box-solid">
                    <div class="overlay loader">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>
