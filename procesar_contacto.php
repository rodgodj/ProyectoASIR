<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    // Para evitar ataque de inyección de codigo utilizamos htmlspecialchars
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Dirección de destino (tu correo electrónico)
    $destinatario = "rogojiesma16@gmail.com"; // Cambia esto por tu correo
    $asunto = "Nuevo mensaje de contacto de $nombre";

    // Cuerpo del correo
    $cuerpo = "Nombre: $nombre\nCorreo: $email\n\nMensaje:\n$mensaje";

    // Cabeceras del correo
    $cabeceras = "From: $email\r\n";
    $cabeceras .= "Reply-To: $email\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar el correo
    if (mail($destinatario, $asunto, $cuerpo, $cabeceras)) {
        echo "¡Gracias por contactarnos! Te responderemos lo antes posible.";
    } else {
        echo "Hubo un error al enviar el mensaje. Intenta nuevamente.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
