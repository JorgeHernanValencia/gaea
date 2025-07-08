<?php
$usuariosFile = 'usuarios.json';

if (!file_exists($usuariosFile)) {
    file_put_contents($usuariosFile, json_encode([]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $clave = trim($_POST['clave']);
    $imagen = trim($_POST['imagen']);
    $id = uniqid('usr_');

    $usuarios = json_decode(file_get_contents($usuariosFile), true);

    // Verificar si el nombre de usuario ya existe
    foreach ($usuarios as $usuario) {
        if ($usuario['nombre'] === $nombre) {
            echo "<p>El nombre de usuario ya está en uso.</p>";
            exit;
        }
    }

    // Generar código de verificación
    $codigo = rand(100000, 999999);

    // Guardar usuario pendiente de verificación
    $usuarios[] = [
        'id' => $id,
        'nombre' => $nombre,
        'correo' => $correo,
        'clave' => password_hash($clave, PASSWORD_DEFAULT),
        'imagen' => $imagen,
        'verificado' => false,
        'codigo' => $codigo
    ];

    file_put_contents($usuariosFile, json_encode($usuarios, JSON_PRETTY_PRINT));

    // Enviar correo real
    $asunto = "Código de verificación - Foro GAEA-LOGOS";
    $mensaje = "Hola $nombre,\n\nTu código de verificación es: $codigo\n\nGracias por registrarte.";
    $cabeceras = "From: jorge.valencia@fad.com\r\n";
    $cabeceras .= "Reply-To: no-reply@fad.com\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    if (mail($correo, $asunto, $mensaje, $cabeceras)) {
        header("Location: verificar.php?correo=" . urlencode($correo));
        exit;
    } else {
        echo "<p>Error al enviar el correo. Intenta más tarde o contacta con soporte.</p>";
    }
}
?>

<h2>Registro de usuario</h2>
<form method="POST">
  <label>Nombre de usuario:</label><br />
  <input type="text" name="nombre" required /><br /><br />

  <label>Correo electrónico:</label><br />
  <input type="email" name="correo" required /><br /><br />

  <label>Contraseña:</label><br />
  <input type="password" name="clave" required /><br /><br />

  <label>URL de imagen de perfil (opcional):</label><br />
  <input type="url" name="imagen" /><br /><br />

  <button type="submit">Registrarse</button>
    
</form>
    
    <p>¿Ya tienes cuenta? <a href="login.php">Ingresa</a></p>