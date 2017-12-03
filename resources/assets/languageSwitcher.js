$(document).ready(
    function () {
        $('#languageSwitcher').change(function () {
            var locale = $(this).val();

            var _token = $("input[name=_token]").val();

            $.ajax({
                url: "/language",
                type: "POST",
                date: {
                    locale: locale,
                    _token: _token
                },
                dataType: 'json',
                success: function (data) {

                },
                error: function (data) {

                },
                beforeSend: function () {

                },
                complete: function () {
                    window.location.reload(true);
                }

            });
        })
    }
);