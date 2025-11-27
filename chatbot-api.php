<?php
// API endpoint for advanced AI chatbot (optional for future OpenAI integration)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $message = $data['message'] ?? '';
    
    if (empty($message)) {
        echo json_encode([
            'success' => false,
            'message' => 'Mensaje vacío'
        ]);
        exit;
    }
    
    // Here you can integrate with OpenAI API or other AI services
    // For now, we'll use the JavaScript-based intelligent responses
    
    // Save conversation to database (optional)
    try {
        $pdo = conectarDB();
        
        // Create conversations table if it doesn't exist
        $createTable = "CREATE TABLE IF NOT EXISTS conversaciones (
            id INT AUTO_INCREMENT PRIMARY KEY,
            mensaje_usuario TEXT NOT NULL,
            respuesta_bot TEXT NOT NULL,
            fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $pdo->exec($createTable);
        
        // For future AI integration:
        // $response = callOpenAIAPI($message);
        
        $response = 'Respuesta procesada desde el servidor.';
        
        // Save to database
        $stmt = $pdo->prepare("INSERT INTO conversaciones (mensaje_usuario, respuesta_bot) VALUES (?, ?)");
        $stmt->execute([$message, $response]);
        
        echo json_encode([
            'success' => true,
            'response' => $response
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error al procesar el mensaje'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}
?>
