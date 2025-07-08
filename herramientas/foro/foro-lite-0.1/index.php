<?php
require_once 'init.php';

// Cargar mensajes desde SQLite o JSON
$mensajes = [];

if ($modo_sqlite && $conexion) {
    $resultado = $conexion->query("SELECT nombre, mensaje, fecha FROM mensajes ORDER BY fecha DESC");
    $mensajes = $resultado->fetchAll(PDO::FETCH_ASSOC);
} else {
   // $json = file_get_contents('posts.json');
    $json = file_exists('posts.json') ? file_get_contents('posts.json') : '[]';
    $mensajes = json_decode($json, true) ?: [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Foro básico – GAEA/LOGOS</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <h1>Foro abierto – GAEA/LOGOS</h1>

  <form action="guardar.php" method="post">
    <label>Tu nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Mensaje:</label><br>
    <textarea name="mensaje" rows="5" required></textarea><br><br>

    <button type="submit">Publicar</button>
  </form>

  <hr>

  <h2>Mensajes recientes</h2>
  <?php if (!empty($mensajes)): ?>
    <?php foreach ($mensajes as $m): ?>
      <div class="mensaje">
        <p><strong><?= htmlspecialchars($m['nombre']) ?></strong> dijo el <?= date('d/m/Y H:i', strtotime($m['fecha'])) ?>:</p>
        <p><?= nl2br(htmlspecialchars($m['mensaje'])) ?></p>
        <hr>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Aún no hay mensajes.</p>
  <?php endif; ?>
</body>
</html>