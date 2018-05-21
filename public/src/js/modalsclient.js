var modalClient = function () {
    var ips = 0;
    return {
        /************************************ validate modals ************************/
        validateModals: function () {
            $('#form-pass').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'La Contraseña no puede estar vacia'
                            },

                            stringLength: {
                                min: 8,
                                message: 'La Contraseña debe tener al menos 8 caracteres'
                            }
                        }
                    },
                    confirm_password: {
                        validators: {
                            notEmpty: {
                                message: 'El campo esta vacio, debe confirmar su contraseña'
                            },
                            identical: {
                                field: 'password',
                                message: 'La contraseña no coincide'
                            },
                            stringLength: {
                                min: 8,
                                message: 'La Contraseña debe tener al menos 8 caracteres'
                            }

                        }
                    },
                },

            });

            $('#form-url').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    url: {
                        validators: {
                            notEmpty: {
                                message: 'La url esta vacia'
                            },
                            stringLength: {
                                min: 10,
                                message: 'La url debe contener al menos 10 caracteres'
                            }
                        }
                    },
                },
            });

            $('#form-ip').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    'ip[]': {
                        validators: {
                            notEmpty: {
                                message: 'La ip esta vacia'
                            },
                        }
                    },
                },
            });
        },

        /************************************ Submit of all modals ************************/
        submitModals: function () {

            //submit form modal url
            $("#form-url").on("submit", function (e) {
                var postData = $(this).serialize();
                var formURL = $(this).attr("action");
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                }).done(function (text) {
                    $('#modalEditUrl').modal('hide');
                    toastr['success']("Se ha modificado la url de forma correcta");
                }).fail(function () {
                    $('#modalEditUrl').modal('hide');
                    toastr['error']("Proceso fallido', 'No se pudo procesar su solicitud");
                });
                return false;
            });

            //submit modal password
            $("#form-pass").on("submit", function (e) {
                var postData = $(this).serialize();
                var formURL = $(this).attr("action");
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                }).done(function (text) {
                    $('#modalEditPassword').modal('hide');
                    $('#password').val('');
                    $('#confirm_password').val('');
                    toastr['success']("Se ha modificado su password de forma correcta");
                }).fail(function () {
                    $('#modalEditPassword').modal('hide');
                    toastr['error']("Proceso fallido', 'No se pudo procesar su solicitud");
                });
                return false;
            });
            //submit modal ip
            $("#form-ip").on("submit", function (e) {
                var postData = $(this).serialize();
                var formURL = $(this).attr("action");
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                }).done(function (text) {
                    $('#modalEditIp').modal('hide');
                    toastr['success']("Se ha modificado su ip de forma correcta");
                    $("#form-ip").data('bootstrapValidator').resetForm();
                    $('#accept').button('reset');
                }).fail(function () {
                    $('#modalEditIp').modal('hide');
                    toastr['error']("Proceso fallido', 'No se pudo procesar su solicitud");
                });
                return false;
            });

        },

        addIp: function () {
            ips = ips + 1;
            $(".ips").append('<li class="ipli' + ips + '"><div class="ipl' + ips + ' input-group input-group-sm"><input type="text" name="ip[]" class="ip' + ips + ' form-control" size="20"  id="ip" /><span class="input-group-btn"><button type="button" class="btn btn-info btn-flat" onclick="javascript:modalClient.removeIp(' + ips + ');"><span class="glyphicon glyphicon-minus"></span></button></span></div></li>');
        },
        removeIp: function (id) {
            $('.ipli' + id).remove();
            return false;
        },

        showModals: function () {

            $('#modalEditIp').on('show.bs.modal', function (event) {
                $.ajax({
                    url: $('.details-client').data('route'),
                    type: 'post',
                    dataType: 'json'
                }).done(function (json) {
                    var ip = $.parseJSON(json.ip);
                    $('.div-ip').html(json.ip);
                    $('.loaderIp').addClass('hidden');
                });

            });


            $('#modalEditUrl').on('show.bs.modal', function (event) {
                $('#form-url').bootstrapValidator('resetForm', true);
                $.ajax({
                    url: $('.details-client').data('route'),
                    type: 'post',
                    dataType: 'json'
                }).done(function (json) {
                    $('.urlinput').val(json.urlconfirm);

                    $('#form-url').removeClass('hidden');
                    $('.loaderUrl').addClass('hidden');

                });

            });
        },

        chargeSelects: function () {
            $.ajax({
                type: "get",
                dataType: "json",
                url: $('#modalEdit').data('route'),
            }).done(function (json) {
                $('#modalEdit #currencyM').find('option').remove();
                $('#modalEdit #timezoneM').find('option').remove();
                $('#modalEdit #rolM').find('option').remove();
                $('#modalEdit #statusM').find('option').remove();

                $.each(json.currencies, function (i, val) {
                    $('#modalEdit #currencyM').append('<option value="' + val.iso + '">' + val.description + '</option>');
                });

                $.each(json.timezones, function (i, val) {
                    $('#modalEdit #timezoneM').append('<option value="' + val + '">' + val + '</option>');
                });

                $.each(json.roles, function (i, val) {
                    $('#modalEdit #rolM').append('<option value="' + val.id + '">' + val.description + '</option>');
                });

                $.each(json.status, function (i, val) {
                    $('#modalEdit #statusM').append('<option value="' + val.id + '">' + val.description + '</option>');
                });

            });
        },


        modalEditClient: function () {
            $(document).on("click", ".open-modal", function () {
                var idM = $(this).data('id');
                var usernameM = $(this).data('username');
                var nameM = $(this).data('name');
                var str = $(this).data('ip');
                var ip = str.replace(/\\/g, "");
                var ipM = ip.replace('"[', '[');
                var ipM = ipM.replace(']"', ']');
                var emailM = $(this).data('email');
                var urlconfirmM = $(this).data('urlconfirm');
                var currencyM = $(this).data('currency');
                var timezoneM = $(this).data('timezone');
                var rolM = $(this).data('rol');
                var statusM = $(this).data('status');

                $("#modalEdit #idM").val(idM);
                $("#modalEdit #usernameM").val(usernameM);
                $("#modalEdit #nameM").val(nameM);
                $("#modalEdit #urlconfirmM").val(urlconfirmM);
                $("#modalEdit #ipM").val(ipM);
                $("#modalEdit #emailM").val(emailM);

                $('#modalEdit #currencyM option').each(function () {
                    if ($(this).val() == currencyM) {
                        $(this).prop("selected", true);
                    }
                });

                $('#modalEdit #timezoneM option').each(function () {
                    if ($(this).val() == timezoneM) {
                        $(this).prop("selected", true);
                    }
                });

                $('#modalEdit #statusM option').each(function () {
                    if ($(this).val() == statusM) {
                        $(this).prop("selected", true);
                    }
                });

                $('#modalEdit #rolM option').each(function () {
                    if ($(this).val() == rolM) {
                        $(this).prop("selected", true);
                    }
                });

                $('#modalEdit #form-client').removeClass('hidden');
                $('.loader').addClass('hidden');

            });
        },

        updateClient: function () {
            $("#btn-update").click(function (e) {
                var postData = $('#form-client').serialize();
                var formURL = $('#form-client').attr("action");

                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                }).done(function (json) {
                    var route = $('.find-clients-datatable').data('route');
                    var $table = $('.find-clients-datatable').dataTable({
                        "retrieve": true
                    });
                    $table.fnReloadAjax(route);
                    toastr['success'](null, json.message);
                }).fail(function (json) {
                    if (json.status == 422) {
                        $.each(json.responseJSON, function (index, val) {
                            toastr['error'](null, val);
                        });
                    } else {
                        toastr['error'](null, json.error);
                    }
                });

            });
        },

    }//Keys close return
}();//Key close function content