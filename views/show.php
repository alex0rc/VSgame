<?php
session_start();

// Bloquear acceso si no hay sesión
if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit();
}

$user = $_SESSION['user']; // Array con id, username, email
$username = $user['username'] ?? '';
$email = $user['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSGame</title>
    <link rel="stylesheet" href="../assets/scss/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        /* Modal historial */
        #modalHistorial {
            display: none;
            position: fixed;
            top: 10%;
            left: 10%;
            width: 80%;
            height: 80%;
            background: #111;
            color: #fff;
            overflow-y: auto;
            padding: 20px;
            border: 3px solid #fff;
            z-index: 1000;
        }

        #modalHistorial .closeBtn {
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
            font-size: 20px;
        }

        .hist-item hr {
            border: 1px dashed #fff;
        }
    </style>
</head>

<body>

    <!-- Cabecera -->
    <header class="header">
        <div>Bienvenido, <?= htmlspecialchars($username) ?>!</div>
        <a href="logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <!-- Contenedor de cartas -->
    <div class="container">
        <!-- CARTA JUGADOR -->
        <div class="card" id="cartaJugador">
            <img id="imgJugador" src="../assets/img/cards/1_card.jpg" alt="Carta del Jugador">
            <span class="atk" id="atkJugador">--</span>
            <span class="def" id="defJugador">--</span>
        </div>

        <img src="../assets/img/vs.png" alt="VS" class="vs">

        <!-- CARTA MÁQUINA -->
        <div class="card" id="cartaMaquina">
            <img id="imgMaquina" src="../assets/img/cards/2_card.jpg" alt="Carta de la Máquina">
            <span class="atk" id="atkMaquina">--</span>
            <span class="def" id="defMaquina">--</span>
        </div>
    </div>

    <!-- Botones Ataque / Defensa -->
    <div class="container">
        <div class="buttons">
            <a href="#" id="atacar"><img src="../assets/img/atacar.png" alt="atacar" class="btn"></a>
            <a href="#" id="defensa"><img src="../assets/img/defender.png" alt="defender" class="btn"></a>
            <button id="historialBtn" class="btn-historial">Historial</button>

            </button>

        </div>
    </div>

    <!-- Reiniciar juego -->
    <a href="#" id="restartGame">
        <img src="../assets/img/restartgame.png" alt="reiniciar">
    </a>
    <?php if ($user['rol'] == 1): ?>
        <a href="../admin/dashboard.php" class="btn-historial">Admin Panel</a>
    <?php endif; ?>


    <!-- SCOREBOARD -->
    <div class="score">
        <div class="contentScore">
            <div id="bandera">
                <img id="banderaImg" src="" alt="bandera">
            </div>

            <img src="../assets/img/score.png" alt="score" id="scoreGame">

            <div class="ronda" id="rondaActual">1</div>
            <div class="puntuacionJ1" id="scoreJ1">0</div>
            <div class="puntuacionJ2" id="scoreJ2">0</div>
        </div>
    </div>

    <!-- Modal historial -->
    <div id="modalHistorial">
        <span class="closeBtn" onclick="cerrarHistorial()">✖</span>
        <h2>Historial de Rondas</h2>
        <div id="historialContenido"></div>
    </div>

    <!-- Modal de Fin del Juego -->
    <div id="modalInfo" class="modal-fin">
        <div class="modal-fin-content">
            <h2 id="modalTitulo"></h2>
            <p id="modalMensaje"></p>

            <button class="btn-modal" id="modalCerrar">Cerrar</button>
            <button class="btn-modal" id="modalReiniciar">Reiniciar</button>
            <button class="btn-modal" id="modalHistorialBtn">Historial</button>

        </div>
    </div>


    <!-- Scripts -->
    <script src="../assets/js/app.js"></script>
    <script>
        // Conectar botones a funciones JS
        document.getElementById("atacar").addEventListener("click", e => {
            e.preventDefault();
            atacar();
        });
        document.getElementById("defensa").addEventListener("click", e => {
            e.preventDefault();
            defender();
        });
        document.getElementById("historialBtn").addEventListener("click", e => {
            e.preventDefault();
            mostrarHistorial();
        });
    </script>
</body>

</html>
