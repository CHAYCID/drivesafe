<?php
session_start();

$page_title = "Drive Safe - Educación y Seguridad en las Carreteras";
$page_description = "Aprende sobre seguridad vial, normas de tránsito y conviértete en un conductor responsable con nuestros recursos educativos y minijuegos.";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar flotante con efecto glassmorphism -->
    <nav class="navbar">
        <div class="nav-container">
            <!-- Updated logo path to local XAMPP installation and added "Drive Safe" text -->
            <div class="nav-logo">
                <img src="safe-drive-logo-icon-driving-school-vector-symbol-features-car-steering-wheel-green-shield-symbolize-driver-protection-safety-313180268-Photoroom.png" alt="Drive Safe Logo" class="logo-img">
                <span class="logo-text">Drive Safe</span>
            </div>
            <div class="nav-links">
                <a href="#inicio" class="nav-link">Inicio</a>
                <a href="#registro" class="nav-link">Registro</a>
                <a href="#noticias" class="nav-link">Noticias</a>
                <a href="#tips" class="nav-link">Tips</a>
                <a href="#juegos" class="nav-link">Juegos</a>
            </div>
        </div>
    </nav>

    <!-- Hero mejorado con partículas animadas y diseño más moderno -->
    <section id="inicio" class="hero">
        <div class="particles">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
            <div class="particle particle-5"></div>
        </div>
        
        <div class="hero-content">
            <div class="floating-icon icon-1">🚗</div>
            <div class="floating-icon icon-2">🚦</div>
            <div class="floating-icon icon-3">⚠️</div>
            <div class="floating-icon icon-4">🛑</div>
            
            <div class="hero-badge">Educación Vial 2024</div>
            <!-- Updated brand name to Drive Safe -->
            <h1 class="hero-title">
                <span class="gradient-text">Drive Safe</span>
            </h1>
            <p class="hero-subtitle">Educación y seguridad en las carreteras</p>
            <p class="hero-description">
                Aprende las normas de tránsito, mejora tus hábitos de conducción y conviértete en un conductor responsable
            </p>
            <div class="hero-buttons">
                <a href="#registro" class="hero-button primary">Comienza Ahora</a>
                <a href="#noticias" class="hero-button secondary">Ver Más</a>
            </div>
            
            <!-- Updated stats to show safety, community, and education -->
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-icon">🛡️</div>
                    <div class="stat-number">Seguridad</div>
                    <div class="stat-label">Aprende a conducir de forma segura</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">👥</div>
                    <div class="stat-number">Comunidad</div>
                    <div class="stat-label">Únete a miles de conductores</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">📚</div>
                    <div class="stat-number">Educación</div>
                    <div class="stat-label">Contenido actualizado y práctico</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registro Section -->
    <section id="registro" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Únete Ahora</span>
                <h2 class="section-title">Regístrate</h2>
                <p class="section-subtitle">Únete a nuestra comunidad de conductores responsables</p>
            </div>
            
            <form id="registration-form" class="registration-form" action="procesar-registro.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">
                            <span class="label-icon">👤</span>
                            Nombre Completo
                        </label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Juan Pérez">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">
                            <span class="label-icon">📧</span>
                            Correo Electrónico
                        </label>
                        <input type="email" id="email" name="email" required placeholder="juan@ejemplo.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono">
                            <span class="label-icon">📱</span>
                            Teléfono
                        </label>
                        <input type="tel" id="telefono" name="telefono" required placeholder="+52 123 456 7890">
                    </div>
                    
                    <div class="form-group">
                        <label for="licencia">
                            <span class="label-icon">🪪</span>
                            Tipo de Licencia
                        </label>
                        <select id="licencia" name="licencia" required>
                            <option value="">Selecciona...</option>
                            <option value="A1">A1 - Motocicleta hasta 125cc</option>
                            <option value="A2">A2 - Motocicleta hasta 400cc</option>
                            <option value="B1">B1 - Auto particular</option>
                            <option value="B2">B2 - Auto y camioneta</option>
                            <option value="C">C - Camión</option>
                            <option value="ninguna">No tengo licencia</option>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="submit-button">
                    <span>Registrarse Ahora</span>
                    <span class="button-arrow">→</span>
                </button>
            </form>
            
            <div id="form-message" class="form-message"></div>
        </div>
    </section>

    <!-- Noticias Section -->
    <section id="noticias" class="section section-alt">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Mantente Informado</span>
                <h2 class="section-title">Noticias de Cultura Vial</h2>
                <p class="section-subtitle">Mantente informado sobre las últimas novedades</p>
            </div>
            
            <div class="news-grid">
                <?php
                $noticias = [
                    [
                        'titulo' => 'Nuevas normas de tránsito 2024',
                        'categoria' => 'Legislación',
                        'fecha' => '15 Enero 2024',
                        'descripcion' => 'Conoce las actualizaciones más importantes en la legislación de tránsito para este año.',
                        'imagen' => '🏛️',
                        'color' => '#6366f1'
                    ],
                    [
                        'titulo' => 'Tips para conducir en lluvia',
                        'categoria' => 'Seguridad',
                        'fecha' => '10 Enero 2024',
                        'descripcion' => 'Aprende las mejores prácticas para mantener la seguridad en condiciones climáticas adversas.',
                        'imagen' => '🌧️',
                        'color' => '#0ea5e9'
                    ],
                    [
                        'titulo' => 'Importancia del cinturón de seguridad',
                        'categoria' => 'Prevención',
                        'fecha' => '5 Enero 2024',
                        'descripcion' => 'Estadísticas que demuestran cómo el cinturón salva vidas diariamente.',
                        'imagen' => '🔒',
                        'color' => '#10b981'
                    ],
                    [
                        'titulo' => 'Campaña contra el alcohol al volante',
                        'categoria' => 'Prevención',
                        'fecha' => '1 Enero 2024',
                        'descripcion' => 'Nueva campaña nacional para crear conciencia sobre los peligros de conducir bajo efectos del alcohol.',
                        'imagen' => '🚫',
                        'color' => '#f59e0b'
                    ]
                ];
                
                foreach ($noticias as $noticia) {
                    echo "<article class='news-card'>";
                    echo "<div class='news-icon-wrapper' style='background: linear-gradient(135deg, {$noticia['color']}22 0%, {$noticia['color']}44 100%);'>";
                    echo "<div class='news-icon'>{$noticia['imagen']}</div>";
                    echo "</div>";
                    echo "<div class='news-category' style='background: {$noticia['color']};'>{$noticia['categoria']}</div>";
                    echo "<h3 class='news-title'>{$noticia['titulo']}</h3>";
                    echo "<p class='news-description'>{$noticia['descripcion']}</p>";
                    echo "<div class='news-footer'>";
                    echo "<div class='news-date'>📅 {$noticia['fecha']}</div>";
                    echo "<button class='news-link'>Leer más →</button>";
                    echo "</div>";
                    echo "</article>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section id="tips" class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Aprende</span>
                <h2 class="section-title">Tips de Seguridad Vial</h2>
                <p class="section-subtitle">Consejos prácticos para tu día a día</p>
            </div>
            
            <div class="tips-grid">
                <?php
                $tips = [
                    ['icono' => '👀', 'titulo' => 'Mantén la vista en el camino', 'descripcion' => 'Evita distracciones como el celular y mantén tu atención en la vía', 'color' => '#8b5cf6'],
                    ['icono' => '⚡', 'titulo' => 'Respeta los límites de velocidad', 'descripcion' => 'Adapta tu velocidad según las condiciones del tráfico y clima', 'color' => '#ef4444'],
                    ['icono' => '↔️', 'titulo' => 'Mantén la distancia', 'descripcion' => 'Guarda suficiente espacio con el vehículo de adelante', 'color' => '#3b82f6'],
                    ['icono' => '🔆', 'titulo' => 'Usa las luces correctamente', 'descripcion' => 'Enciende las luces en condiciones de baja visibilidad', 'color' => '#f59e0b'],
                    ['icono' => '✋', 'titulo' => 'Señaliza tus movimientos', 'descripcion' => 'Usa las direccionales para indicar tus intenciones', 'color' => '#14b8a6'],
                    ['icono' => '🛡️', 'titulo' => 'Revisa tu vehículo', 'descripcion' => 'Mantén tu auto en buen estado con revisiones periódicas', 'color' => '#ec4899']
                ];
                
                foreach ($tips as $index => $tip) {
                    echo "<div class='tip-card' data-index='{$index}'>";
                    echo "<div class='tip-icon-wrapper' style='background: {$tip['color']}22;'>";
                    echo "<div class='tip-icon'>{$tip['icono']}</div>";
                    echo "</div>";
                    echo "<h3 class='tip-title'>{$tip['titulo']}</h3>";
                    echo "<p class='tip-description'>{$tip['descripcion']}</p>";
                    echo "<div class='tip-number' style='color: {$tip['color']};'>0" . ($index + 1) . "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Minijuegos Section -->
    <section id="juegos" class="section section-alt">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Juega y Aprende</span>
                <h2 class="section-title">Minijuegos Educativos</h2>
                <p class="section-subtitle">Aprende jugando de manera divertida</p>
            </div>
            
            <!-- Fixed games grid layout to prevent text overflow and disorganization -->
            <div class="games-container">
                <!-- Quiz Game -->
                <div class="game-card quiz-card">
                    <div class="game-header">
                        <div class="game-icon">🎯</div>
                        <div>
                            <h3 class="game-title">Quiz de Señales</h3>
                        </div>
                    </div>
                    <p class="game-description">Pon a prueba tus conocimientos sobre señales de tránsito</p>
                    <div id="quiz-game">
                        <div id="quiz-question" class="quiz-question"></div>
                        <div id="quiz-options" class="quiz-options"></div>
                        <div id="quiz-score" class="quiz-score">
                            <span class="score-label">Puntuación:</span>
                            <span id="score" class="score-number">0</span>/4
                        </div>
                        <button id="quiz-start" class="game-button">
                            <span>Comenzar Quiz</span>
                            <span class="button-icon">🎮</span>
                        </button>
                    </div>
                </div>
                
                <!-- Memory Game -->
                <div class="game-card memory-card">
                    <div class="game-header">
                        <div class="game-icon">🧩</div>
                        <div>
                            <h3 class="game-title">Memoria Vial</h3>
                        </div>
                    </div>
                    <p class="game-description">Encuentra las parejas de señales de tránsito</p>
                    <div id="memory-game">
                        <div id="memory-board" class="memory-board"></div>
                        <div class="memory-stats">
                            <div class="stat-box">
                                <span class="stat-icon">🎯</span>
                                <div>
                                    <span class="stat-label">Movimientos</span>
                                    <span id="moves" class="stat-value">0</span>
                                </div>
                            </div>
                            <div class="stat-box">
                                <span class="stat-icon">✨</span>
                                <div>
                                    <span class="stat-label">Parejas</span>
                                    <span id="pairs" class="stat-value">0</span>/6
                                </div>
                            </div>
                        </div>
                        <button id="memory-start" class="game-button">
                            <span>Nuevo Juego</span>
                            <span class="button-icon">🎮</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer mejorado con diseño moderno -->
    <footer class="footer">
        <div class="footer-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <!-- Updated footer logo path -->
                    <h4>
                        <img src="safe-drive-logo-icon-driving-school-vector-symbol-features-car-steering-wheel-green-shield-symbolize-driver-protection-safety-313180268-Photoroom.png" alt="Drive Safe" class="footer-logo">
                        Drive Safe
                    </h4>
                    <p>Educación y seguridad en las carreteras para todos los conductores responsables.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link">📘</a>
                        <a href="#" class="social-link">📷</a>
                        <a href="#" class="social-link">🐦</a>
                        <a href="#" class="social-link">💼</a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="#registro">→ Registro</a></li>
                        <li><a href="#noticias">→ Noticias</a></li>
                        <li><a href="#tips">→ Tips</a></li>
                        <li><a href="#juegos">→ Juegos</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <p>📧 info@drivesafe.com</p>
                    <p>📱 (123) 456-7890</p>
                    <p>📍 Ciudad de México, México</p>
                </div>
            </div>
            <div class="footer-bottom">
                <!-- Updated copyright to Drive Safe -->
                <p>&copy; <?php echo date('Y'); ?> Drive Safe. Todos los derechos reservados.</p>
                <div class="footer-bottom-links">
                    <a href="#">Política de Privacidad</a>
                    <a href="#">Términos de Uso</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
    
    <!-- AI Assistant Chatbot Widget -->
    <div id="chatbot-widget" class="chatbot-widget">
        <div class="chatbot-button" id="chatbot-toggle">
            <span class="chatbot-icon">💬</span>
            <span class="chatbot-badge">IA</span>
        </div>
        
        <div class="chatbot-window" id="chatbot-window">
            <div class="chatbot-header">
                <div class="chatbot-header-info">
                    <div class="chatbot-avatar">🤖</div>
                    <div>
                        <h4>Drive Safe Assistant</h4>
                        <span class="chatbot-status">En línea</span>
                    </div>
                </div>
                <button class="chatbot-close" id="chatbot-close">✕</button>
            </div>
            
            <div class="chatbot-messages" id="chatbot-messages">
                <div class="message bot-message">
                    <div class="message-avatar">🤖</div>
                    <div class="message-content">
                        <p>Hola, soy tu asistente virtual de Drive Safe. ¿En qué puedo ayudarte hoy?</p>
                        <div class="quick-replies">
                            <button class="quick-reply" data-question="¿Cuáles son las señales de tránsito más importantes?">📍 Señales de tránsito</button>
                            <button class="quick-reply" data-question="¿Qué debo hacer en caso de accidente?">🚨 Accidentes</button>
                            <button class="quick-reply" data-question="Dame consejos para conducir bajo lluvia">🌧️ Conducción en lluvia</button>
                            <button class="quick-reply" data-question="¿Cómo obtener mi licencia de conducir?">🪪 Licencia</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="chatbot-input-container">
                <input 
                    type="text" 
                    id="chatbot-input" 
                    class="chatbot-input" 
                    placeholder="Escribe tu pregunta..."
                    autocomplete="off"
                >
                <button class="chatbot-send" id="chatbot-send">
                    <span>➤</span>
                </button>
            </div>
        </div>
    </div>
    
    <script src="chatbot.js"></script>
</body>
</html>
