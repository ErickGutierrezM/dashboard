
$(document).ready(function() {
    $('#formRegistoClientes').on('submit', function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
            url: "../auth/register-modal.php",
            type: "POST",
            cache: false,
            data: formdata,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $('#sendCliente').attr('disabled', 'disabled');
            },
            success: function(data) {
                $('#sendCliente').attr('disabled', false);
                if (data.success) {
                    $('#formRegistoClientes')[0].reset();
                    $('#nombreCliente_error').text('');
                    $('#apellidoCliente_error').text('');
                    $('#emailCliente_error').text('');
                    $('#empresaCliente_error').text('');
                    $('#passwordCliente_error').text('');
                    $('#rPasswordCliente_error').text('');
                    alert('Registrado Correctamente!');
                    location.reload();
                } 
                else {
                    $('#nombreCliente_error').text(data.nombreCliente_error);
                    $('#apellidoCliente_error').text(data.apellidoCliente_error);
                    $('#emailCliente_error').text(data.emailCliente_error);
                    $('#empresaCliente_error').text(data.empresaCliente_error);
                    $('#passwordCliente_error').text(data.passwordCliente_error);
                    $('#rPasswordCliente_error').text(data.rPasswordCliente_error);
                }
            }
        });
    });
});