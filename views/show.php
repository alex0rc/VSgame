<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/scss/style.css">
    <title>VSGame</title>
</head>

<body>

    <!-- Formulario para elegir ataque o defensa -->
    <form action="" method="GET" id="formEnvio" style="display: none" ;>
        <select name="opcionJugada" id="opcionJugada">
            <option value="ataque">Ataque</option>
            <option value="defensa">Defensa</option>
        </select>
        <input type="submit" value="Enviar">
    </form>

    <div class="container">
        <div class="card">
            <img src="../assets/img/cards/1_card.jpg" alt="Carta del Jugador">
        </div>
        <img src="../assets/img/vs.png" alt="VS" class="vs">
        <div class="card">
            <img src="../assets/img/cards/2_card.jpg" alt="Carta de la Máquina">
        </div>
    </div>
    <div class="container">
        <div class="buttons">
            <a href="#" id="atacar" onclick="atacar(); return false">
                <img src="../assets/img/atacar.png" alt="Carta del Jugador" class="btn">
            </a>
            <a href="#" id="defensa" onclick="defender(); return false">
                <img src="../assets/img/defender.png" alt="Carta del Jugador" class="btn">
            </a>
        </div>


    </div>
    <a href="/daw/poo/videogame.php">
        <img src="../assets/img/restartgame.png" alt="reiniciar" id="restartGame">
    </a>
    <div class="score">
        <div class="contentScore">
            <div id="bandera" class="show">
                <img src="../assets/img/win2.png" alt="win2" class="win2">
            </div>
            <img src="../assets/img/score.png" alt="reiniciar" id="scoreGame">
            <div class="ronda">
                1
            </div>
            <div class="puntuacionJ1">
                2
            </div>
            <div class="puntuacionJ2">
                3
            </div>
        </div>
    </div>



    <!-- <div class="popup active" id="popup">
        <div class="popup-content">
            <button class="close-btn" id="closePopupBtn">&times;</button>
            <h2>Jugada</h2>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, provident.
        </div>
    </div> -->

    <script>
        const selectOculto = document.getElementById('opcionJugada');
        const formulario = document.getElementById('formEnvio');

        function atacar() {
            selectOculto.value = 'ataque'; // Cambia el valor del select
            formulario.submit();
        };

        function defender() {
            selectOculto.value = 'defensa'; // Cambia el valor del select
            formulario.submit();
        };

        // POPUP
        const closePopupBtn = document.getElementById('closePopupBtn');
        const popup = document.getElementById('popup');

        closePopupBtn.addEventListener('click', function() {
            popup.classList.remove('active');
        });

        window.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.classList.remove('active');
            }
        });
    </script>

</body>

</html>
