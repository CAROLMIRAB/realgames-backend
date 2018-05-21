var Reports = function () {

    // Put the value into the input
    var formatRepoSelection = function (repo) {
        return repo.username;
        console.log(repo.text);
    };

    // Format result
    var formatUsersResult = function (json) {

        if (json.loading) {
            return json.text;
        }

        var markup = '<div class="clearfix">' +
            '<div class="col-sm-2">' + json.username + '</div>' +
            '<div class="col-sm-10">' + json.name + ' ' + json.lastname + '</div>' +
            '</div>';

        markup += '</div></div>';
        return markup;
    };

    return {
        // Init profit
        initProfitReports: function () {
            $('#btn-update').click(function () {
                $(this).button('loading');
                var postData = $('#credit-transactions-form').serialize();
                var formURL = $('#credit-transactions-form').attr("action");
                $.ajax({
                    url: formURL,
                    type: 'post',
                    dataType: 'json',
                    data: postData
                }).done(function (data) {
                    if (data.status == 'SUCCESS') {
                        $('#purchase').html(data.data.purchase);
                        $('#won').html(data.data.won);
                        $('#profit').html(data.data.profit);
                    } else {
                        $('#purchase').html(data.message);
                        $('#won').html(data.message);
                        $('#profit').html(data.message);
                    }
                }).fail(function () {
                    $('#purchase').html('Cargando...');
                    $('#won').html('Cargando...');
                    $('#profit').html('Cargando...');
                }).always(function () {
                    $('#btn-update').button('reset');
                })
            })

        },

        //Table Profit Games by Provider
        initProfitUsersProvider: function () {

            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var user = $('#user').val();
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('.find-userprovider-datatable').data('route');
            var table = $('.find-userprovider-datatable').dataTable({
                "iDisplayLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": route + '?startDate=' + start_date + '&endDate=' + end_date + '&user=' + user,
                "order": [],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false}
                ],
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                },
            }).on('xhr.dt', function () {
                $("#btn-update").button('reset');
            });

            $("#btn-update").click(function () {
                $(this).button('loading');
                var user = $('#user').val();
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var url = route + '?startDate=' + start_date + '&endDate=' + end_date + '&user=' + user;
                $.getJSON(url, function (data) {
                    if (data.status == 'FAILED') {
                        toastr.warning(data.message);
                    } else {
                        table.fnReloadAjax(url);
                        $('.result').removeClass('hidden');
                    }
                })


            });
        },

        // Init users search
        initUsersSearch: function () {
            var $userSearch = $('#user');
            $userSearch.select2({
                ajax: {
                    url: $userSearch.data('route'),
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            username: params
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 3,
                templateResult: formatUsersResult,
                templateSelection: formatRepoSelection
            });
        },
        //Table Profit Games by Provider
        initGameSearch: function () {

            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var provider = $('#provider').val();
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('.find-game-datatable').data('route');
            var table = $('.find-game-datatable').dataTable({
                "iDisplayLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": route + '?startDate=' + start_date + '&endDate=' + end_date + '&provider=' + provider,
                "order": [],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false}
                ],
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                },
            }).on('xhr.dt', function () {
                $("#btn-update").button('reset');
            });

            $("#btn-update").click(function () {
                $(this).button('loading');

                var provider = $('#provider').val();
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var url = route + '?startDate=' + start_date + '&endDate=' + end_date + '&provider=' + provider;
                table.fnReloadAjax(url);
                $('.result').removeClass('hidden');
            });
        },

        // Advanced search
        initTransactionAdvancedSearch: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var dateFrom = $('#start-date').val();
            var dateAt = $('#end-date').val();
            var route = $('.find-transaction-datatable').data('route');
            var table = $('.find-transaction-datatable').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": route + '?startDate=' + dateFrom + '&endDate=' + dateAt,
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                }
            }).on('xhr.dt', function () {
                $('#btn-update').button('reset');
            });

            $('#btn-update').click(function () {

                $(this).button('loading');
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var idtransaction = $('#idtransaction').val();
                var username = $('#username').val();
                var idgame = $('#idgame').val();
                var gamename = $('#gamename').val();
                var url = route + '?' + $('#form-transaction-search').serialize() + '&startDate=' + start_date + '&endDate=' + end_date;
                table.fnReloadAjax(url);
            });

            $(document).keypress(function (e) {
                if (e.which == 13) {
                    var url = route + '?' + $('#form-transaction-search').serialize() + '&startDate=' + start_date + '&endDate=' + end_date;
                    table.fnReloadAjax(url);
                }
            });
        },


        profitByProvider: function () {
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('.providers').data('route');
            $.ajax({
                url: route + '?startDate=' + start_date + '&endDate=' + end_date,
                dataType: 'json'
            }).done(function (data) {
                $.each(data, function (i, val) {
                    $(val.profit).hide().appendTo('.providers').fadeIn();
                });
            }).fail(function () {

            });
        },

        totalProfitByProvider: function () {
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('.total').data("route");
            $.ajax({
                url: route + '?startDate=' + start_date + '&endDate=' + end_date,
                type: 'get',
                dataType: 'json',
            }).done(function (data) {
                if (data.status == 'SUCCESS') {
                    $('#purchase').html(data.data.purchase);
                    $('#won').html(data.data.won);
                    $('#profit').html(data.data.profit);
                } else {
                    $('#purchase').html(data.message);
                    $('#won').html(data.message);
                    $('#profit').html(data.message);
                }
            }).fail(function () {
            }).always(function () {
                $('#btn-update').button('reset');
            });
        },

        updateProviders: function () {
            $('#btn-update').click(function (event) {
                $(this).button('loading');
                $('.loader').removeClass("hidden");
                $('.providers').empty();

                Reports.profitByProvider();
                Reports.totalProfitByProvider();

                $('.loader').addClass("hidden");
            });
        },

        spinData: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('#spinbygame').data('route');
            var table = $('#spinbygame').dataTable({
                "iDisplayLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": route + '?startDate=' + start_date + '&endDate=' + end_date,
                "order": [],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false},
                    {data: "spin", sClass: "center-text"}
                ],
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                },
            }).on('xhr.dt', function () {
                $("#btn-update").button('reset');
            });

            $("#btn-update").click(function () {
                $(this).button('loading');
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var url = route + '?startDate=' + start_date + '&endDate=' + end_date;
                Reports.firstThreeSpin();
                table.fnReloadAjax(url);
            });
        },

        firstThreeSpin: function () {
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('.first-three').data("route");
            $.ajax({
                url: route + '?startDate=' + start_date + '&endDate=' + end_date,
                type: 'get',
                dataType: 'json',
            }).done(function (data) {
                $.each(data, function (i, val) {
                    switch (val.position) {
                        case 1:
                            $('.first').html(val.game);
                            break;
                        case 2:
                            $('.second').html(val.game);
                            break;
                        case 3:
                            $('.third').html(val.game);
                            break;
                    }
                });
            }).fail(function () {
            });

        },

        findProvider: function () {
            var route = $('#provider').data('route');
            $.ajax({
                url: route,
                dataType: 'json'
            }).done(function (data) {
                $.each(data, function (i, val) {
                    $('.providers').append(val.provider);
                });
            }).fail(function () {
            });

        },

        dataTableProfitUsers: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'es_ES' : locale;
            var route = $('.client-datatable').data('route');
            var url = route + '?startDate=' + '' + '&endDate=' + '';
            var table = $('.client-datatable').dataTable({
                "iDisplayLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": url,
                "order": [3, 'desc'],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false},
                    {
                        "targets": [0],
                        "render": function (data, type, full) {
                            return full[0];
                        }
                    },
                    {
                        "targets": [1],
                        "data": "deposit",
                        "className": "text-right",
                        "render": function (data, type, full) {
                            var number = $.number(full[1], 2, '.', ',');
                            return number;
                        }
                    },
                    {
                        "targets": [2],
                        "data": "withdrawal",
                        "className": "text-right",
                        "render": function (data, type, full) {
                            var number = $.number(full[2], 2, '.', ',');
                            return number;
                        }
                    },

                    {
                        "targets": [3],
                        "data": "profit",
                        "className": "text-right",
                        "render": function (data, type, full) {
                            var number = $.number(full[3], 2, '.', ',');
                            return number;
                        }
                    },
                    {
                        "targets": [4],
                        "visible": false
                    },
                    {
                        "targets": [5],
                        "visible": false
                    },
                    {
                        "targets": [6],
                        "visible": false
                    }
                ],
                "language": {
                    "url": "/i18n/datatables/" + lang + ".lang"
                },
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "dom": 'B<"clear">lfrtip',
                "buttons": [
                    'print',
                    {
                        "extend": "collection",
                        "text": "Save",
                        "buttons": ['pdfHtml5', 'csvHtml5', 'excelHtml5']
                    }
                ]
            }).on('xhr.dt', function () {
                $("#btn-update").button('reset');
            });

            $("#btn-update").click(function () {
                $(this).button('loading');
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var url = route + '?startDate=' + start_date + '&endDate=' + end_date;
                table.fnReloadAjax(url);
                Reports.profitTotalsUsers();
            });

        },

        profitTotalsUsers: function () {
            var URL = $('.totals-profit').data("route");
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            $.ajax({
                url: URL,
                type: 'post',
                dataType: 'json',
                data: {
                    startDate: start_date,
                    endDate: end_date
                }
            }).done(function (data) {
                $('#purchase').html(data.data.purchase);
                $('#won').html(data.data.won);
                $('#profit').html(data.data.profit);
            }).fail(function () {
                $('#purchase').html('Cargando...');
                $('#won').html('Cargando...');
                $('#profit').html('Cargando...');
            })
        },

        dataTableProfitClients: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'es_ES' : locale;
            var route = $('.client-datatable').data('route');
            var url = route + '?startDate=' + '' + '&endDate=' + '';
            var table = $('.client-datatable').dataTable({
                "iDisplayLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": url,
                "order": [4, 'desc'],
                "columnDefs": [
                    {targets: 'no-sort', orderable: false},
                    {
                        "targets": [0],
                        "render": function (data, type, full) {
                            return full[0];
                        }
                    },
                    {
                        "targets": [1],
                        "data": "deposit",
                        "className": "text-right",
                        "render": function (data, type, full) {
                            var number = $.number(full[1], 2, '.', ',');
                            return number;
                        }
                    },
                    {
                        "targets": [2],
                        "data": "withdrawal",
                        "className": "text-right",
                        "render": function (data, type, full) {
                            var number = $.number(full[2], 2, '.', ',');
                            return number;
                        }
                    },

                    {
                        "targets": [3],
                        "data": "profit",
                        "className": "text-right",
                        "render": function (data, type, full) {
                            var number = $.number(full[3], 2, '.', ',');
                            return number;
                        }
                    },
                    {
                        "targets": [4],
                        "visible": false
                    },
                    {
                        "targets": [5],
                        "visible": false
                    },
                    {
                        "targets": [6],
                        "visible": false
                    }
                ],
                "language": {
                    "url": "/i18n/datatables/" + lang + ".lang"
                },
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "dom": 'B<"clear">lfrtip',
                "buttons": [
                    'print',
                    {
                        "extend": "collection",
                        "text": "Save",
                        "buttons": ['pdfHtml5', 'csvHtml5', 'excelHtml5']
                    }
                ]
            }).on('xhr.dt', function () {
                $("#btn-update").button('reset');
            });

            $("#btn-update").click(function () {
                $(this).button('loading');
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var url = route + '?startDate=' + start_date + '&endDate=' + end_date;
                table.fnReloadAjax(url);
                Reports.profitTotalsClient();
            });

        },

        profitTotalsClient: function () {
            var URL = $('.totals-profit').data("route");
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            $.ajax({
                url: URL,
                type: 'post',
                dataType: 'json',
                data: {
                    startDate: start_date,
                    endDate: end_date
                }
            }).done(function (data) {
                $('#purchase').html(data.data.purchase);
                $('#won').html(data.data.won);
                $('#profit').html(data.data.profit);
            }).fail(function () {
                $('#purchase').html('Cargando...');
                $('#won').html('Cargando...');
                $('#profit').html('Cargando...');
            })
        },
    }
}();