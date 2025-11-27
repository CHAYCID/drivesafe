<?php
require_once 'config.php';

header('Content-Type: application/json');

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener y validar datos
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
$licencia = filter_input(INPUT_POST, 'licencia', FILTER_SANITIZE_STRING);

// Validaciones
$errores = [];

if (empty($nombre) || strlen($nombre) < 3) {
    $errores[] = 'El nombre debe tener al menos 3 caracteres';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = 'El correo electrónico no es válido';
}

if (empty($telefono) || strlen($telefono) < 8) {
    $errores[] = 'El teléfono debe tener al menos 8 dígitos';
}

if (empty($licencia)) {
    $errores[] = 'Debes seleccionar un tipo de licencia';
}

// Si hay errores, retornar
if (!empty($errores)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Errores de validación',
        'errors' => $errores
    ]);
    exit;
}

try {
    $pdo = conectarDB();
    
    // Verificar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Este correo electrónico ya está registrado'
        ]);
        exit;
    }
    
    // Insertar nuevo usuario
    $stmt = $pdo->prepare("
        INSERT INTO usuarios (nombre, email, telefono, licencia) 
        VALUES (?, ?, ?, ?)
    ");
    
    $stmt->execute([$nombre, $email, $telefono, $licencia]);
    
    $usuario_id = $pdo->lastInsertId();
    
    // Respuesta exitosa
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => '¡Registro exitoso! Bienvenido a Cultura Vial, ' . $nombre,
        'data' => [
            'id' => $usuario_id,
            'nombre' => $nombre,
            'email' => $email
        ]
    ]);
    
} catch (PDOException $e) {
    error_log("Error en registro: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al procesar el registro. Por favor, intenta nuevamente.'
    ]);
}
