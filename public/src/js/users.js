/**
 * Created by Carol Mirabal on 11/8/2016.
 */
var Users = function () {
    return {
        // Advanced search
        initAdvancedSearch: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var route = $('.find-users-datatable').data('route');
            var table = $('.find-users-datatable').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": route,
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                }
            }).on('xhr.dt', function () {
                $('#btn-update').button('reset');
            });

            $('#btn-update').click(function () {
                $(this).button('loading');
                var id = $('#id').val();
                var dni = $('#dni').val();
                var name = $('#name').val();
                var lastname = $('#lastname').val();
                var username = $('#username').val();
                var email = $('#email').val();
                var url = route + '?' + $('#form-user-search').serialize();
                table.fnReloadAjax(url);
            });

            $(document).keypress(function (e) {
                if (e.which == 13) {
                    var url = route + '?' + $('#form-user-search').serialize();
                    table.fnReloadAjax(url);
                }
            });


        },
        // Init users table
        initUsersTable: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var route = $('.datatable-usersdatatable').data('route');
            var table = $('.datatable-usersdatatable').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": route,
                "lengthMenu": [[10, 25, 50, 100, 200, 300, 400, 500], [10, 25, 50, 100, 200, 300, 400, 500]],
                "language": {
                    "url": "/src/i18n/datatables/" + lang + ".lang"
                }
            });
        },

        // view from details users
        detailsUsers: function () {
            $.ajax({
                url: $('.details-user').data('route'),
                type: 'post',
                dataType: 'json'
            }).done(function (json) {
                $('.fullname').text(json.name + " " + json.lastname);
                $('.id').text(json.identify);
                $('.dni').text(json.dni).editable({
                    value: json.dni, validate: function (value) {
                        if (value === null || value === '') {
                            return 'El DNI no puede estar vacio';
                        }
                    }
                });
                $('.email').text(json.email).editable({
                    value: json.email, validate: function (value) {
                        if (value === null || value === '') {
                            return 'El Email no puede estar vacio';
                        }
                    }
                });
                $('.username').text(json.username);
                $('.name').text(json.name).editable({
                    value: json.name, validate: function (value) {
                        if (value === null || value === '') {
                            return 'El Nombre no puede estar vacio';
                        }
                    }
                });
                $('.lastname').text(json.lastname).editable({
                    value: json.lastname, validate: function (value) {
                        if (value === null || value === '') {
                            return 'El Apellido no puede estar vacio';
                        }
                    }
                });

            });
        },

        // init table users
        initDataTableUsers: function () {
            var locale = Core.getCookie('localejs');
            var lang = (locale == null || locale == '') ? 'en_GB' : locale;
            var table = $('#transactions').dataTable({
                "order": [],
                "processing": true,
                "serverSide": true,
                "ajax": $('#transactions').data('route'),
                "columnDefs": [
                    {
                        "data": "debit",
                        "className": "text-right"
                    },
                    {
                        "data": "credit",
                        "className": "text-right"
                    },
                ],
            });
        }

    }
}();
