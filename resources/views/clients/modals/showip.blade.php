<div class="modal fade" id="modalEditIp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditLabel">{{ __('Modificar IP') }}</h4>
            </div>
            <div class="modal-body">
                <form id="form-ip" name="form-ip" method="post"  class="" action="">
                    <div class="div-ip"></div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                        </div>
                    </div>
                </form>
                <div class="box box-solid">
                    <div class="overlay loaderIp">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>