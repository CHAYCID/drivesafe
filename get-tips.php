<?php
require_once 'config.php';
header('Content-Type: application/json');

try {
    $pdo = conectarDB();
    
    // Obtener tips activos ordenados por orden
    $stmt = $pdo->prepare("
        SELECT id, titulo, descripcion, icono
        FROM tips 
        WHERE activo = 1 
        ORDER BY orden ASC
    ");
    
    $stmt->execute();
    $tips = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $tips
    ]);
    
} catch (PDOException $e) {
    error_log("Error al obtener tips: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al cargar los tips'
    ]);
}
