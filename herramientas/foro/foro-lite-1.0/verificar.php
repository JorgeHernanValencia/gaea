<?php
$usuariosFile = 'usuarios.json';

if (!file_exists($usuariosFile)) {
    echo "<p>Error: No hay usuarios registrados.</p>";
    echo '<p><a href="registro.php"> Registrar</a></p>';
    exit;
}

$usuarios = json_decode(file_get_contents($usuariosFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo']);
    $codigoIngresado = trim($_POST['codigo']);

    $actualizado = false;

    foreach ($usuarios as &$usuario) {
        if ($usuario['correo'] === $correo && !$usuario['verificado']) {
            if ($usuario['codigo'] == $codigoIngresado) {
                $usuario['verificado'] = true;
                unset($usuario['codigo']); // Eliminar código una vez verificado
                $actualizado = true;
                break;
            }
        }
    }

    if ($actualizado) {
        file_put_contents($usuariosFile, json_encode($usuarios, JSON_PRETTY_PRINT));
        echo "<p>✅ Tu cuenta ha sido verificada correctamente. Ahora puedes iniciar sesión.</p>";
    echo '<p><a href="login.php"> Ingresar</a></p>';
    } else {
        echo "<p>❌ El código es incorrecto o la cuenta ya fue verificada.</p>";
        echo '<p>Intenya de nuevo o intenta<a href="login.php"> Ingresar</a></p>';
    }
}
?>

<h2>Verificar cuenta</h2>
<form method="POST">
  <label>Correo electrónico:</label><br />
  <input type="email" name="correo" required value="<?= htmlspecialchars($_GET['correo'] ?? '') ?>" /><br /><br />

  <label>Código de verificación:</label><br />
  <input type="text" name="codigo" required /><br /><br />

  <button type="submit">Verificar</button>
</form>