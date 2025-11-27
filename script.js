// Smooth scroll para los enlaces
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault()
    const target = document.querySelector(this.getAttribute("href"))
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      })
    }
  })
})

// Manejo del formulario de registro
const registrationForm = document.getElementById("registration-form")
const formMessage = document.getElementById("form-message")

if (registrationForm) {
  registrationForm.addEventListener("submit", async (e) => {
    e.preventDefault()

    const formData = new FormData(registrationForm)

    try {
      const response = await fetch("procesar-registro.php", {
        method: "POST",
        body: formData,
      })

      const data = await response.json()

      formMessage.className = "form-message"

      if (data.success) {
        formMessage.classList.add("success")
        formMessage.textContent = data.message
        registrationForm.reset()
      } else {
        formMessage.classList.add("error")
        formMessage.textContent = data.message
        if (data.errors) {
          formMessage.textContent += "\n" + data.errors.join("\n")
        }
      }

      // Ocultar mensaje después de 5 segundos
      setTimeout(() => {
        formMessage.style.display = "none"
      }, 5000)
    } catch (error) {
      formMessage.className = "form-message error"
      formMessage.textContent = "Error al enviar el formulario. Intenta nuevamente."
    }
  })
}

// Quiz Game
const quizData = [
  {
    question: "¿Qué significa esta señal: 🛑?",
    options: ["Alto total", "Ceda el paso", "Prohibido estacionar", "Zona escolar"],
    correct: 0,
  },
  {
    question: "¿Qué indica esta señal: ⚠️?",
    options: ["Velocidad máxima", "Peligro o precaución", "Dirección obligatoria", "Estacionamiento"],
    correct: 1,
  },
  {
    question: "¿A qué distancia debes seguir al auto de adelante?",
    options: ["1 metro", "2 segundos de distancia", "5 metros", "Lo más cerca posible"],
    correct: 1,
  },
  {
    question: "¿Cuándo debes usar el cinturón de seguridad?",
    options: ["Solo en carretera", "Solo el conductor", "Siempre, todos los pasajeros", "Solo de noche"],
    correct: 2,
  },
]

let currentQuestion = 0
let score = 0

const quizStartBtn = document.getElementById("quiz-start")
const quizQuestion = document.getElementById("quiz-question")
const quizOptions = document.getElementById("quiz-options")
const scoreDisplay = document.getElementById("score")

if (quizStartBtn) {
  quizStartBtn.addEventListener("click", startQuiz)
}

function startQuiz() {
  currentQuestion = 0
  score = 0
  scoreDisplay.textContent = score
  quizStartBtn.style.display = "none"
  showQuestion()
}

function showQuestion() {
  if (currentQuestion >= quizData.length) {
    endQuiz()
    return
  }

  const question = quizData[currentQuestion]
  quizQuestion.textContent = question.question
  quizOptions.innerHTML = ""

  question.options.forEach((option, index) => {
    const button = document.createElement("button")
    button.className = "quiz-option"
    button.textContent = option
    button.addEventListener("click", () => selectAnswer(index))
    quizOptions.appendChild(button)
  })
}

function selectAnswer(selected) {
  const question = quizData[currentQuestion]
  const options = quizOptions.querySelectorAll(".quiz-option")

  options.forEach((option, index) => {
    option.disabled = true
    if (index === question.correct) {
      option.classList.add("correct")
    } else if (index === selected && index !== question.correct) {
      option.classList.add("incorrect")
    }
  })

  if (selected === question.correct) {
    score++
    scoreDisplay.textContent = score
  }

  setTimeout(() => {
    currentQuestion++
    showQuestion()
  }, 1500)
}

function endQuiz() {
  quizQuestion.textContent = `¡Quiz completado! Puntuación: ${score}/${quizData.length}`
  quizOptions.innerHTML = ""
  quizStartBtn.style.display = "block"
  quizStartBtn.textContent = "Jugar de nuevo"
}

// Memory Game
const memorySymbols = ["🚗", "🚦", "⚠️", "🛑", "🚸", "⛽"]
let memoryCards = []
let flippedCards = []
let matchedPairs = 0
let moves = 0

const memoryStartBtn = document.getElementById("memory-start")
const memoryBoard = document.getElementById("memory-board")
const movesDisplay = document.getElementById("moves")
const pairsDisplay = document.getElementById("pairs")

if (memoryStartBtn) {
  memoryStartBtn.addEventListener("click", startMemoryGame)
}

function startMemoryGame() {
  matchedPairs = 0
  moves = 0
  flippedCards = []
  movesDisplay.textContent = moves
  pairsDisplay.textContent = matchedPairs

  // Crear array de cartas duplicadas y mezclar
  memoryCards = [...memorySymbols, ...memorySymbols].sort(() => Math.random() - 0.5)

  memoryBoard.innerHTML = ""

  memoryCards.forEach((symbol, index) => {
    const card = document.createElement("div")
    card.className = "memory-card"
    card.dataset.symbol = symbol
    card.dataset.index = index
    card.textContent = "?"
    card.addEventListener("click", flipCard)
    memoryBoard.appendChild(card)
  })
}

function flipCard() {
  if (flippedCards.length >= 2) return
  if (this.classList.contains("flipped") || this.classList.contains("matched")) return

  this.classList.add("flipped")
  this.textContent = this.dataset.symbol
  flippedCards.push(this)

  if (flippedCards.length === 2) {
    moves++
    movesDisplay.textContent = moves
    checkMatch()
  }
}

function checkMatch() {
  const [card1, card2] = flippedCards

  if (card1.dataset.symbol === card2.dataset.symbol) {
    card1.classList.add("matched")
    card2.classList.add("matched")
    matchedPairs++
    pairsDisplay.textContent = matchedPairs
    flippedCards = []

    if (matchedPairs === memorySymbols.length) {
      setTimeout(() => {
        alert(`¡Felicidades! Completaste el juego en ${moves} movimientos`)
      }, 500)
    }
  } else {
    setTimeout(() => {
      card1.classList.remove("flipped")
      card2.classList.remove("flipped")
      card1.textContent = "?"
      card2.textContent = "?"
      flippedCards = []
    }, 1000)
  }
}

// Animaciones al hacer scroll
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
}

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "1"
      entry.target.style.transform = "translateY(0)"
    }
  })
}, observerOptions)

// Observar elementos para animar
document.querySelectorAll(".news-card, .tip-card, .game-card").forEach((el) => {
  el.style.opacity = "0"
  el.style.transform = "translateY(20px)"
  el.style.transition = "opacity 0.6s, transform 0.6s"
  observer.observe(el)
})

window.addEventListener("scroll", () => {
  const scrolled = window.pageYOffset
  const parallaxElements = document.querySelectorAll(".floating-icon")

  parallaxElements.forEach((el, index) => {
    const speed = 0.5 + index * 0.1
    el.style.transform = `translateY(${scrolled * speed}px)`
  })
})

function animateCounter(element, target) {
  let current = 0
  const increment = target / 50
  const timer = setInterval(() => {
    current += increment
    if (current >= target) {
      element.textContent = target
      clearInterval(timer)
    } else {
      element.textContent = Math.floor(current)
    }
  }, 20)
}

// Activar contador cuando sea visible
const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const statNumbers = entry.target.querySelectorAll(".stat-number")
      statNumbers.forEach((stat) => {
        const target = Number.parseInt(stat.textContent.replace(/\D/g, ""))
        if (target) {
          animateCounter(stat, target)
        }
      })
      statsObserver.unobserve(entry.target)
    }
  })
})

const heroStats = document.querySelector(".hero-stats")
if (heroStats) {
  statsObserver.observe(heroStats)
}

const cardObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry, index) => {
    if (entry.isIntersecting) {
      setTimeout(() => {
        entry.target.style.opacity = "1"
        entry.target.style.transform = "translateY(0)"
      }, index * 100)
      cardObserver.unobserve(entry.target)
    }
  })
}, observerOptions)

document.querySelectorAll(".news-card, .tip-card, .game-card").forEach((el) => {
  el.style.opacity = "0"
  el.style.transform = "translateY(40px)"
  el.style.transition =
    "opacity 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)"
  cardObserver.observe(el)
})

function typeWriter(element, text, speed = 100) {
  let i = 0
  element.textContent = ""

  function type() {
    if (i < text.length) {
      element.textContent += text.charAt(i)
      i++
      setTimeout(type, speed)
    }
  }

  type()
}

let lastScroll = 0
const navbar = document.querySelector(".navbar")

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset

  if (currentScroll <= 0) {
    navbar.style.transform = "translateX(-50%) translateY(0)"
  } else if (currentScroll > lastScroll && currentScroll > 100) {
    navbar.style.transform = "translateX(-50%) translateY(-100px)"
  } else {
    navbar.style.transform = "translateX(-50%) translateY(0)"
  }

  lastScroll = currentScroll
})
