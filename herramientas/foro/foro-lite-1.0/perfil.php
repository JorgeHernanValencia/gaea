<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<h2>Bienvenido, <?= htmlspecialchars($usuario['nombre']) ?></h2>
<p>Correo: <?= htmlspecialchars($usuario['correo']) ?></p>
<p><img src="<?= htmlspecialchars($usuario['perfil']) ?>" alt="Perfil" width="100" /></p>


    
   <p> <a href="editar_perfil.php"> Editar perfíl</a></p>
    
    <h4><a href="logout.php">Cerrar sesión</a></h4>