let game = {
    mazo: [],
    ronda: 1,
    totalRondas: 5,
    scorePlayer: 0,
    scoreCPU: 0,
    history: [],
    currentPlayerCard: null,
    currentCPUCard: null,
    terminado: false,
    difficulty_id: null,
};

window.onload = () => {
    document.getElementById('modalDificultad').style.display = 'flex';
};

async function cargarCartasDesdeServidor() {
    try {
        const res = await fetch('../api/start_game.php');
        const data = await res.json();
        if (data.status !== 'success') {
            console.error('Error al cargar cartas:', data.message);
            return [];
        }
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

function mezclar(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function aplicarDificultad() {
    if (game.difficulty_id === 1) {
        game.mazo = game.mazo.map((c) => ({
            ...c,
            atk: c.atk + 1,
            def: c.def + 1,
        }));
    }
    if (game.difficulty_id === 3) {
        game.mazo = game.mazo.map((c) => ({
            ...c,
            atk: c.atk - 1,
            def: c.def - 1,
        }));
    }
}

function setRondasPorDificultad() {
    if (game.difficulty_id === 1) game.totalRondas = 4;
    if (game.difficulty_id === 2) game.totalRondas = 5;
    if (game.difficulty_id === 3) game.totalRondas = 7;
}

async function iniciarJuego() {
    game.mazo = await cargarCartasDesdeServidor();
    aplicarDificultad();
    setRondasPorDificultad();
    game.mazo = mezclar(game.mazo);

    game.ronda = 1;
    game.scorePlayer = 0;
    game.scoreCPU = 0;
    game.history = [];

    siguienteRonda();
}

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

function mostrarCartas(playerCard, cpuCard) {
    document.getElementById('imgJugador').src = playerCard.img;
    document.getElementById('imgMaquina').src = cpuCard.img;

    document.getElementById('atkJugador').textContent = playerCard.atk;
    document.getElementById('defJugador').textContent = playerCard.def;

    document.getElementById('atkMaquina').textContent = cpuCard.atk;
    document.getElementById('defMaquina').textContent = cpuCard.def;
}

function atacar() {
    if (game.terminado) return;
    jugarTurno('ataque');
}

function defender() {
    if (game.terminado) return;
    jugarTurno('defensa');
}

function jugarTurno(action) {
    const player = game.currentPlayerCard;
    const cpu = game.currentCPUCard;
    let resultado = '';

    if (action === 'ataque') {
        if (player.atk > cpu.def) {
            game.scorePlayer++;
            resultado = 'Ganaste (Ataque)';
            mostrarBandera('jugador');
        } else if (player.atk < cpu.def) {
            game.scoreCPU++;
            resultado = 'Perdiste';
            mostrarBandera('maquina');
        } else {
            resultado = 'Empate';
            mostrarBandera('empate');
        }
    }

    if (action === 'defensa') {
        if (player.def > cpu.atk) {
            game.scorePlayer++;
            resultado = 'Ganaste (Defensa)';
            mostrarBandera('jugador');
        } else if (player.def < cpu.atk) {
            game.scoreCPU++;
            resultado = 'Perdiste';
            mostrarBandera('maquina');
        } else {
            resultado = 'Empate';
            mostrarBandera('empate');
        }
    }

    game.history.push({
        round: game.ronda,
        action,
        playerCard: player,
        cpuCard: cpu,
        result: resultado,
    });

    let mensajeRonda = '';

    if (action === 'ataque') {
        mensajeRonda = `
        Jugador elige ataque: ${player.atk} <br>
        CPU elige defensa: ${cpu.def} <br><br>
        <strong>${resultado}</strong>
    `;
    }

    if (action === 'defensa') {
        mensajeRonda = `
        Jugador elige defensa: ${player.def} <br>
        CPU elige ataque: ${cpu.atk} <br><br>
        <strong>${resultado}</strong>
    `;
    }

    mostrarModal(`Ronda ${game.ronda}`, mensajeRonda, false, false);

    game.ronda++;
    actualizarHUD();

    if (game.ronda > game.totalRondas || game.mazo.length < 2) {
        finDelJuego();
    } else {
        siguienteRonda();
    }
}

function actualizarHUD() {
    document.getElementById('rondaActual').textContent = game.ronda;
    document.getElementById('scoreJ1').textContent = game.scorePlayer;
    document.getElementById('scoreJ2').textContent = game.scoreCPU;
}

function mostrarBandera(ganador) {
    const bandera = document.getElementById('bandera');
    const banderaImg = document.getElementById('banderaImg');

    if (ganador === 'jugador') {
        banderaImg.src = '../assets/img/win1.png';
    } else if (ganador === 'maquina') {
        banderaImg.src = '../assets/img/win2.png';
    } else {
        return;
    }

    bandera.style.visibility = 'visible';
    bandera.style.opacity = '1';

    bandera.classList.remove('show');
    void bandera.offsetWidth;
    bandera.classList.add('show');
}

function finDelJuego() {
    game.terminado = true;

    document.getElementById('atacar').style.pointerEvents = 'none';
    document.getElementById('defensa').style.pointerEvents = 'none';

    let mensaje = `Jugador: ${game.scorePlayer} - CPU: ${game.scoreCPU}`;

    let titulo =
        game.scorePlayer > game.scoreCPU
            ? '¡Victoria!'
            : game.scorePlayer < game.scoreCPU
            ? 'Derrota...'
            : 'Empate';

    mostrarModal(titulo, mensaje, true, true);

    guardarScore();
}

async function guardarScore() {
    try {
        const res = await fetch('../api/save_score.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                scorePlayer: game.scorePlayer,
                scoreCPU: game.scoreCPU,
                totalRounds: game.ronda - 1,
                difficulty_id: game.difficulty_id,
                history: game.history,
            }),
        });

        const data = await res.json();
        console.log('Resultado guardado:', data);
    } catch (err) {
        console.error('Error guardando puntuación:', err);
    }
}

document.getElementById('restartGame').addEventListener('click', (e) => {
    e.preventDefault();

    document.getElementById('atacar').style.pointerEvents = 'auto';
    document.getElementById('defensa').style.pointerEvents = 'auto';

    game.terminado = false;
    game.difficulty_id = null;

    document.getElementById('modalDificultad').style.display = 'flex';
});

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

function mostrarModal(
    titulo,
    mensaje,
    mostrarReiniciar = false,
    mostrarHistorial = false
) {
    const modal = document.getElementById('modalInfo');
    const mTitulo = document.getElementById('modalTitulo');
    const mMensaje = document.getElementById('modalMensaje');
    const btnReiniciar = document.getElementById('modalReiniciar');
    const btnHistorial = document.getElementById('modalHistorialBtn');

    mTitulo.textContent = titulo;
    mMensaje.innerHTML = mensaje;

    btnReiniciar.style.display = mostrarReiniciar ? 'inline-block' : 'none';
    btnHistorial.style.display = mostrarHistorial ? 'inline-block' : 'none';

    modal.style.display = 'flex';
}

function cerrarHistorial() {
    document.getElementById('modalHistorial').style.display = 'none';
}

document.getElementById('modalCerrar').addEventListener('click', () => {
    document.getElementById('modalInfo').style.display = 'none';
});

document.getElementById('modalReiniciar').addEventListener('click', () => {
    document.getElementById('modalInfo').style.display = 'none';

    document.getElementById('atacar').style.pointerEvents = 'auto';
    document.getElementById('defensa').style.pointerEvents = 'auto';

    game.terminado = false;
    game.difficulty_id = null;

    document.getElementById('modalDificultad').style.display = 'flex';
});

document.getElementById('modalHistorialBtn').addEventListener('click', () => {
    document.getElementById('modalInfo').style.display = 'none';
    mostrarHistorial();
});

document.querySelectorAll('.dificultad-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
        const id = parseInt(btn.dataset.id);
        game.difficulty_id = id;
        document.getElementById('modalDificultad').style.display = 'none';
        iniciarJuego();
    });
});
