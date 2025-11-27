// AI Chatbot functionality for Drive Safe
document.addEventListener("DOMContentLoaded", () => {
  const chatbotToggle = document.getElementById("chatbot-toggle")
  const chatbotClose = document.getElementById("chatbot-close")
  const chatbotWindow = document.getElementById("chatbot-window")
  const chatbotInput = document.getElementById("chatbot-input")
  const chatbotSend = document.getElementById("chatbot-send")
  const chatbotMessages = document.getElementById("chatbot-messages")

  // Toggle chatbot window
  chatbotToggle.addEventListener("click", () => {
    chatbotWindow.classList.add("active")
    chatbotToggle.style.display = "none"
    chatbotInput.focus()
  })

  chatbotClose.addEventListener("click", () => {
    chatbotWindow.classList.remove("active")
    chatbotToggle.style.display = "flex"
  })

  // Send message on button click
  chatbotSend.addEventListener("click", sendMessage)

  // Send message on Enter key
  chatbotInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      sendMessage()
    }
  })

  // Quick reply buttons
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("quick-reply")) {
      const question = e.target.getAttribute("data-question")
      sendUserMessage(question)
      processMessage(question)
    }
  })

  function sendMessage() {
    const message = chatbotInput.value.trim()
    if (message === "") return

    sendUserMessage(message)
    chatbotInput.value = ""

    // Process message with AI
    processMessage(message)
  }

  function sendUserMessage(message) {
    const messageDiv = document.createElement("div")
    messageDiv.className = "message user-message"
    messageDiv.innerHTML = `
            <div class="message-avatar">👤</div>
            <div class="message-content">
                <p>${escapeHtml(message)}</p>
            </div>
        `
    chatbotMessages.appendChild(messageDiv)
    scrollToBottom()
  }

  function sendBotMessage(message, showQuickReplies = false) {
    const messageDiv = document.createElement("div")
    messageDiv.className = "message bot-message"

    let quickRepliesHtml = ""
    if (showQuickReplies) {
      quickRepliesHtml = `
                <div class="quick-replies">
                    <button class="quick-reply" data-question="¿Cuáles son las señales de tránsito más importantes?">📍 Señales</button>
                    <button class="quick-reply" data-question="Dame más tips de seguridad">💡 Tips</button>
                    <button class="quick-reply" data-question="¿Cómo me registro?">📝 Registro</button>
                </div>
            `
    }

    messageDiv.innerHTML = `
            <div class="message-avatar">🤖</div>
            <div class="message-content">
                <p>${message}</p>
                ${quickRepliesHtml}
            </div>
        `
    chatbotMessages.appendChild(messageDiv)
    scrollToBottom()
  }

  function showTypingIndicator() {
    const typingDiv = document.createElement("div")
    typingDiv.className = "message bot-message"
    typingDiv.id = "typing-indicator"
    typingDiv.innerHTML = `
            <div class="message-avatar">🤖</div>
            <div class="message-content">
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `
    chatbotMessages.appendChild(typingDiv)
    scrollToBottom()
  }

  function removeTypingIndicator() {
    const typingIndicator = document.getElementById("typing-indicator")
    if (typingIndicator) {
      typingIndicator.remove()
    }
  }

  function processMessage(message) {
    showTypingIndicator()

    // Simulate AI processing time
    setTimeout(
      () => {
        removeTypingIndicator()
        const response = getAIResponse(message)
        sendBotMessage(response.text, response.showQuickReplies)
      },
      1000 + Math.random() * 1000,
    )
  }

  function getAIResponse(message) {
    const messageLower = message.toLowerCase()

    // AI Response database - intelligent matching
    const responses = {
      // Señales de tránsito
      "señales|señal|tránsito|transito": {
        text: "Las señales de tránsito más importantes son:<br><br>🛑 <strong>Alto:</strong> Detente completamente<br>⚠️ <strong>Ceda el paso:</strong> Permite pasar a otros vehículos<br>🚫 <strong>No entrar:</strong> Prohibido el paso<br>↔️ <strong>Doble sentido:</strong> Circulación en ambas direcciones<br>🏫 <strong>Zona escolar:</strong> Reducir velocidad cerca de escuelas<br><br>¿Te gustaría saber más sobre alguna señal específica?",
        showQuickReplies: true,
      },

      // Accidentes
      "accidente|choque|colisión|crash": {
        text: "En caso de accidente, sigue estos pasos:<br><br>1️⃣ <strong>Mantén la calma</strong> y evalúa la situación<br>2️⃣ <strong>Verifica heridos</strong> y llama a emergencias si es necesario<br>3️⃣ <strong>Mueve el vehículo</strong> si es posible para evitar más accidentes<br>4️⃣ <strong>Toma fotografías</strong> de los daños y la escena<br>5️⃣ <strong>Intercambia información</strong> con el otro conductor<br>6️⃣ <strong>Reporta al seguro</strong> lo antes posible<br><br>Emergencias: 911",
        showQuickReplies: true,
      },

      // Lluvia
      "lluvia|llover|mojado|agua": {
        text: "Tips para conducir bajo lluvia:<br><br>🌧️ <strong>Reduce la velocidad:</strong> Los caminos mojados reducen el agarre<br>💡 <strong>Enciende las luces:</strong> Mejora la visibilidad<br>↔️ <strong>Aumenta la distancia:</strong> Mayor espacio de frenado necesario<br>🚗 <strong>Evita frenar bruscamente:</strong> Puedes perder el control<br>👀 <strong>Revisa los limpiaparabrisas:</strong> Asegúrate que funcionen bien<br>⚠️ <strong>Cuidado con charcos:</strong> Pueden causar hidroplaneo",
        showQuickReplies: true,
      },

      // Licencia
      "licencia|licencias|conducir|manejar|sacar": {
        text: "Para obtener tu licencia de conducir:<br><br>📋 <strong>Requisitos:</strong><br>- Identificación oficial<br>- Comprobante de domicilio<br>- CURP<br>- Certificado médico<br><br>📝 <strong>Proceso:</strong><br>1. Curso teórico de educación vial<br>2. Examen teórico<br>3. Examen práctico de manejo<br>4. Pago de derechos<br><br>💰 El costo varía según el estado. ¿En qué estado te encuentras?",
        showQuickReplies: true,
      },

      // Registro
      "registro|registrar|inscribir|cuenta": {
        text: 'Para registrarte en Drive Safe:<br><br>1️⃣ Ve a la sección de <strong>Registro</strong> en el menú<br>2️⃣ Completa el formulario con tus datos<br>3️⃣ Selecciona tu tipo de licencia<br>4️⃣ Haz clic en "Registrarse Ahora"<br><br>Con tu cuenta podrás:<br>✅ Guardar tu progreso en los juegos<br>✅ Acceder a contenido exclusivo<br>✅ Recibir tips personalizados<br><br><a href="#registro">¡Regístrate aquí!</a>',
        showQuickReplies: false,
      },

      // Velocidad
      "velocidad|rápido|límite|exceso": {
        text: "Sobre los límites de velocidad:<br><br>🏙️ <strong>Zona urbana:</strong> 40-60 km/h<br>🛣️ <strong>Carretera:</strong> 80-110 km/h<br>🚗 <strong>Autopista:</strong> 110-120 km/h<br>🏫 <strong>Zona escolar:</strong> 20-30 km/h<br><br>⚠️ <strong>Importante:</strong> El exceso de velocidad es una de las principales causas de accidentes. Adapta tu velocidad a las condiciones del camino, clima y tráfico.",
        showQuickReplies: true,
      },

      // Cinturón
      "cinturón|cinturon|seguridad|amarrar": {
        text: "El cinturón de seguridad:<br><br>🔒 <strong>¿Por qué usarlo?</strong><br>- Reduce el riesgo de muerte en un 50%<br>- Previene lesiones graves<br>- Es obligatorio por ley<br><br>✅ <strong>Uso correcto:</strong><br>- Banda sobre el hombro y pecho<br>- Banda sobre las caderas, no el abdomen<br>- Ajustado pero cómodo<br>- Todos los pasajeros deben usarlo<br><br>¡El cinturón salva vidas!",
        showQuickReplies: true,
      },

      // Alcohol
      "alcohol|tomar|borracho|cerveza|bebida": {
        text: "🚫 <strong>NUNCA conduzcas bajo efectos del alcohol</strong><br><br>⚠️ El alcohol:<br>- Reduce tus reflejos<br>- Afecta tu juicio<br>- Disminuye la concentración<br>- Puede causar accidentes mortales<br><br>📱 Alternativas:<br>- Pide un taxi o Uber<br>- Designa un conductor responsable<br>- Usa transporte público<br>- Quédate donde estás<br><br>🚔 Conducir ebrio es un delito grave.",
        showQuickReplies: true,
      },

      // Tips
      "tip|tips|consejo|consejos|ayuda": {
        text: 'Aquí tienes algunos tips esenciales de seguridad vial:<br><br>👀 Mantén la vista en el camino<br>⚡ Respeta los límites de velocidad<br>↔️ Mantén la distancia de seguridad<br>🔆 Usa las luces correctamente<br>✋ Señaliza tus movimientos<br>🛡️ Revisa tu vehículo regularmente<br><br>Para ver más tips detallados, visita nuestra <a href="#tips">sección de Tips</a>.',
        showQuickReplies: true,
      },

      // Juegos
      "juego|juegos|minijuego|quiz|memoria": {
        text: '🎮 Tenemos dos minijuegos educativos:<br><br>🎯 <strong>Quiz de Señales:</strong> Pon a prueba tus conocimientos sobre señales de tránsito con 4 preguntas interactivas.<br><br>🧩 <strong>Memoria Vial:</strong> Encuentra las parejas de señales en este divertido juego de memoria.<br><br>¡Aprende jugando! Visita la <a href="#juegos">sección de Juegos</a>.',
        showQuickReplies: true,
      },

      // Saludos
      "hola|buenas|buenos días|buenas tardes|buenas noches|hey|hi": {
        text: "¡Hola! 👋 Bienvenido a Drive Safe. Soy tu asistente virtual y estoy aquí para ayudarte con cualquier duda sobre seguridad vial, normas de tránsito y conducción responsable. ¿En qué puedo ayudarte hoy?",
        showQuickReplies: true,
      },

      // Despedidas
      "adiós|adios|bye|chao|hasta luego|gracias": {
        text: "¡Hasta pronto! 👋 Recuerda conducir siempre de forma segura y responsable. Si tienes más preguntas, estaré aquí para ayudarte. ¡Cuídate en la carretera! 🚗",
        showQuickReplies: false,
      },
    }

    // Check for matching response
    for (const [keywords, response] of Object.entries(responses)) {
      const regex = new RegExp(keywords, "i")
      if (regex.test(messageLower)) {
        return response
      }
    }

    // Default response if no match found
    return {
      text: "Interesante pregunta. Puedo ayudarte con información sobre:<br><br>📍 Señales de tránsito<br>🚨 Qué hacer en accidentes<br>🌧️ Conducción en condiciones adversas<br>🪪 Cómo obtener tu licencia<br>💡 Tips de seguridad vial<br>🎮 Nuestros minijuegos educativos<br><br>¿Sobre cuál te gustaría saber más?",
      showQuickReplies: true,
    }
  }

  function escapeHtml(text) {
    const map = {
      "&": "&amp;",
      "<": "&lt;",
      ">": "&gt;",
      '"': "&quot;",
      "'": "&#039;",
    }
    return text.replace(/[&<>"']/g, (m) => map[m])
  }

  function scrollToBottom() {
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight
  }
})
