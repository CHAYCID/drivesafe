-- Base de datos para Cultura Vial
-- Ejecutar este script en phpMyAdmin de XAMPP

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS cultura_vial CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE cultura_vial;

-- Tabla de usuarios registrados
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL,
    licencia ENUM('A', 'B', 'C', 'D', 'Ninguna') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo TINYINT(1) DEFAULT 1,
    INDEX idx_email (email),
    INDEX idx_fecha (fecha_registro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de noticias
CREATE TABLE IF NOT EXISTS noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    categoria ENUM('Seguridad', 'Tecnología', 'Eventos', 'Normativa', 'Educación') DEFAULT 'Seguridad',
    imagen VARCHAR(255),
    fecha_publicacion DATE NOT NULL,
    autor VARCHAR(100),
    activo TINYINT(1) DEFAULT 1,
    vistas INT DEFAULT 0,
    INDEX idx_categoria (categoria),
    INDEX idx_fecha (fecha_publicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de tips
CREATE TABLE IF NOT EXISTS tips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    icono VARCHAR(50),
    orden INT DEFAULT 0,
    activo TINYINT(1) DEFAULT 1,
    INDEX idx_orden (orden)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de puntajes de juegos
CREATE TABLE IF NOT EXISTS puntajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre_jugador VARCHAR(100) NOT NULL,
    tipo_juego ENUM('quiz', 'memoria') NOT NULL,
    puntaje INT NOT NULL,
    tiempo_segundos INT,
    fecha_juego TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    INDEX idx_tipo_juego (tipo_juego),
    INDEX idx_puntaje (puntaje DESC),
    INDEX idx_fecha (fecha_juego)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar noticias de ejemplo
INSERT INTO noticias (titulo, descripcion, categoria, imagen, fecha_publicacion, autor) VALUES
('Nueva Ley de Tránsito 2024', 'Se implementan nuevas regulaciones para mejorar la seguridad vial en todo el país. Incluye límites de velocidad actualizados y sanciones más estrictas.', 'Normativa', '/placeholder.svg?height=200&width=400', '2024-01-15', 'Ministerio de Transporte'),
('Tecnología de Detección de Colisiones', 'Los nuevos vehículos incorporan sistemas avanzados de prevención de accidentes que salvan vidas mediante inteligencia artificial.', 'Tecnología', '/placeholder.svg?height=200&width=400', '2024-01-10', 'Auto Tech Magazine'),
('Campaña de Seguridad Vial en Escuelas', 'Programa educativo llega a más de 500 escuelas enseñando cultura vial a niños y adolescentes de manera interactiva.', 'Educación', '/placeholder.svg?height=200&width=400', '2024-01-05', 'Educación Vial'),
('Reducción del 30% en Accidentes', 'Estadísticas muestran importante disminución en siniestros viales gracias a campañas de concientización y mejoras en infraestructura.', 'Seguridad', '/placeholder.svg?height=200&width=400', '2024-01-01', 'Instituto de Seguridad Vial');

-- Insertar tips de ejemplo
INSERT INTO tips (titulo, descripcion, icono, orden) VALUES
('Mantén la Distancia', 'Conserva al menos 3 segundos de distancia con el vehículo de adelante. Esto te da tiempo suficiente para reaccionar ante cualquier imprevisto.', '🚗', 1),
('Respeta los Límites', 'Las señales de velocidad están diseñadas para tu seguridad. Respetarlas reduce significativamente el riesgo de accidentes graves.', '⚡', 2),
('Usa el Cinturón', 'El cinturón de seguridad reduce en un 50% el riesgo de muerte en caso de accidente. Úsalo siempre, incluso en trayectos cortos.', '🔒', 3),
('No Uses el Celular', 'Conducir distraído es tan peligroso como conducir ebrio. Si necesitas usar tu teléfono, detente en un lugar seguro.', '📱', 4),
('Revisa tu Vehículo', 'Mantenimiento regular: frenos, luces, neumáticos y líquidos. Un vehículo en buen estado es fundamental para tu seguridad.', '🔧', 5),
('Conduce Descansado', 'La fatiga al volante causa miles de accidentes. Si sientes sueño, descansa. Tu vida y la de otros está en juego.', '😴', 6);

-- Insertar algunos puntajes de ejemplo
INSERT INTO puntajes (nombre_jugador, tipo_juego, puntaje, tiempo_segundos) VALUES
('María García', 'quiz', 4, 45),
('Juan Pérez', 'memoria', 100, 62),
('Ana López', 'quiz', 3, 38),
('Carlos Ruiz', 'memoria', 100, 55);
