<?php require_once __DIR__ . '/../header.php'; ?>

<h1>Editar carta</h1>

<form action="?controller=card&action=update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($card['id']) ?>">

    <label>Nombre:</label>
    <br>
    <input type="text" name="name" value="<?= htmlspecialchars($card['name']) ?>" required>

    <br><br>

    <label>Ataque:</label>
    <br>
    <input type="number" name="attack" value="<?= htmlspecialchars($card['attack']) ?>" required>

    <br><br>   

    <label>Defensa:</label>
    <br>
    <input type="number" name="defense" value="<?= htmlspecialchars($card['defense']) ?>" required>

    <br><br>
    
    <label>Imagen:</label>
    <br>
    <input type="text" name="image" value="<?= htmlspecialchars($card['image']) ?>" required>

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="?controller=card&action=list">Volver al listado</a>
