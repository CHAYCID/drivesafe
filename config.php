<?php
// Configuración de conexión a la base de datos MySQL
// Para usar con XAMPP

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // Usuario por defecto de XAMPP
define('DB_PASS', '');      // Contraseña por defecto de XAMPP (vacía)
define('DB_NAME', 'cultura_vial');
define('DB_CHARSET', 'utf8mb4');

// Función para conectar a la base de datos
function conectarDB() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $opciones);
        return $pdo;
    } catch (PDOException $e) {
        // En producción, no mostrar el error real
        error_log("Error de conexión: " . $e->getMessage());
        die(json_encode([
            'success' => false,
            'message' => 'Error de conexión a la base de datos'
        ]));
    }
}

// Función para cerrar conexión (opcional con PDO)
function cerrarDB($pdo) {
    $pdo = null;
}
