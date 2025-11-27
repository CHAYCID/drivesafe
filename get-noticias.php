<?php
require_once 'config.php';
header('Content-Type: application/json');

try {
    $pdo = conectarDB();
    
    // Obtener noticias activas ordenadas por fecha
    $stmt = $pdo->prepare("
        SELECT id, titulo, descripcion, categoria, imagen, fecha_publicacion, autor, vistas
        FROM noticias 
        WHERE activo = 1 
        ORDER BY fecha_publicacion DESC 
        LIMIT 10
    ");
    
    $stmt->execute();
    $noticias = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $noticias
    ]);
    
} catch (PDOException $e) {
    error_log("Error al obtener noticias: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al cargar las noticias'
    ]);
}
