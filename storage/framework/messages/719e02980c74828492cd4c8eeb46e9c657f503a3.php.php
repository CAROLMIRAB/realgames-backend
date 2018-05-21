<div class="modal fade" id="modalEditUrl" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><?php echo e(__('Modificar URL')); ?></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('clients.editurl')); ?>" method="post" id="form-url" name="form-url"
                      class="hidden">
                    <div class="form-group">
                        <div class="input-icon right">
                            <input class="urlinput form-control" id="url" name="url" size="50">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success left" id="btnSubmit">Enviar</button>
                    </div>
                </form>
                <div class="box box-solid">
                    <div class="overlay loaderUrl">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

