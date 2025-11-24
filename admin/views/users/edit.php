<?php require_once __DIR__ . '/../header.php'; ?>

<h1>Editar Usuario</h1>

<form action="?controller=user&action=update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

    <label>Email:</label>
    <br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <br><br>

    <label>Puntuación:</label>
    <br>
    <input type="number" name="score" value="<?= htmlspecialchars($user['score']) ?>" required>

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="?controller=user&action=list">Volver al listado</a>
