<?php
define('USE_SQLITE', class_exists('SQLite3'));
function obtenerConexion() {
    $modo_sqlite = false;
    $conexion = null;

    if (USE_SQLITE) {
        try {
            $conexion = new SQLite3('foro.db');
            $modo_sqlite = true;
            $conexion->exec("CREATE TABLE IF NOT EXISTS mensajes (
                id TEXT PRIMARY KEY,
                usuario_id TEXT,
                nombre TEXT NOT NULL,
                mensaje TEXT NOT NULL,
                fecha TEXT NOT NULL,
                respuesta_a TEXT
            )");

            // Validar si existe columna usuario_id
            $res = $conexion->query("PRAGMA table_info(mensajes)");
            $columnas = [];
            while ($col = $res->fetchArray(SQLITE3_ASSOC)) {
                $columnas[] = $col['name'];
            }
            if (!in_array('usuario_id', $columnas)) {
                $conexion->exec("ALTER TABLE mensajes ADD COLUMN usuario_id TEXT");
            }

        } catch (Exception $e) {
            $modo_sqlite = false;
            $conexion = null;
        }
    }

    if (!$modo_sqlite && !file_exists('posts.json')) {
        file_put_contents('posts.json', json_encode([]));
    }

    return [$modo_sqlite, $conexion];
}