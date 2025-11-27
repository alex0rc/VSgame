<h1>Crear Partida</h1>

<form action="?controller=game&action=store" method="POST">
    <label>ID del jugador:</label>
    <br>
    <input type="number" name="user_id" required>

    <br><br>

    <label>ID de la dificultad:</label>
    <br>
    <input type="number" name="difficulty_id" required>

    <br><br>

    <label>Rondas totales:</label>
    <br>

    <input type="number" name="total_rounds" required>
    <br><br>

    <label>Rondas ganadas:</label>
    <br>


    <input type="number" name="rounds_won" required>
    <br>
    <label>Resultado:</label>
    <br>
        <select name="result">
            <option value="1">Gana</option>
            <option value="0">Perdió</option>
        </select>

    <br><br>

    <button type="submit">Crear partida</button>
</form>

<br>
<a href="?controller=game&action=index">Volver al listado</a>
