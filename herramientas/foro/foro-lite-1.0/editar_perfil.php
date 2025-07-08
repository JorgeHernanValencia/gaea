<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar perfil</title>
</head>
<body>
  <h2>Editar perfil</h2>
  <form action="enviar_confirmacion_edicion.php" method="post">
    <label>Nombre:
      <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
    </label><br>
    
    <label>Imagen de perfil (URL):
      <input type="url" name="imagen" value="<?= htmlspecialchars($usuario['perfil']) ?>" required>
    </label><br>

    <label>Nueva clave (opcional):
      <input type="password" name="clave">
    </label><br>

    <button type="submit">Enviar solicitud de cambio</button>
  </form>
</body>
</html>