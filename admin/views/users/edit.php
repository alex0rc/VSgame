<h1>Editar Usuario</h1>

<form action="/VSgame/index.php?controller=user&action=update" method="POST">
    <!-- ID oculto -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($user->getId()) ?>">

    <!-- Nombre de usuario -->
    <label>Nombre de usuario:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($user->getUsername()) ?>" required>
    <br><br>

    <!-- Email -->
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>
    <br><br>

    <!-- Contraseña (opcional) -->
    <label>Contraseña (dejar en blanco para no cambiar):</label><br>
    <input type="password" name="password" placeholder="Nueva contraseña">
    <br><br>

    <!-- Rol -->
    <label>Rol:</label><br>
    <select name="rol">
        <option value="0" <?= $user->getRol() == 0 ? 'selected' : '' ?>>Usuario</option>
        <option value="1" <?= $user->getRol() == 1 ? 'selected' : '' ?>>Administrador</option>
    </select>
    <br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="/VSgame/index.php?controller=user&action=index">Volver al listado</a>
