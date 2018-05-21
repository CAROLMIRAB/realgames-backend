var Core = function () {
    return {
        activateMenu: function () {
            var url = window.location.href;
            var $item = $('.sidebar-menu a[href="' + url + '"]');
            $item.parents('li').addClass('active');
        },

        language: function () {
            var route = $('.core-language').data('route');
            $.ajax({
                url: route,
                dataType: 'json'
            }).done(function (data) {

                $('.language-items').html(data.language);
                $('.top-language').replaceWith(data.active);
            });

            $(document).on('click', '.li-language', function () {
                var lang = $(this).data('lang');
                 Core.setCookie('localejs', lang, 365);

            });
        },
        //example:setCookie("volume", 'play', 365);
        setCookie: function (cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        },

        //example:getCookie("volume")
        getCookie: function (cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }


    }
}();