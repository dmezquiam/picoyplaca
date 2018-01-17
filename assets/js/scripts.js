$(function () {

    // init the validator
    // validator files are included in the download package
    // otherwise download from http://1000hz.github.io/bootstrap-validator

    $('#picoplaca-form').validator();

    // Cuando se envie el formulario.
    $('#picoplaca-form').on('submit', function (e) {

        // Si el validador no impide el envío del formulario.
        if (!e.isDefaultPrevented()) {
            var url = "Controller.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),

                // data = Al objeto JSON que devuelve Controller.php.
                success: function (data) {

                    // Guardar el tipo de mensaje enviado desde el backend, success o danger.
                    var messageAlert = 'alert-' + data.type;

                    // Guardar el mensaje
                    var messageText = data.message;

                    // Mensaje de alerta a mostrar en el frontend.
                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

                    // Si todos los datos existen
                    if (messageAlert && messageText) {
                        // Mostrar el div con clase .messages para mostrar el mensaje
                        $('#picoplaca-form').find('.messages').html(alertBox);
                        // Resetear valores de los campos
                        //$('#picoplaca-form')[0].reset();
                    }
                }
            });
            return false;
        }
    })
});
