<?php
// init.php - Configura almacenamiento (SQLite o JSON)

define('USE_SQLITE', class_exists('SQLite3'));

if (USE_SQLITE) {
    $db = new SQLite3('foro.db');
    $db->exec("CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        mensaje TEXT NOT NULL,
        fecha TEXT NOT NULL
    )");
} else {
    if (!file_exists('posts.json')) {
        file_put_contents('posts.json', json_encode([]));
    }
}