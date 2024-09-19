<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración del email
    $to = "info@prsl.com.ar";
    $subject = "Nuevo mensaje de contacto";
    
    // Sanitización de los datos del formulario
    $nombre = htmlspecialchars(trim($_POST['imObjectForm_1_1']));
    $telefono = htmlspecialchars(trim($_POST['imObjectForm_1_2']));
    $direccion = htmlspecialchars(trim($_POST['imObjectForm_1_3']));
    $email = filter_var($_POST['imObjectForm_1_4'], FILTER_SANITIZE_EMAIL);
    $consulta = htmlspecialchars(trim($_POST['imObjectForm_1_5']));

    // Validación básica de los campos
    if (!empty($nombre) && !empty($telefono) && !empty($direccion) && !empty($email) && !empty($consulta)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Construir el mensaje del correo
            $message = "Nombre: " . $nombre . "\n";
            $message .= "Teléfono: " . $telefono . "\n";
            $message .= "Dirección: " . $direccion . "\n";
            $message .= "Email: " . $email . "\n";
            $message .= "Consulta: \n" . $consulta . "\n";

            // Encabezados del email (sin Reply-To ni From del remitente)
            $headers = "From: no-reply@prsl.com.ar\r\n";

            // Enviar el correo
            if (mail($to, $subject, $message, $headers)) {
                echo "Gracias por tu consulta, te responderemos pronto.";
            } else {
                echo "Lo sentimos, hubo un error al enviar tu mensaje. Inténtalo más tarde.";
            }
        } else {
            echo "La dirección de email no es válida.";
        }
    } else {
        echo "Por favor completa todos los campos.";
    }
}
?>
