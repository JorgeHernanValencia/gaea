<?php
session_start();
if (isset($_SESSION['usuario']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: perfil.php");
    exit;
}

$usuariosFile = 'usuarios.json';

if (!file_exists($usuariosFile)) {
    // Archivo no existe: mostrar mensaje y enlace
    echo '<p><a href="./registro.php"> Registrar usuario</a></p>';
    exit;
}

$usuarios = json_decode(file_get_contents($usuariosFile), true);

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $clave = trim($_POST['clave']);

    foreach ($usuarios as $usuario) {
        if ($usuario['correo'] === $correo && password_verify($clave, $usuario['clave'])) {
            if (!empty($usuario['verificado'])) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'correo' => $usuario['correo'],
                    'perfil' => $usuario['imagen']
                ];
                $_SESSION['usuario_id'] = $usuario['id'];

                header("Location: ./");
                exit;
            } else {
                $mensaje = "⚠️ Tu cuenta aún no ha sido verificada.";
                break;
            }
        }
    }

    if (!$mensaje) {
        $mensaje = "❌ Correo o clave incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Iniciar sesión – GAEA/LOGOS</title>
</head>
<body>
  <h2>Iniciar sesión</h2>

  <?php if ($mensaje): ?>
    <p style="color:red;"><?= $mensaje ?></p>
  <?php endif; ?>

  <form method="POST">
    <label>Correo:</label><br />
    <input type="email" name="correo" required /><br /><br />

    <label>Clave:</label><br />
    <input type="password" name="clave" required /><br /><br />

    <button type="submit">Entrar</button>
  </form>

  <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
</body>
</html>