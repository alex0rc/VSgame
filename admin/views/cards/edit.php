<main class="main-content">
    <h1>Editar carta</h1>

<form action="?controller=card&action=update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($card->getId()) ?>">

    <label>Nombre:</label>
    <br>
    <input type="text" name="name" value="<?= htmlspecialchars($card->getName()) ?>" required>

    <br><br>

    <label>Ataque:</label>
    <br>
    <input type="number" name="attack" value="<?= htmlspecialchars($card->getAttack()) ?>" required>

    <br><br>   

    <label>Defensa:</label>
    <br>
    <input type="number" name="defense" value="<?= htmlspecialchars($card->getDefense()) ?>" required>

    <br><br>
    
    <label>Imagen:</label>
    <br>
    <input type="text" name="image" value="<?= htmlspecialchars($card->getImage()) ?>" required>

    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="?controller=card&action=list">Volver al listado</a>
</main>