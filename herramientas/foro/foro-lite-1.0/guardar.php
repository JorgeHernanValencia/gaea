<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("Acceso denegado. Debes iniciar sesión para publicar.");
}

$usuarios = json_decode(file_get_contents('usuarios.json'), true);
$usuario_actual = null;

foreach ($usuarios as $u) {
    if ($u['id'] === $_SESSION['usuario_id']) {
        $usuario_actual = $u;
        break;
    }
}

if (!$usuario_actual) {
    die("Usuario no encontrado.");
}

require_once 'init.php';
list($modo_sqlite, $conexion) = obtenerConexion();

$mensaje = trim($_POST['mensaje'] ?? '');
$respuesta_a = trim($_POST['respuesta_a'] ?? null);

if ($mensaje === '') {
    die("El mensaje no puede estar vacío.");
}

$nuevo = [
    'id' => uniqid("msg_"),
    'usuario_id' => $usuario_actual['id'],
    'nombre' => $usuario_actual['nombre'],
    'mensaje' => $mensaje, // guardamos texto plano
    'fecha' => date("Y-m-d H:i:s"),
    'respuesta_a' => $respuesta_a ?: null
];

if ($modo_sqlite && $conexion) {
    $stmt = $conexion->prepare("
        INSERT INTO mensajes (id, usuario_id, nombre, mensaje, fecha, respuesta_a)
        VALUES (:id, :usuario_id, :nombre, :mensaje, :fecha, :respuesta_a)
    ");
    $stmt->bindValue(':id', $nuevo['id']);
    $stmt->bindValue(':usuario_id', $nuevo['usuario_id']);
    $stmt->bindValue(':nombre', $nuevo['nombre']);
    $stmt->bindValue(':mensaje', $nuevo['mensaje']);
    $stmt->bindValue(':fecha', $nuevo['fecha']);
    $stmt->bindValue(':respuesta_a', $nuevo['respuesta_a']);
    $stmt->execute();
} else {
    $archivo = 'posts.json';
    $datos = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
    $datos[] = $nuevo;
    file_put_contents($archivo, json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

header("Location: index.php");
exit;