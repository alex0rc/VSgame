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
    initBotones();
    initModales();
    initDificultad();
    initRestart();
    document.getElementById('modalDificultad').style.display = 'flex';
};

async function cargarCartasDesdeServidor() {
    try {
        const res = await fetch('../api/start_game.php');
        const data = await res.json();
        if (data.status !== 'success') return [];

        return data.cards.map((c) => ({
            id: c.id,
            name: c.name,
            atk: parseInt(c.attack),
            def: parseInt(c.defense),
            img: c.image,
        }));
    } catch {
        return [];
    }
}

function mezclar(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
}

function aplicarDificultad() {
    if (game.difficulty_id === 1)
        game.mazo = game.mazo.map((c) => ({
            ...c,
            atk: c.atk + 1,
            def: c.def + 1,
        }));

    if (game.difficulty_id === 3)
        game.mazo = game.mazo.map((c) => ({
            ...c,
            atk: c.atk - 1,
            def: c.def - 1,
        }));
}

function setRondasPorDificultad() {
    if (game.difficulty_id === 1) game.totalRondas = 3;
    if (game.difficulty_id === 2) game.totalRondas = 5;
    if (game.difficulty_id === 3) game.totalRondas = 7;
}

async function iniciarJuego() {
    game.mazo = await cargarCartasDesdeServidor();
    aplicarDificultad();
    setRondasPorDificultad();
    mezclar(game.mazo);

    game.ronda = 1;
    game.scorePlayer = 0;
    game.scoreCPU = 0;
    game.history = [];
    game.terminado = false;

    siguienteRonda();
}

function siguienteRonda() {
    if (game.mazo.length < 2) {
        finDelJuego();
        return;
    }

    game.currentPlayerCard = game.mazo.shift();
    game.currentCPUCard = game.mazo.pop();

    mostrarCartas();
    actualizarHUD();
}

function mostrarCartas() {
    const p = game.currentPlayerCard;
    const c = game.currentCPUCard;

    document.getElementById('imgJugador').src = p.img;
    document.getElementById('imgMaquina').src = c.img;

    document.getElementById('atkJugador').textContent = p.atk;
    document.getElementById('defJugador').textContent = p.def;
    document.getElementById('atkMaquina').textContent = c.atk;
    document.getElementById('defMaquina').textContent = c.def;
}

function atacar() {
    if (!game.terminado) jugarTurno('ataque');
}

function defender() {
    if (!game.terminado) jugarTurno('defensa');
}

function jugarTurno(action) {
    const p = game.currentPlayerCard;
    const c = game.currentCPUCard;

    let resultado = '';

    if (action === 'ataque') {
        if (p.atk > c.def) {
            game.scorePlayer++;
            resultado = 'Ganaste (Ataque)';
            mostrarBandera('jugador');
        } else if (p.atk < c.def) {
            game.scoreCPU++;
            resultado = 'Perdiste';
            mostrarBandera('maquina');
        } else resultado = 'Empate';
    }

    if (action === 'defensa') {
        if (p.def > c.atk) {
            game.scorePlayer++;
            resultado = 'Ganaste (Defensa)';
            mostrarBandera('jugador');
        } else if (p.def < c.atk) {
            game.scoreCPU++;
            resultado = 'Perdiste';
            mostrarBandera('maquina');
        } else resultado = 'Empate';
    }

    game.history.push({
        round: game.ronda,
        action,
        playerCard: p,
        cpuCard: c,
        result: resultado,
    });

    let mensaje =
        action === 'ataque'
            ? `Jugador ATK: ${p.atk}<br>CPU DEF: ${c.def}<br><br><strong>${resultado}</strong>`
            : `Jugador DEF: ${p.def}<br>CPU ATK: ${c.atk}<br><br><strong>${resultado}</strong>`;

    mostrarModalRonda(`Ronda ${game.ronda}`, mensaje);
}

function mostrarModalRonda(titulo, mensaje) {
    document.getElementById('modalTitulo').textContent = titulo;
    document.getElementById('modalMensaje').innerHTML = mensaje;

    document.getElementById('modalContinuar').style.display = 'inline-block';
    document.getElementById('modalCerrar').style.display = 'none';
    document.getElementById('modalReiniciar').style.display = 'none';
    document.getElementById('modalHistorialBtn').style.display = 'none';

    document.getElementById('modalInfo').style.display = 'flex';
}

function mostrarModalFinal(titulo, mensaje) {
    document.getElementById('modalTitulo').textContent = titulo;
    document.getElementById('modalMensaje').innerHTML = mensaje;

    document.getElementById('modalContinuar').style.display = 'none';
    document.getElementById('modalCerrar').style.display = 'inline-block';
    document.getElementById('modalReiniciar').style.display = 'inline-block';
    document.getElementById('modalHistorialBtn').style.display = 'inline-block';

    document.getElementById('modalInfo').style.display = 'flex';
}

document.getElementById('modalContinuar').addEventListener('click', () => {
    cerrarModal();

    game.ronda++;
    actualizarHUD();

    if (game.ronda > game.totalRondas || game.mazo.length < 2) {
        finDelJuego();
    } else {
        siguienteRonda();
    }
});

document.getElementById('modalCerrar').addEventListener('click', cerrarModal);

function cerrarModal() {
    document.getElementById('modalInfo').style.display = 'none';
}

function actualizarHUD() {
    document.getElementById('rondaActual').textContent = game.ronda;
    document.getElementById('scoreJ1').textContent = game.scorePlayer;
    document.getElementById('scoreJ2').textContent = game.scoreCPU;
}

function mostrarBandera(who) {
    const b = document.getElementById('bandera');
    const img = document.getElementById('banderaImg');

    if (who === 'jugador') img.src = '../assets/img/win1.png';
    else if (who === 'maquina') img.src = '../assets/img/win2.png';
    else return;

    b.style.visibility = 'visible';
    b.style.opacity = '1';

    b.classList.remove('show');
    void b.offsetWidth;
    b.classList.add('show');
}

function finDelJuego() {
    game.terminado = true;

    let titulo =
        game.scorePlayer > game.scoreCPU
            ? '¡Victoria!'
            : game.scorePlayer < game.scoreCPU
            ? 'Derrota...'
            : 'Empate';

    let mensaje = `Jugador: ${game.scorePlayer} - CPU: ${game.scoreCPU}`;

    mostrarModalFinal(titulo, mensaje);
    guardarScore();
}

async function guardarScore() {
    try {
        await fetch('../api/save_score.php', {
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
    } catch {}
}

function mostrarHistorial() {
    const cont = document.getElementById('historialContenido');
    cont.innerHTML = '';

    game.history.forEach((h) => {
        const div = document.createElement('div');
        div.classList.add('hist-item');
        div.innerHTML = `
            <p><strong>Ronda ${h.round}</strong> (${h.action})</p>
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

function initBotones() {
    document.getElementById('atacar').addEventListener('click', atacar);
    document.getElementById('defensa').addEventListener('click', defender);
    document
        .getElementById('historialBtn')
        .addEventListener('click', mostrarHistorial);
}

function initModales() {
    document
        .getElementById('modalHistorialBtn')
        .addEventListener('click', () => {
            cerrarModal();
            mostrarHistorial();
        });
}

function initDificultad() {
    document.querySelectorAll('.dificultad-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            game.difficulty_id = parseInt(btn.dataset.id);
            document.getElementById('modalDificultad').style.display = 'none';
            iniciarJuego();
        });
    });
}

function initRestart() {
    document.getElementById('restartGame').addEventListener('click', (e) => {
        e.preventDefault();
        game.terminado = false;
        game.difficulty_id = null;
        document.getElementById('modalDificultad').style.display = 'flex';
    });
}
