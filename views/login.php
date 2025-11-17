<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>VSGAME - Login</title>
    <link rel="stylesheet" href="../assets/scss/style.css">
</head>

<body>
    <div class="form-container">

        <h1>VSGAME</h1>
        <h2>Iniciar Sesión</h2>

        <form id="loginForm">
            <label>Username</label>
            <input type="text" id="username" required>

            <label>Contraseña:</label>
            <input type="password" id="password" required>

            <button type="submit">Entrar</button>
        </form>

        <p>¿No tienes cuenta?
            <a href="./register.php">Regístrate</a>
        </p>
    </div>
</body>

</html>
