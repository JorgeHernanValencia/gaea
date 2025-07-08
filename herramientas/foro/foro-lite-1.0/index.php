<?php
session_start();
require_once 'init.php';
require_once 'Parsedown.php'; // <-- Aquí cargamos Markdown parser

list($modo_sqlite, $conexion) = obtenerConexion();
$usuarios = file_exists('usuarios.json') ? json_decode(file_get_contents('usuarios.json'), true) : [];

$usuario = null;
if (isset($_SESSION['usuario_id'])) {
    foreach ($usuarios as $u) {
        if ($u['id'] === $_SESSION['usuario_id']) {
            $usuario = $u;
            break;
        }
    }
}

$mensajes = [];
if ($modo_sqlite && $conexion) {
    $res = $conexion->query("SELECT id, usuario_id, nombre, mensaje, fecha, respuesta_a FROM mensajes ORDER BY fecha ASC");
    while ($fila = $res->fetchArray(SQLITE3_ASSOC)) {
        $mensajes[] = $fila;
    }
} else {
    $json = file_exists('posts.json') ? file_get_contents('posts.json') : '[]';
    $mensajes = json_decode($json, true) ?: [];
}

$responder_id = $_GET['responder'] ?? null;
$Parsedown = new Parsedown(); // Creamos instancia del parser
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Foro GAEA/LOGOS</title>
  <link rel="stylesheet" href="estilo.css">
  <style>
    .mensaje {
      margin: 1em 0;
      padding-left: 1em;
      border-left: 2px solid #ccc;
    }
    .mensaje img {
      border-radius: 50%;
      object-fit: cover;
      width: 32px;
      height: 32px;
      margin-right: 0.5em;
    }
    .autor {
      display: flex;
      align-items: center;
      gap: 0.5em;
    }
  </style>
</head>
<body>

<h1>Foro abierto – GAEA/LOGOS</h1>

<?php if ($usuario): ?>
  <div style="margin-bottom: 1em; display: flex; align-items: center;">
 <a href="./perfil.php">   <img src="<?= $usuario['imagen'] ?: 'img/default.png' ?>" width="40" style="border-radius: 50%; margin-right: 0.5em;">
    <strong><?= htmlspecialchars($usuario['nombre']) ?></strong></a>
    <a href="logout.php" style="margin-left: auto; color: #c00;">Cerrar sesión</a>
  </div>
<?php else: ?>
  <div style="margin-bottom: 1em;">
    <a href="login.php" class="btn">Iniciar sesión</a>
    <a href="registro.php" class="btn">Crear cuenta</a>
  </div>
<?php endif; ?>

<hr>
<h2>Mensajes recientes</h2>

<?php
function mostrar_mensajes($mensajes, $usuarios, $padre = null, $nivel = 0, $Parsedown) {
    foreach ($mensajes as $m) {
        if (($m['respuesta_a'] ?? null) == $padre) {
            $foto = 'img/default.png';
            $nombre = htmlspecialchars($m['nombre']);

            foreach ($usuarios as $u) {
                if (isset($m['usuario_id']) && $u['id'] === $m['usuario_id']) {
                    $foto = $u['imagen'] ?: 'img/default.png';
                    $nombre = htmlspecialchars($u['nombre']);
                    break;
                }
            }

            echo '<div class="mensaje" style="margin-left: ' . ($nivel * 2) . 'em;">';
            echo '<div class="autor">';
            echo '<img src="' . htmlspecialchars($foto) . '" alt="Perfil">';
            echo '<strong>' . $nombre . '</strong>';
            echo '<span style="color:#666; font-size:0.9em; margin-left: 1em;">el ' . date('d/m/Y H:i', strtotime($m['fecha'])) . '</span>';
            echo '</div>';
            echo '<div>' . $Parsedown->text($m['mensaje']) . '</div>';
            if (isset($_SESSION['usuario_id'])) {
                echo '<a href="?responder=' . $m['id'] . '">Responder</a>';
            }
            echo '</div>';

            mostrar_mensajes($mensajes, $usuarios, $m['id'], $nivel + 1, $Parsedown);
        }
    }
}

mostrar_mensajes($mensajes, $usuarios, null, 0, $Parsedown);
?>

<?php if ($usuario): ?>
  <hr>
  <h2><?= $responder_id ? 'Responder al comentario' : 'Nuevo comentario' ?></h2>
  <?php if ($responder_id): ?>
    <p><em>Estás respondiendo al mensaje #<?= htmlspecialchars($responder_id) ?>.</em></p>
  <?php endif; ?>

  <form action="guardar.php" method="post">
    <input type="hidden" name="respuesta_a" value="<?= htmlspecialchars($responder_id) ?>">
    <textarea name="mensaje" rows="5" required placeholder="Escribe tu mensaje usando texto o Markdown..."></textarea><br><br>
    <button type="submit">Publicar</button>
  </form>
<?php endif; ?>

</body>
</html>