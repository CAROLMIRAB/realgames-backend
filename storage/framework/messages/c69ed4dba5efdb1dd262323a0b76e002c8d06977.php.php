<div class="modal fade" id="modalEditPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalEditLabel"><?php echo e(__('Modificar Contraseña')); ?></h4>
            </div>
            <div class="modal-body">

                <form id="form-pass" name="form-pass" method="post" action="<?php echo e(route('clients.editpassword')); ?>">
                    <div class="form-group">
                        <div>
                            <label><?php echo e(__('Nueva Contraseña')); ?></label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="<?php echo e(__('Nueva Contraseña')); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <label><?php echo e(__('Confirme Nueva Contraseña')); ?></label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                   placeholder="<?php echo e(__('Confirme Contraseña')); ?>" data-match="#pass1"
                                   data-match-error="<?php echo e(__('La Contraseña no coincide')); ?>"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal"><?php echo e(__('Cerrar')); ?></button>

                            <button type="submit" class="btn btn-success left"><?php echo e(__('Aceptar')); ?></button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>