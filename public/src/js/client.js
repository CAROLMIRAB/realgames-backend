/**
 * Created by Carol Mirabal on 16/8/2016.
 */

var Client;
Client = function () {
    var ips = 0;
    return {
        clientDetails: function () {
            $.ajax({
                url: $('.details-client').data('route'),
                type: 'post',
                dataType: 'json'
            }).done(function (json) {
                $('.username').text(json.username);

            });
        },

        initClientsTable: function () {
            var route = $('.datatable-clientsdatatable').data('route');
            var table = $('.datatable-clientsdatatable').dataTable({
                "iDisplayLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": route,
                "order": [],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false}
                ],
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
            });
        },

        addIp: function () {
            ips = ips + 1;
            $(".ipreg").append('<li class="ipli' + ips + '"><div class="ipl' + ips + ' input-group input-group-sm"><input type="text" name="ip[]" class="ip' + ips + ' form-control" size="20"  id="ip" /><span class="input-group-btn"><button type="button" class="btn btn-info btn-flat" onclick="javascript:Client.removeIp(' + ips + ');"><span class="glyphicon glyphicon-minus"></span></button></span></div></li>');
        },

        removeIp: function (id) {
            $('.ipli' + id).remove();
            return false;
        },


        //validate inputs
        validateRegister: function () {
            $('#form-client-register').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },

                fields: {
                    id: {
                        validators: {
                            notEmpty: {},
                            stringLength: {
                                min: 3,
                            }
                        }
                    },
                    name: {
                        validators: {
                            notEmpty: {},
                            stringLength: {
                                min: 3,
                            }
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {},
                            stringLength: {
                                min: 3,
                            }
                        }
                    },
                    urlconfirm: {
                        validators: {
                            notEmpty: {},
                            stringLength: {
                                min: 10,
                            }
                        }
                    },
                    ip: {
                        validators: {
                            notEmpty: {},
                        }
                    },
                    timezone: {
                        validators: {
                            notEmpty: {},
                        }
                    },
                    currency: {
                        validators: {
                            notEmpty: {},
                        }
                    },
                    rol: {
                        validators: {
                            notEmpty: {},
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {},
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {},
                            emailAddress: {}
                        }
                    },
                }
            });

            $("#btn-create").click(function (e) {
                var postData = $('#form-client-register').serialize();
                var formURL = $('#form-client-register').attr("action");

                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData,
                }).done(function (json) {
                    toastr['success'](null, json.message);
                    $('#form-client-register').data('bootstrapValidator').resetForm();
                    $('#form-client-register')[0].reset();
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
        //Table serverSide de detalles de clientes
        initAdvancedSearch: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var route = $('.find-clients-datatable').data('route');
            var table = $('.find-clients-datatable').dataTable({
                "iDisplayLength": 10,
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": route,
                "order": [],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false}
                ],
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                }
            }).on('xhr.dt', function () {
                $('#btn-search').button('reset');
            });

            $('#btn-search').click(function () {
                $(this).button('loading');
                var id = $('#id').val();
                var username = $('#username').val();
                var urlconfirm = $('#urlconfirm').val();
                var currency = $('#currency').val();
                var ip = $('#ip').val();
                var timezone = $('#timezone').val();
                var rol = $('#rol').val();
                var status = $('#status').val();
                var url = route + '?' + $('#form-client-search').serialize();
                table.fnReloadAjax(url);
            });

            $(document).keypress(function (e) {
                if (e.which == 13) {
                    var url = route + '?' + $('#form-user-search').serialize();
                    table.fnReloadAjax(url);
                }
            });


        },

        sendPass: function () {
            $(document).on("click", ".send-mail", function () {
                $(this).button('loading');
                var id = $(this).data('id');
                var name = $(this).data('name');
                var username = $(this).data('username');
                var email = $(this).data('email');
                var route = $(this).data('route');
                var secret = $(this).data('secret');
                var currency = $(this).data('currency');
                var postData = {
                    id: id,
                    name: name,
                    username: username,
                    email: email,
                    secret: secret,
                    currency: currency
                };
                $.ajax({
                    url: route,
                    type: "POST",
                    traditional: true,
                    data: postData,
                }).done(function (json) {
                    toastr['success'](null, json.message);
                }).fail(function (json) {
                    if (json.status == 422) {
                        $.each(json.responseJSON, function (index, val) {
                            toastr['error'](null, val);
                        });
                    } else {
                        toastr['error'](null, json.message);
                    }
                }).always(function () {
                    $(".send-mail").button('reset');
                });
            });
        },


    }//Keys close return
}();//Key close function content


