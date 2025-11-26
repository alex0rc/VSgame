<h1>Crear Usuario</h1>

<form action="?controller=user&action=store" method="POST">
    <label>Nombre:</label>
    <br>
    <input type="text" name="username" required>
    <br>
    <label>Email:</label>
    <br>
    <input type="email" name="email" required>

    <br><br>

    <label>Contraseña:</label>
    <br>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Crear usuario</button>
</form>

<br>
<a href="?controller=user&action=list">Volver al listado</a>
