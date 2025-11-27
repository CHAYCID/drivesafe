<?php
require_once 'config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$nombre_jugador = filter_input(INPUT_POST, 'nombre_jugador', FILTER_SANITIZE_STRING);
$tipo_juego = filter_input(INPUT_POST, 'tipo_juego', FILTER_SANITIZE_STRING);
$puntaje = filter_input(INPUT_POST, 'puntaje', FILTER_VALIDATE_INT);
$tiempo_segundos = filter_input(INPUT_POST, 'tiempo_segundos', FILTER_VALIDATE_INT);

// Validaciones
if (empty($nombre_jugador) || empty($tipo_juego) || $puntaje === false) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos o inválidos'
    ]);
    exit;
}

if (!in_array($tipo_juego, ['quiz', 'memoria'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Tipo de juego inválido'
    ]);
    exit;
}

try {
    $pdo = conectarDB();
    
    // Insertar puntaje
    $stmt = $pdo->prepare("
        INSERT INTO puntajes (nombre_jugador, tipo_juego, puntaje, tiempo_segundos) 
        VALUES (?, ?, ?, ?)
    ");
    
    $stmt->execute([$nombre_jugador, $tipo_juego, $puntaje, $tiempo_segundos]);
    
    // Obtener top 10 puntajes para este juego
    $stmt = $pdo->prepare("
        SELECT nombre_jugador, puntaje, tiempo_segundos, fecha_juego
        FROM puntajes 
        WHERE tipo_juego = ? 
        ORDER BY puntaje DESC, tiempo_segundos ASC 
        LIMIT 10
    ");
    
    $stmt->execute([$tipo_juego]);
    $top_puntajes = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'message' => 'Puntaje guardado exitosamente',
        'data' => [
            'top_puntajes' => $top_puntajes
        ]
    ]);
    
} catch (PDOException $e) {
    error_log("Error al guardar puntaje: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al guardar el puntaje'
    ]);
}
