<?php
session_start();

// Bloquear acceso si no hay sesión
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
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
</head>

<body>

    <!-- Cabecera con nombre de usuario y logout -->
    <header class="header">
        <div>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></div>
        <a href="logout.php" class="logout-btn">Cerrar sesión</a>
    </header>

    <!-- Formulario oculto para elegir ataque o defensa -->
    <form action="" method="GET" id="formEnvio" style="display: none;">
        <select name="opcionJugada" id="opcionJugada">
            <option value="ataque">Ataque</option>
            <option value="defensa">Defensa</option>
        </select>
        <input type="submit" value="Enviar">
    </form>

    <div class="container">
        <!-- CARTA JUGADOR -->
        <div class="card" data-id-carta="1" id="cartaJugador">
            <img id="imgJugador" src="../assets/img/cards/1_card.jpg" alt="Carta del Jugador">
            <span class="atk" id="atkJugador">--</span>
            <span class="def" id="defJugador">--</span>
        </div>

        <img src="../assets/img/vs.png" alt="VS" class="vs">

        <!-- CARTA MÁQUINA -->
        <div class="card" data-id-carta="2" id="cartaMaquina">
            <img id="imgMaquina" src="../assets/img/cards/2_card.jpg" alt="Carta de la Máquina">
            <span class="atk" id="atkMaquina">--</span>
            <span class="def" id="defMaquina">--</span>
        </div>
    </div>

    <!-- Botones Ataque / Defensa -->
    <div class="container">
        <div class="buttons">
            <a href="#" id="atacar" onclick="atacar(); return false">
                <img src="../assets/img/atacar.png" alt="atacar" class="btn">
            </a>
            <a href="#" id="defensa" onclick="defender(); return false">
                <img src="../assets/img/defender.png" alt="defender" class="btn">
            </a>
        </div>
    </div>

    <!-- Reiniciar juego -->
    <a href="#" id="restartGame">
        <img src="../assets/img/restartgame.png" alt="reiniciar">
    </a>

    <!-- SCOREBOARD -->
    <div class="score">
        <div class="contentScore">
            <div id="bandera" class="show">
                <img src="../assets/img/win2.png" alt="win2" class="win2">
            </div>

            <img src="../assets/img/score.png" alt="score" id="scoreGame">

            <div class="ronda" id="rondaActual">1</div>
            <div class="puntuacionJ1" id="scoreJ1">0</div>
            <div class="puntuacionJ2" id="scoreJ2">0</div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/js/app.js"></script>
</body>

</html>
