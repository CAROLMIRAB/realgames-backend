var Login;
Login = function () {
    return {
        loginMessage: function () {

            $("#form-login").on("submit", function (e) {
                var postData = $(this).serialize();
                var formURL = $(this).attr("action");
                $.ajax({
                    url: formURL,
                    type: "POST",
                    data: postData
                }).done(function (text) {
                    if(text.status == '200'){
                        $('#btn-enter').button('loading');
                        $(location).attr('href','/');
                    }else {
                        $('.alert-login').removeClass('hidden').fadeIn(1000);
                        $('.message-login').text(text.message);
                        $('.alert-login').fadeOut(10000);
                    }
                })
                return false;
            });

        }
    }

}();