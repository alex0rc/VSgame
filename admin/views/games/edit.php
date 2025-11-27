<h1>Editar Partida</h1>

<form action="/VSgame/index.php?controller=game&action=update" method="POST">

    <input type="hidden" name="id" value="<?= htmlspecialchars($game->getId()) ?>">

    <input type="text" name="user_id" value="<?= htmlspecialchars($game->getUserId()) ?>" required>
    <br><br>

    <input type="text" name="difficulty_id" value="<?= htmlspecialchars($game->getDifficultyId()) ?>" required>
    <br><br>

    <input type="text" name="total_rounds" value="<?= htmlspecialchars($game->getTotalRounds()) ?>" required>
    <br><br>

    <input type="text" name="rounds_won" value="<?= htmlspecialchars($game->getRoundsWon()) ?>" required>
    <br><br>

    <select name="result">
        <option value="0" <?= $game->getResult() == 0 ? 'selected' : '' ?>>Gana</option>
        <option value="1" <?= $game->getResult() == 1 ? 'selected' : '' ?>>Perdió</option>
    </select>
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="/VSgame/index.php?controller=user&action=index">Volver al listado</a>
