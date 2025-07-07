<?php
require_once 'init.php';

$nombre = trim($_POST['nombre'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if ($nombre && $mensaje) {
    $fecha = date('Y-m-d H:i:s');

    if ($modo_sqlite && $conexion) {
        $stmt = $conexion->prepare("INSERT INTO mensajes (nombre, mensaje, fecha) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $mensaje, $fecha]);
    } else {
        $posts = [];
        if (file_exists('posts.json')) {
            $posts = json_decode(file_get_contents('posts.json'), true) ?: [];
        }
        array_unshift($posts, [
            'nombre' => $nombre,
            'mensaje' => $mensaje,
            'fecha' => $fecha
        ]);
        file_put_contents('posts.json', json_encode($posts, JSON_PRETTY_PRINT));
    }
}

header('Location: index.php');
exit;