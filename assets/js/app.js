/**********************************************
 *  VS GAME - LÓGICA COMPLETA DEL JUEGO
 *  Cartas cargadas desde la base de datos
 **********************************************/

// Estado global del juego
let game = {
    mazo: [],
    ronda: 1,
    totalRondas: 5,
    scorePlayer: 0,
    scoreCPU: 0,
    history: [],
    currentPlayerCard: null,
    currentCPUCard: null,
};

// -------------------------------
// Inicialización
// -------------------------------
window.onload = async () => {
    await iniciarJuego();
};

// -------------------------------
// Cargar cartas desde el servidor
// -------------------------------
async function cargarCartasDesdeServidor() {
    try {
        const res = await fetch('../api/start_game.php');
        const data = await res.json();

        if (data.status !== 'success') {
            console.error('Error al cargar cartas:', data.message);
            return [];
        }

        // Convertir los valores a números y normalizar
        return data.cards.map((c) => ({
            id: c.id,
            name: c.name,
            atk: parseInt(c.attack),
            def: parseInt(c.defense),
            img: c.image,
        }));
    } catch (error) {
        console.error('No se pudo conectar a la API:', error);
        return [];
    }
}

// -------------------------------
// Mezclar mazo
// -------------------------------
function mezclar(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// -------------------------------
// Iniciar juego
// -------------------------------
async function iniciarJuego() {
    game.mazo = await cargarCartasDesdeServidor();
    game.mazo = mezclar(game.mazo);

    game.ronda = 1;
    game.scorePlayer = 0;
    game.scoreCPU = 0;
    game.history = [];

    siguienteRonda();
}

// -------------------------------
// Siguiente ronda
// -------------------------------
function siguienteRonda() {
    if (game.mazo.length < 2) {
        finDelJuego();
        return;
    }

    game.currentPlayerCard = game.mazo.shift();
    game.currentCPUCard = game.mazo.pop();

    mostrarCartas(game.currentPlayerCard, game.currentCPUCard);
    actualizarHUD();
}

// -------------------------------
// Mostrar cartas en la UI
// -------------------------------
function mostrarCartas(playerCard, cpuCard) {
    document.getElementById('imgJugador').src = playerCard.img;
    document.getElementById('imgMaquina').src = cpuCard.img;

    document.getElementById('atkJugador').textContent = playerCard.atk;
    document.getElementById('defJugador').textContent = playerCard.def;

    document.getElementById('atkMaquina').textContent = cpuCard.atk;
    document.getElementById('defMaquina').textContent = cpuCard.def;
}

// -------------------------------
// Acciones del jugador
// -------------------------------
function atacar() {
    jugarTurno('ataque');
}

function defender() {
    jugarTurno('defensa');
}

// -------------------------------
// Lógica de comparación
// -------------------------------
function jugarTurno(action) {
    const player = game.currentPlayerCard;
    const cpu = game.currentCPUCard;

    let resultado = '';

    if (action === 'ataque') {
        if (player.atk > cpu.def) {
            game.scorePlayer++;
            resultado = 'Ganaste (Ataque)';
        } else if (player.atk < cpu.def) {
            game.scoreCPU++;
            resultado = 'Perdiste';
        } else {
            resultado = 'Empate';
        }
    }

    if (action === 'defensa') {
        if (player.def > cpu.atk) {
            game.scorePlayer++;
            resultado = 'Ganaste (Defensa)';
        } else if (player.def < cpu.atk) {
            game.scoreCPU++;
            resultado = 'Perdiste';
        } else {
            resultado = 'Empate';
        }
    }

    // Guardar historial
    game.history.push({
        round: game.ronda,
        action,
        playerCard: player,
        cpuCard: cpu,
        result: resultado,
    });

    game.ronda++;

    actualizarHUD();

    if (game.ronda > game.totalRondas || game.mazo.length < 2) {
        finDelJuego();
    } else {
        siguienteRonda();
    }
}

// -------------------------------
// Actualizar puntuaciones en UI
// -------------------------------
function actualizarHUD() {
    document.getElementById('rondaActual').textContent = game.ronda;
    document.getElementById('scoreJ1').textContent = game.scorePlayer;
    document.getElementById('scoreJ2').textContent = game.scoreCPU;
}

// -------------------------------
// Fin del juego
// -------------------------------
function finDelJuego() {
    alert(
        `Juego terminado.\nJugador: ${game.scorePlayer}\nCPU: ${game.scoreCPU}`
    );
    guardarScore();
}

// -------------------------------
// Enviar resultado al backend
// -------------------------------
function guardarScore() {
    fetch('../api/save_score.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            scorePlayer: game.scorePlayer,
            scoreCPU: game.scoreCPU,
            totalRounds: game.ronda - 1,
            history: game.history,
        }),
    })
        .then((res) => res.json())
        .then((data) => console.log('Resultado guardado:', data))
        .catch((err) => console.error('Error guardando puntuación:', err));
}

// -------------------------------
// Reiniciar juego
// -------------------------------
document.getElementById('restartGame').addEventListener('click', (e) => {
    e.preventDefault();
    iniciarJuego();
});

// -------------------------------
// Modal de historial
// -------------------------------
function mostrarHistorial() {
    const cont = document.getElementById('historialContenido');
    cont.innerHTML = '';

    game.history.forEach((h) => {
        const div = document.createElement('div');
        div.classList.add('hist-item');
        div.innerHTML = `
            <p><strong>Ronda ${h.round}</strong> (${h.action.toUpperCase()})</p>
            <p>Jugador — ATK: ${h.playerCard.atk} | DEF: ${h.playerCard.def}</p>
            <p>CPU — ATK: ${h.cpuCard.atk} | DEF: ${h.cpuCard.def}</p>
            <p>Resultado: <strong>${h.result}</strong></p>
            <hr>
        `;
        cont.appendChild(div);
    });

    document.getElementById('modalHistorial').style.display = 'block';
}

function cerrarHistorial() {
    document.getElementById('modalHistorial').style.display = 'none';
}
