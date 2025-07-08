<?php
if (!isset($_GET['data'])) {
    exit("❌ Solicitud inválida.");
}

$datos_json = base64_decode(urldecode($_GET['data']));
$datos = json_decode($datos_json, true);

if (!$datos || !isset($datos['id'])) {
    exit("❌ Datos inválidos.");
}

$usuarios = json_decode(file_get_contents("usuarios.json"), true);
foreach ($usuarios as &$u) {
    if ($u['id'] === $datos['id']) {
        $u['nombre'] = $datos['nombre'];
        $u['imagen'] = $datos['imagen'];
        if (isset($datos['clave'])) {
            $u['clave'] = $datos['clave'];
        }
        file_put_contents("usuarios.json", json_encode($usuarios, JSON_PRETTY_PRINT));
        echo "✅ Perfil actualizado correctamente.";
        exit;
    }
}
echo "❌ Usuario no encontrado.";