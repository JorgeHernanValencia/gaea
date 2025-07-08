<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$nombre = $_POST['nombre'];
$imagen = $_POST['imagen'];
$clave = $_POST['clave'];
$usuario = $_SESSION['usuario'];

$datos = [
    'id' => $usuario['id'],
    'nombre' => $nombre,
    'imagen' => $imagen,
];

if (!empty($clave)) {
    $datos['clave'] = password_hash($clave, PASSWORD_DEFAULT);
}

// Codificar los datos para URL
$datos_str = json_encode($datos);
$datos_codificados = urlencode(base64_encode($datos_str));

$enlace = "https://gaea.fadcoad.com/herramientas/foro/foro-lite-1.0/confirmar_edicion.php?data=$datos_codificados";

// Enviar correo
$para = $usuario['correo'];
$asunto = "Confirmación de cambios en tu perfil";
$mensaje = "Hola {$usuario['nombre']},\n\nHaz clic en el siguiente enlace para confirmar los cambios en tu perfil:\n\n$enlace";
$encabezados = "From: no-reply@tudominio.com";

mail($para, $asunto, $mensaje, $encabezados);

echo "✅ Se ha enviado un correo de confirmación a tu cuenta.";