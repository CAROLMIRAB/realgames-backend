var Dashboard = function () {
    return {
        /**load data dashboard resume */
        loadData: function () {
            $.ajax({
                url: $('.transaction-resume').data('route'),
                type: 'post',
                dataType: 'json'
            }).done(function (json) {
                var decimal = parseInt(json[0].decimals);
                var velocity = parseInt(2000);
                var decimalSep = json[0].decimalseparator;
                var thousandSep = json[0].thousands;
                var symbol = json[0].symbol;
                var decimal_places = decimal;
                var decimal_factor = decimal_places === 0 ? 1 : decimal_places * 10;
                /*    if (json[0].played != null) {*/
                $('.number-user').animateNumber({number: json[0].totalusers}, velocity);
                $('.played-day').animateNumber({
                    number: json[0].played * decimal_factor,
                    numberStep: function (now, tween) {
                        var floored_number = Math.floor(now) / decimal_factor,
                            target = $(tween.elem);
                        if (decimal_places > 0) {
                            floored_number = floored_number.toFixed(decimal);
                            floored_number = floored_number.toString().replace('.', decimalSep);
                        }
                        target.text(symbol + " " + floored_number);
                    }
                }, velocity);

                $('.won-day').animateNumber({
                    number: json[0].won * decimal_factor,
                    numberStep: function (now, tween) {
                        var floored_number = Math.floor(now) / decimal_factor,
                            target = $(tween.elem);
                        if (decimal_places > 0) {
                            floored_number = floored_number.toFixed(decimal);
                            floored_number = floored_number.toString().replace('.', decimalSep);
                        }
                        target.text(symbol + " " + floored_number);
                    }
                }, velocity);

                $('.profit').animateNumber({
                    number: json[0].profit * decimal_factor,
                    numberStep: function (now, tween) {
                        var floored_number = Math.floor(now) / decimal_factor,
                            target = $(tween.elem);
                        if (decimal_places > 0) {
                            floored_number = floored_number.toFixed(decimal);
                            floored_number = floored_number.toString().replace('.', decimalSep);
                        }
                        target.text(symbol + " " + floored_number);
                    }
                }, velocity);

                setTimeout(function () {
                    $(".played-day").replaceWith("<span class='played-day info-box-number'>" + symbol + " " + $.number(json[0].played, decimal, decimalSep, thousandSep) + "</span>");
                    $(".won-day").replaceWith("<span class='won-day info-box-number'>" + symbol + " " + $.number(json[0].won, decimal, decimalSep, thousandSep) + "</span>");
                    $(".profit").replaceWith("<span class='profit info-box-number'>" + symbol + " " + $.number(json[0].profit, decimal, decimalSep, thousandSep) + "</span>");
                }, velocity);

                var percent_profit = (json[1].percent_profit > 100) ? 100 : json[1].percent_profit;
                var percent_won = (json[1].percent_won > 100) ? 100 : json[1].percent_won;
                var percent_played = (json[1].percent_played > 100) ? 100 : json[1].percent_played;

                $(".p-profit").css('width', percent_profit + '%');
                $(".p-played").css('width', percent_played + '%');
                $(".p-won").css('width', percent_won + '%');

                $('.percent-profit').text(Math.round(json[1].percent_profit) + '%');
                $('.percent-played').text(Math.round(json[1].percent_played) + '%');
                $('.percent-won').text(Math.round(json[1].percent_won) + '%');

                ;

            });
        },


        /**init chart dashboard clients*/
        drawChart: function () {

            var jsonData = $.ajax({
                url: $('.transactionsdata').data('route'),
                dataType: 'json',
            }).done(function (json) {
                var labels = [], dataA = [], dataB = [], dataC = [], decimal = 0, decimalSep = "", thousandSep = "", won = "", week = "", total = "";
                played = "", profit = "";
                won = json.won;
                played = json.played;
                profit = json.profit;
                week = json.week;
                total = json.total;
                $.each(json.data, function (i, val) {
                    labels.push(val.y);
                    dataA.push(val.a);
                    dataB.push(val.b);
                    dataC.push(val.c);
                    decimal = parseInt(val.decimals);
                    decimalSep = val.decimalSep;
                    thousandSep = val.thousandSep;
                });

                var config = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: played,
                                backgroundColor: "rgb(0, 166, 90)",
                                data: dataA
                            },
                            {
                                label: won,
                                backgroundColor: "rgb(221, 75, 57)",
                                data: dataB
                            },
                            {
                                label: profit,
                                backgroundColor: "rgb(0, 192, 239)",
                                data: dataC
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function (value, index, values) {
                                        return value.formatMoney(decimal, decimalSep, thousandSep);

                                    }
                                }
                            }],
                        },

                        tooltips: {
                            enabled: true,
                            mode: 'single',
                            callbacks: {
                                title: function (tooltipItem, data) {
                                    return week + " " + data.labels[tooltipItem[0].index];
                                },
                                label: function (tooltipItems, data) {
                                    return total + " " + tooltipItems.yLabel.formatMoney(decimal, decimalSep, thousandSep);
                                },
                            },
                        }
                    }
                };

                var $button = $('#btn-search').click(function () {
                    $button.button('loading');
                    var route = $('.transactionsdata').data('route');
                    var url = route + '?' + $('#form-mes').serialize();
                    var jsonData = $.ajax({
                        url: url,
                        dataType: 'json',
                    }).done(function (json) {
                        var labels = [], dataA = [], dataB = [], dataC = [], won = "", played = "", profit = "";
                        won = json.won;
                        played = json.played;
                        profit = json.profit;
                        $.each(json.data, function (i, val) {
                            labels.push(val.y);
                            dataA.push(val.a);
                            dataB.push(val.b);
                            dataC.push(val.c);
                        });
                        if (labels == "" && dataA == "" && dataB == "" && dataC == "") {
                            config.data = {
                                labels: labels,
                                datasets: [{label: "", data: dataA}, {label: "", data: dataB},
                                    {label: "", data: dataC}]
                            }
                            $('.no-data').removeClass('hidden');
                        } else {
                            $('.no-data').addClass('hidden');
                            config.data = {
                                labels: labels,
                                datasets: [
                                    {
                                        label: played,
                                        backgroundColor: "rgb(0, 166, 90)",
                                        data: dataA
                                    },
                                    {
                                        label: won,
                                        backgroundColor: "rgb(221, 75, 57)",
                                        data: dataB
                                    },
                                    {
                                        label: profit,
                                        backgroundColor: "rgb(0, 192, 239)",
                                        data: dataC
                                    }
                                ]
                            };
                        }
                        window.chartBar.update();

                    }).always(function () {
                        $button.button('reset');
                    });
                });

                var ctx = document.getElementById("barChart").getContext("2d");
                window.chartBar = new Chart(ctx, config);
                window.chartBar.render();

            });
        }
        ,


        /** latest transactions client dashboard */
        transactionsViewer: function () {
            $("#content-1").mCustomScrollbar({
                axis: "y",
                advanced: {autoUpdateTimeout: 1000},

            });

            $.ajax({
                url: $('.direct-chat-primary').data('route'),
                dataType: 'json',
            }).done(function (json) {
                $.each(json, function (i, val) {
                    if (val.transactiontype == 2) {
                        $(".list").append("<li class='direct-chat-msg'><div class='direct-chat-msg'><div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-left'>" + val.name + " " + val.lastname + "</span> <span class='direct-chat-timestamp pull-right'>" + val.created_at + "</span> </div><i class='fa fa-cubes direct-chat-img backplayed'></i> <div class='direct-chat-text backplayed'><p><b>" + val.txtbet + "</b></p><b>" + val.amount + "</b></div></div></li>");
                    }
                    if (val.transactiontype == 1) {
                        $(".list").append("<li class='direct-chat-msg'><div class='direct-chat-msg'><div class='direct-chat-info clearfix'> <span class='direct-chat-name pull-left'>" + val.name + " " + val.lastname + "</span> <span class='direct-chat-timestamp pull-right'>" + val.created_at + "</span> </div><i class='ion ion-ribbon-b direct-chat-img backwon'></i> <div class='direct-chat-text backwon'><p><b>" + val.txtwon + "</b></p><b>" + val.amount + "</b></div></div></li>");
                    }
                });

            });
        }
        ,

        /**init chart dashboard */
        drawChartAdmin: function () {
            var jsonData = $.ajax({
                url: $('.transactionsdata').data('route'),
                dataType: 'json',
            }).done(function (json) {
                var labels = [], dataA = [], dataB = [], dataC = [], decimal = 0, decimalSep = "", thousandSep = "", won = "", played = "", profit = "";
                won = json.won;
                played = json.played;
                profit = json.profit;
                $.each(json.data, function (i, val) {
                    labels.push(val.y);
                    dataA.push(val.a);
                    dataB.push(val.b);
                    dataC.push(val.c);
                    decimal = parseInt(val.decimals);
                    decimalSep = val.decimalSep;
                    thousandSep = val.thousandSep;
                });

                var config = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: played,
                                backgroundColor: "rgb(0, 166, 90)",
                                data: dataA
                            },
                            {
                                label: won,
                                backgroundColor: "rgb(221, 75, 57)",
                                data: dataB
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function (value, index, values) {
                                        return value.formatMoney(decimal, decimalSep, thousandSep);

                                    }
                                }
                            }],
                        },

                        tooltips: {
                            enabled: true,
                            mode: 'single',
                            callbacks: {
                                title: function (tooltipItem, data) {
                                    return "Cliente " + data.labels[tooltipItem[0].index];
                                },
                                label: function (tooltipItems, data) {
                                    return "Total: " + tooltipItems.yLabel.formatMoney(decimal, decimalSep, thousandSep);
                                },
                            },
                        }
                    }

                };

                var ctx = document.getElementById("barChart").getContext("2d");
                window.chartBarAd = new Chart(ctx, config);
            });

        },

        datePicker: function () {
            var year = moment().format('YYYY');
            var dateInit = moment().subtract(7, 'days');
            $('#date-range').daterangepicker({
                    opens: 'left',
                    startDate: dateInit,
                    maxDate: moment(),
                    dateLimit: {
                        month: 1,
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Últimos 7 Días': [moment().subtract(6, 'days'), moment()],
                        'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    buttonClasses: ['btn btn-sm'],
                    applyClass: ' blue',
                    cancelClass: 'default',
                    format: 'DD/MM/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Aceptar',
                        cancelLabel: 'Cancelar',
                        fromLabel: 'Desde',
                        toLabel: 'Hasta',
                        customRangeLabel: 'Rango Personalizado',
                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        firstDay: 1
                    }
                },

                function (start, end) {
                    $('#date-range span').html('Ultimas 4 semanas');
                }
            );


            $('#date-range span').html(dateInit.locale('es').format('MMMM D, YYYY') + ' - ' + moment().locale('es').format('MMMM D, YYYY'));
            $('#start-date').val(dateInit.format('YYYY-MM-DD'));
            $('#end-date').val(moment().format('YYYY-MM-DD'));

            // Set the selected date in hidden files
            $('#date-range').on('apply.daterangepicker', function (ev, picker) {
                $('#start-date').val(picker.startDate.format('YYYY-MM-DD'));
                $('#end-date').val(picker.endDate.format('YYYY-MM-DD'));
            });
        },

        sortableResume: function () {
            var ordering = Core.getCookie('orderResume');
            var order;
            var el = $('.transaction-resume');
            var map = {};
            order = (ordering != "" || ordering == null) ? ordering : [1, 2, 3, 4];
            $(".transaction-resume").sortable({
                placeholder: 'col placeholder tile',
                items: ".col",
                tolerance: 'pointer',
                grid: [4, 1],
                update: function () {
                    var ordenElementos = $(".transaction-resume").sortable("toArray").toString();
                    Dashboard.setCookie("orderResume", ordenElementos, 365);
                }
            });


            $('.transaction-resume div').each(function () {
                var el = $(this);
                map[el.attr('n')] = el;
            });

            for (var i = 0, l = order.length; i < l; i++) {
                if (map[order[i]]) {
                    el.append(map[order[i]]);
                }
            }
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

        topPlayers: function () {
            var start_date = $('#start-date').val();
            var end_date = $('#end-date').val();
            var route = $('.box-top-players').data("route");
            $.ajax({
                url: route + '?startDate=' + start_date + '&endDate=' + end_date,
                type: 'get',
                dataType: 'json',
            }).done(function (data) {
                $('#top-players').html(data.top);
            }).fail(function () {
                $('#top-players').html("No se encontró data");
            });
        },

        favoritesGames: function () {
            $(document).on("click", ".tabs", function () {
                var start_date = $('#start-date').val();
                var end_date = $('#end-date').val();
                var user = $(this).data("id");
                var tab = "#" + $(this).data("tab");
                var route = $('.tabs-games').data("route");
                $.ajax({
                    url: route + '?startDate=' + start_date + '&endDate=' + end_date + '&user=' + user,
                    type: 'get',
                    dataType: 'json',
                }).done(function (data) {
                    $(tab).html(data.table);
                    console.log(tab);
                }).fail(function () {
                    $(tab).html("No se encontró data");
                });
            });
        },

    }//Keys close return
}();//Key close function content